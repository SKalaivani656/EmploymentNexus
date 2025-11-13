<?php

namespace App\Repository\Admin\Web\Businesslogic\Video;

use App\Models\Admin\Video\Categoryvideo;
use App\Models\Admin\Video\Postvideo;
use App\Models\Admin\Video\Tagvideo;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Video\IPostvideoRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PostvideoRepository implements IPostvideoRepository
{

    public function index()
    {
        $postvideo = Postvideo::select(array('id', 'uniqid', 'title', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($postvideo)
            ->setRowClass(function ($postvideo) {
                return ($postvideo->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($postvideo) {
                return $postvideo->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($postvideo) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('postvideo-show')) {
                $action .= '<a href="postvideo/' . $postvideo->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('postvideo-edit')) {
                $action .= ' <a href="postvideo/' . $postvideo->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                }
                $action .= ' </td>';
                return $action;
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);
    }

    public function store($collection = [])
    {
        $sessionid = request()->session()->get('sessionid');
        Log::info("SessionID " . $sessionid . ' Function : add/edit post Blog');

        $collection['link'] = 'https://www.youtube.com/watch?v=' . request('video_id');
        $collection['img_link'] = 'https://img.youtube.com/vi/' . request('video_id') . '/mqdefault.jpg';
        $collection['download_link'] = 'https://www.ssyoutube.com/watch?v=' . request('video_id');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['videocomment'] = request()->has('videocomment');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['video_status'] = request()->has('video_status');
        $collection['position'] = 1;
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;

            $postvideo = Postvideo::find(request()->id);
            $collection['seo_title'] = request('title') . ' - ' . $postvideo->created_at->format('Y') . ' jobs preparenext.com';
            $postvideo->fill($collection);
            $postvideo->save();

            $postvideo->categoryvideo()->sync(request()->category_select);
            $postvideo->tagvideo()->sync(request()->tag_select);

            toast('post Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing post Blog';
        } else {
            $collection['seo_title'] = request('title') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'V', 'App\Models\Admin\Video\Postvideo');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            $postvideo = Postvideo::create($collection);

            $postvideo->categoryvideo()->attach(request()->category_select);
            $postvideo->tagvideo()->attach(request()->tag_select);
            toast('New Video post Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Video post';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Video post', $sessionid, 'WEB');
    }

    public function ajaxvideocategory()
    {
        $category = Categoryvideo::where('active', true)->get();
        $tag = Tagvideo::where('active', true)->get();

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
