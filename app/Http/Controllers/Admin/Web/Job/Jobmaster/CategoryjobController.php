<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICategoryjobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryjobController extends Controller
{

    public $categoryjobrepo;

    public function __construct(ICategoryjobRepository $categoryjobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:categoryjob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:categoryjob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categoryjob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:categoryjob-show', ['only' => ['show']]);
        // $this->middleware('permission:categoryjob-delete', ['only' => ['destroy']]);

        $this->categoryjobrepo = $categoryjobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->categoryjobrepo->index();
        }
        return view('admin/job/jobmaster/categoryjob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categoryjob $categoryjob)
    {
        return view('/admin/job/jobmaster/categoryjob/createorupdate', compact('categoryjob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:categoryjobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'image_alttag' => 'nullable',
            'shortname' => 'required|min:2||max:20|unique:categoryjobs,shortname,' . $request->id,
            'seo_keyword' => 'required|min:25|max:150',
            'seo_description' => 'required|min:30|max:200',
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
            $this->categoryjobrepo->store($collection);
            DB::commit();
            return redirect()->route('categoryjob.index');
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
     * @param  \App\Models\Admin\Category\categoryjob  $categoryjob
     * @return \Illuminate\Http\Response
     */
    public function show(Categoryjob $categoryjob)
    {
        return view('/admin/job/jobmaster/categoryjob/show', compact('categoryjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoryjob $categoryjob)
    {
        return view('/admin/job/jobmaster/categoryjob/createorupdate', compact('categoryjob'));
    }
}
