<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Coursejob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICoursejobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursejobController extends Controller
{

    public $coursejobrepo;

    public function __construct(ICoursejobRepository $coursejobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:coursejob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:coursejob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:coursejob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:coursejob-show', ['only' => ['show']]);
        // $this->middleware('permission:coursejob-delete', ['only' => ['destroy']]);

        $this->coursejobrepo = $coursejobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->coursejobrepo->index();
        }
        return view('admin/job/jobmaster/coursejob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Coursejob $coursejob)
    {
        return view('/admin/job/jobmaster/coursejob/createorupdate', compact('coursejob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:65|unique:coursejobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'shortname' => 'required|min:2|max:55|unique:coursejobs,shortname,' . $request->id,
            'seo_keyword' => 'required|min:25|max:150',
            'image_alttag' => 'nullable',
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
            $this->coursejobrepo->store($collection);
            DB::commit();
            return redirect()->route('coursejob.index');
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
     * @param  \App\Models\Admin\Course\coursejob  $coursejob
     * @return \Illuminate\Http\Response
     */
    public function show(Coursejob $coursejob)
    {
        return view('/admin/job/jobmaster/coursejob/show', compact('coursejob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Course\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Coursejob $coursejob)
    {
        return view('/admin/job/jobmaster/coursejob/createorupdate', compact('coursejob'));
    }

    public function ajaxbranchlistjob()
    {
        return $this->coursejobrepo->ajaxbranchlistjob();
    }
}
