<?php

namespace App\Http\Controllers\Admin\Web\Video;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video\Tagvideo;
use App\Repository\Admin\Web\Interfacelayer\Video\ITagvideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagvideoController extends Controller
{

    public $tagvideorepo;

    public function __construct(ITagvideoRepository $tagvideorepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:tagvideo-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:tagvideo-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tagvideo-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:tagvideo-show', ['only' => ['show']]);
        // $this->middleware('permission:tagvideo-delete', ['only' => ['destroy']]);

        $this->tagvideorepo = $tagvideorepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->tagvideorepo->index();
        }
        return view('admin/video/tagvideo/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tagvideo $tagvideo)
    {
        return view('/admin/video/tagvideo/createorupdate', compact('tagvideo'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:tagvideos,name,' . $request->id,
            'slug' => 'required|min:20|max:80',
            'seo_keyword' => 'required|min:30|max:150',
            'seo_description' => 'required|min:40|max:200',
            'position' => 'nullable|numeric',
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
            $this->tagvideorepo->store($collection);
            DB::commit();
            return redirect()->route('tagvideo.index');
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
     * @param  \App\Models\Admin\tag\tagvideo  $tagvideo
     * @return \Illuminate\Http\Response
     */
    public function show(Tagvideo $tagvideo)
    {
        return view('/admin/video/tagvideo/show', compact('tagvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\tag\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagvideo $tagvideo)
    {
        return view('/admin/video/tagvideo/createorupdate', compact('tagvideo'));
    }
}
