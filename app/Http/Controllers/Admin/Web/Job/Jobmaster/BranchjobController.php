<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Branchjob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IBranchjobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchjobController extends Controller
{

    public $branchjobrepo;

    public function __construct(IBranchjobRepository $branchjobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:branchjob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:branchjob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:branchjob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:branchjob-show', ['only' => ['show']]);
        // $this->middleware('permission:branchjob-delete', ['only' => ['destroy']]);

        $this->branchjobrepo = $branchjobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->branchjobrepo->index();
        }
        return view('admin/job/jobmaster/branchjob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Branchjob $branchjob)
    {
        return view('/admin/job/jobmaster/branchjob/createorupdate', compact('branchjob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:65|unique:branchjobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'fullname' => 'required|min:5|max:65|unique:branchjobs,fullname,' . $request->id,
            'degree' => 'required|min:2|max:50',
            'shortname' => 'required|min:2|max:55|unique:branchjobs,shortname,' . $request->id,
            'image_alttag' => 'nullable',
            'seo_keyword' => 'required|min:25|max:150',
            'seo_description' => 'required|min:30|max:250',
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
            $this->branchjobrepo->store($collection);

            DB::commit();
            return redirect()->route('branchjob.index');
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
     * @param  \App\Models\Admin\Category\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function show(Branchjob $branchjob)
    {
        return view('/admin/job/jobmaster/branchjob/show', compact('branchjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Branchjob $branchjob)
    {
        return view('/admin/job/jobmaster/branchjob/createorupdate', compact('branchjob'));
    }
}
