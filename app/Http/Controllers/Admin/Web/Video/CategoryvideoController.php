<?php

namespace App\Http\Controllers\Admin\Web\Video;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video\Categoryvideo;
use App\Repository\Admin\Web\Interfacelayer\Video\ICategoryvideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryvideoController extends Controller
{

    public $categoryvideorepo;

    public function __construct(ICategoryvideoRepository $categoryvideorepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:categoryvideo-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:categoryvideo-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categoryvideo-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:categoryvideo-show', ['only' => ['show']]);
        // $this->middleware('permission:categoryvideo-delete', ['only' => ['destroy']]);

        $this->categoryvideorepo = $categoryvideorepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->categoryvideorepo->index();
        }
        return view('admin/video/categoryvideo/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categoryvideo $categoryvideo)
    {
        return view('/admin/video/categoryvideo/createorupdate', compact('categoryvideo'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:categoryvideos,name,' . $request->id,
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
            $this->categoryvideorepo->store($collection);
            DB::commit();
            return redirect()->route('categoryvideo.index');
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
     * @param  \App\Models\Admin\Category\categoryvideo  $categoryvideo
     * @return \Illuminate\Http\Response
     */
    public function show(Categoryvideo $categoryvideo)
    {
        return view('/admin/video/categoryvideo/show', compact('categoryvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoryvideo $categoryvideo)
    {
        return view('/admin/video/categoryvideo/createorupdate', compact('categoryvideo'));
    }
}
