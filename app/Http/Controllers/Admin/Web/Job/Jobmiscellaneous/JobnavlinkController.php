<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmiscellaneous;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmiscellaneous\Jobnavlink;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmiscellaneous\IJobnavlinkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobnavlinkController extends Controller
{
    public $jobnavlinkrepo;

    public function __construct(IJobnavlinkRepository $jobnavlinkrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:jobnavlink-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:jobnavlink-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jobnavlink-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:jobnavlink-show', ['only' => ['show']]);
        // $this->middleware('permission:jobnavlink-delete', ['only' => ['destroy']]);

        $this->jobnavlinkrepo = $jobnavlinkrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->jobnavlinkrepo->index();
        }
        return view('admin/job/jobmiscellaneous/jobnavlink/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Jobnavlink $jobnavlink)
    {
        return view('/admin/job/jobmiscellaneous/jobnavlink/createorupdate', compact('jobnavlink'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:3|max:35|unique:jobnavlinks,name,' . $request->id,
            'shortname' => 'required|min:2|max:20',
            'link' => 'required',
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
            $this->jobnavlinkrepo->store($collection);

            DB::commit();
            return redirect()->route('jobnavlink.index');
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
     * @param  \App\Models\Admin\Category\Jobnavlink  $jobnavlink
     * @return \Illuminate\Http\Response
     */
    public function show(Jobnavlink $jobnavlink)
    {
        return view('/admin/job/jobmiscellaneous/jobnavlink/show', compact('jobnavlink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category\jobnavlink  $jobnavlink
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobnavlink $jobnavlink)
    {
        return view('/admin/job/jobmiscellaneous/jobnavlink/createorupdate', compact('jobnavlink'));
    }
}
