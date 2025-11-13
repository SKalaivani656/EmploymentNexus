<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Designationjob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IDesignationjobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesignationjobController extends Controller
{
    public $designationjobrepo;

    public function __construct(IDesignationjobRepository $designationjobrepo)
    {
        $this->middleware(['auth']);
        // $this->middleware('permission:designationjob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        // $this->middleware('permission:designationjob-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:designationjob-edit', ['only' => ['edit', 'store']]);
        // $this->middleware('permission:designationjob-show', ['only' => ['show']]);
        // $this->middleware('permission:designationjob-delete', ['only' => ['destroy']]);

        $this->designationjobrepo = $designationjobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->designationjobrepo->index();
        }
        return view('admin/job/jobmaster/designationjob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Designationjob $designationjob)
    {
        return view('/admin/job/jobmaster/designationjob/createorupdate', compact('designationjob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:designationjobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'shortname' => 'required|min:2|max:20|unique:designationjobs,shortname,' . $request->id,
            'seo_keyword' => 'required|min:25|max:150',
            'seo_description' => 'required|min:30|max:200',
            'image_alttag' => 'nullable',
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
            $this->designationjobrepo->store($collection);
            DB::commit();
            return redirect()->route('designationjob.index');
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
     * @param  \App\Models\Admin\designation\designationjob  $designationjob
     * @return \Illuminate\Http\Response
     */
    public function show(Designationjob $designationjob)
    {
        return view('/admin/job/jobmaster/designationjob/show', compact('designationjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\designation\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Designationjob $designationjob)
    {
        return view('/admin/job/jobmaster/designationjob/createorupdate', compact('designationjob'));
    }
}
