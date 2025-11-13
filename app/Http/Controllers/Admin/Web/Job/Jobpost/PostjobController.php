<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobpost;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobpost\Postjob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobpost\IPostjobRepository;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Image;
use Validator;

class PostjobController extends Controller
{
    public $postjobrepo;

    public function __construct(IPostjobRepository $postjobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:postjob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:postjob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:postjob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:postjob-show', ['only' => ['show']]);
        // $this->middleware('permission:postjob-delete', ['only' => ['destroy']]);

        $this->postjobrepo = $postjobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->postjobrepo->index();
        }
        return view('admin/job/postjob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Postjob $postjob)
    {

        $data = $this->postjobrepo->create();
        $countries = $data['country'];
        $companyjob = $data['companyjob'];
        $postjob->posted_on = Carbon::now();
        return view('/admin/job/postjob/createorupdate', compact('postjob', 'countries', 'companyjob'));
    }

    public function checkvalidation($request)
    {

        return $this->validate($request, [
            'title' => 'required|max:256|unique:postjobs,title,' . $request->id,
            //  'subtitle' => 'required|max:250',
            'slug' => 'required|max:150|unique:postjobs,slug,' . $request->id,
            'seo_keyword' => 'required|max:150',
            'seo_description' => 'required|max:250',
            'image_alttag' => 'nullable',
            'sector' => 'required',
            'remarks' => 'nullable|max:250',
            // 'short_description' => 'required|min:20|max:250',
            'body' => 'required|min:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'min_sal' => 'nullable|numeric',
            'max_sal' => 'nullable|numeric',
            'min_exp' => 'nullable|numeric',
            'max_exp' => 'nullable|numeric',
            'min_age' => 'nullable|numeric',
            'max_age' => 'nullable|numeric',

            'video_link' => 'nullable',
            'postdate' => 'nullable',
            'documentsubmissiondate' => 'nullable',
            'startdateapply' => 'nullable',
            'lastdateapply' => 'nullable',
            'examdate' => 'nullable',
            'interviewdate' => 'nullable',
            'dateofjoining' => 'nullable',
            'total_vacancy' => 'nullable',
            'finalresultdate' => 'nullable',

            'position' => 'nullable|numeric',
            'posted_on' => 'required|date',

            'jobid' => 'nullable',
            'companyjob_id' => 'required|not_in:0',
            'streetaddress' => 'nullable',
            'postcode' => 'nullable|numeric|digits:6',
            'salarytype' => 'nullable',
            'workhours' => 'nullable',
            'responsibility' => 'nullable',

            'category_select' => 'required|array',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // return $request->all();
            $collection = $this->checkvalidation($request);

            DB::beginTransaction();
            $this->postjobrepo->store($collection);
            DB::commit();
            return redirect()->route('postjob.index');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException$e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Course\postjob  $postjob
     * @return \Illuminate\Http\Response
     */
    public function show(Postjob $postjob)
    {
        return view('/admin/job/postjob/show', compact('postjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Course\postjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Postjob $postjob)
    {
        $data = $this->postjobrepo->edit();
        $countries = $data['country'];
        $companyjob = $data['companyjob'];
        $postjob->posted_on = Carbon::now();
        return view('/admin/job/postjob/createorupdate', compact('postjob', 'countries', 'companyjob'));
    }

    public function ajaxcategorylistjob()
    {
        return $this->postjobrepo->ajaxcategorylistjob();
    }

    public function getstatelist()
    {
        return $this->postjobrepo->getstatelist();
    }

    public function getcitylist()
    {
        return $this->postjobrepo->getcitylist();
    }

    public function jobcontentimagedel(Request $request)
    {
        if ($request->get('src')) {
            $path = (explode("images/job/jobcontent/", $request->get('src')));
            File::delete(public_path('/images/job/jobcontent/' . $path[1]));
            echo 'deleted successfully';
        }
    }

    public function jobbanner($id)
    {
        $postjob = Postjob::find($id);
        return view('/admin/job/postjob/jobbanner', compact('postjob'));
    }

    public function postjobbanner(Request $request)
    {
        // $postquotes = postquotes::with('biography')->where('uniqid', $request->filename)->first();
        // $postquotes->update(['img_flag' => 1]);
        // $postquotes->save();

        // File::deleteDirectory(public_path('storage/images/'));

        $validator = Validator::make($request->all(),
            ['file' => 'image'],
            ['file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)']);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->errors(),
            );
        }

        //get filename with extension
        $filenamewithextension = $request->file('file')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('file')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $request->filename . '_' . time() . '.jpg';

        //Upload File
        $request->file('file')->storeAs('public/images', $filenametostore);
        $request->file('file')->storeAs('public/images/thumbnail', $filenametostore);

        //Resize image here
        $thumbnailpath = public_path('storage/images/' . $filenametostore);
        $originalImage = public_path('storage/quotes/' . $request->filename . '.jpg');

        $img = Image::make($thumbnailpath)->fit(700, 400);

        $width = 700;
        $height = 150;
        $center_x = $width / 2;
        $center_y = $height / 2;
        $max_len = 36;
        $font_size = 30;
        $font_height = 20;

        $lines = explode("\n", wordwrap('$postquotes->interpretation', $max_len));
        $y = $center_y - ((count($lines) - 1) * $font_height);
        $img = Image::make($thumbnailpath)->fit(700, 400);

        foreach ($lines as $line) {
            $img->text($line, $center_x, $y, function ($font) use ($font_size) {
                $font->file(public_path('Open_Sans/OpenSans-ExtraBold.ttf'));
                $font->size($font_size);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            $y += $font_height * 2;
        }

        $img->text('~ ' . '$postquotes->biography->author', 530, 300, function ($font) {
            $font->file(public_path('Open_Sans/OpenSans-ExtraBold.ttf'));
            $font->size(28);
            $font->color('#e1e1e1');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->text('PrepareNext.Com ', 550, 380, function ($font) {
            $font->file(public_path('Open_Sans/OpenSans-ExtraBold.ttf'));
            $font->size(28);
            $font->color('#e1e1e1');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->save($thumbnailpath, 80);
        $img->save($originalImage, 80);

        return $filenametostore;

    }

}
