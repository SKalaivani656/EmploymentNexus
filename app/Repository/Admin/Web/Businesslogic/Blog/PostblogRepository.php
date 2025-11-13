<?php

namespace App\Repository\Admin\Web\Businesslogic\Blog;

use App\Models\Admin\Blog\Categoryblog;
use App\Models\Admin\Blog\Postblog;
use App\Models\Admin\Blog\Tagblog;
use App\Models\Admin\Worldinfo\City;
use App\Models\Admin\Worldinfo\Country;
use App\Models\Admin\Worldinfo\State;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Blog\IPostblogRepository;
use App\Traits\UploadTrait;
use Auth;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\DataTables;

class PostblogRepository implements IPostblogRepository
{

    use UploadTrait;

    public function index()
    {
        $postblog = Postblog::select(array('id', 'uniqid', 'title', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($postblog)
            ->setRowClass(function ($postblog) {
                return ($postblog->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($postblog) {
                return $postblog->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($postblog) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('postblog-show')) {
                    $action .= '<a href="postblog/' . $postblog->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('postblog-edit')) {
                    $action .= ' <a href="postblog/' . $postblog->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                }
                $action .= ' </td>';
                return $action;
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);
    }

    public function create()
    {
        return [0 => 'Select Countries'] + Country::pluck('name', 'id')->all();
    }

    public function store($collection = [])
    {
        $sessionid = request()->session()->get('sessionid');
        Log::info("SessionID " . $sessionid . ' Function : add/edit Postblog');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['video_status'] = request()->has('video_status');
        $collection['blogcomment'] = request()->has('blogcomment');
        $collection['image_status'] = request()->has('image_status');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/blog/images/', '/images/blog/thumbnail/', 'App\Models\Admin\Blog\Postblog', 70, [600, 350]);
        }

        if (request()->country_id) {
            $collection['country_id'] = request()->country_id;
            $collection['country'] = Country::find(request()->country_id)->name;
        }
        if (request()->state_id && request()->state_id != 'Select' && request()->state_id != 'null') {
            $collection['state_id'] = request()->state_id;
            $collection['state'] = State::find(request()->state_id)->name;
        } else {
            $collection['state_id'] = null;
            $collection['state'] = '';
        }
        if (request()->city_id && request()->city_id != 'Select' && request()->city_id != 'null') {
            $collection['city_id'] = request()->city_id;
            $collection['city'] = City::find(request()->city_id)->name;
        } else {
            $collection['city_id'] = null;
            $collection['city'] = '';
        }

        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $collection['body'] = $this->domimageoptimization($collection['body'], request()->uniqid);
            $postblog = Postblog::find(request()->id);
            $collection['seo_title'] = request('title') . ' jobs'; //. ' - ' . $postblog->created_at->format('Y') . ' jobs | preparenext.com';
            $postblog->categoryblog()->sync(request()->category_select);
            $postblog->tagblog()->sync(request()->tag_select);

            $postblog->fill($collection);
            $postblog->save();

            toast('Blog Post Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Postblog';
        } else {
            $collection['seo_title'] = request('title') . ' jobs'; //. ' - ' . date('Y') . ' jobs | preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(8, 'B', 'App\Models\Admin\Blog\Postblog');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;

            $collection['body'] = $this->domimageoptimization(request()->body, $uniqueId['uniqid']);
            $postblog = Postblog::create($collection);

            $postblog->categoryblog()->attach(request()->category_select);
            $postblog->tagblog()->attach(request()->tag_select);

            toast('New Blog Post Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Postblog';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Post Blog', $sessionid, 'WEB');
    }

    public function edit()
    {
        return [0 => 'Select Countries'] + Country::pluck('name', 'id')->all();
    }

    private function domimageoptimization($body, $unique)
    {

        $path = public_path() . '/images/blog/blogcontent/' . $unique;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $dom = new \DomDocument();
        //@$dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        @$dom->loadHtml(mb_convert_encoding($body, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        // foreach <img> in the submited message
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            // if the img source is 'data-url'
            if (preg_match('/data:image/', $src)) {

                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];

                // Generating a random filename
                $filename = uniqid();
                $filepath = "/images/blog/blogcontent/$unique/$filename.$mimetype";

                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                // resize if required
                /* ->resize(300, 200) */
                    ->encode($mimetype, 100) // encode file to the specified mimetype
                    ->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!--endforeach
        return $dom->saveHTML();

    }

    public function ajaxcategorylistblog()
    {
        $category = Categoryblog::where('active', true)->get();
        $tag = Tagblog::where('active', true)->get();

        $categoryoption = '<option value="">SELECT CATEGORY</option>';
        foreach ($category as $row) {
            $categoryoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $tagoption = '<option value="">SELECT TAG</option>';
        foreach ($tag as $row) {
            $tagoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $output = array(
            'categoryoption' => $categoryoption,
            'tagoption' => $tagoption,
        );

        echo json_encode($output);
    }

}
