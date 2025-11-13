<?php

namespace App\Http\Controllers\Admin\Web\Video;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video\Postvideo;
use App\Repository\Admin\Web\Interfacelayer\Video\IPostvideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostvideoController extends Controller
{

    public $postvideorepo;

    public function __construct(IPostvideoRepository $postvideorepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:postvideo-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:postvideo-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:postvideo-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:postvideo-show', ['only' => ['show']]);
        // $this->middleware('permission:postvideo-delete', ['only' => ['destroy']]);

        $this->postvideorepo = $postvideorepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->postvideorepo->index();
        }
        return view('admin/video/postvideo/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Postvideo $postvideo)
    {
        return view('/admin/video/postvideo/createorupdate', compact('postvideo'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [

            'title' => 'required|min:30|max:80|unique:postvideos,title,' . $request->id,
            'slug' => 'required|min:20|max:80',
            'seo_keyword' => 'required|min:30|max:150',
            'seo_description' => 'required|min:40|max:200',
            'body' => 'required|min:40',
            'posted_on' => 'required|date',
            'position' => 'nullable|numeric',
            'video_id' => 'required|min:2|max:30|unique:postvideos,video_id,' . $request->id,
            // 'img_link' => 'nullable|max:100',
            // 'download_link' => 'nullable|max:100',
            // 'link' => 'nullable|max:100',
            'schemaorg' => 'required',
            'remarks' => 'nullable|max:250',
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
            $collection = $this->checkvalidation($request);

            DB::beginTransaction();
            $this->postvideorepo->store($collection);
            DB::commit();
            return redirect()->route('postvideo.index');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (QueryException $e) {
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
     * @param  \App\Models\Admin\post\postvideo  $postvideo
     * @return \Illuminate\Http\Response
     */
    public function show(Postvideo $postvideo)
    {
        return view('/admin/video/postvideo/show', compact('postvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\post\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Postvideo $postvideo)
    {
        return view('/admin/video/postvideo/createorupdate', compact('postvideo'));
    }

    public function ajaxvideocategory()
    {
        return $this->postvideorepo->ajaxvideocategory();
    }
}
