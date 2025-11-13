<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICompanyjobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyjobController extends Controller
{

    public $companyjobrepo;

    public function __construct(ICompanyjobRepository $companyjobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:companyjob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:companyjob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:companyjob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:companyjob-show', ['only' => ['show']]);
        // $this->middleware('permission:companyjob-delete', ['only' => ['destroy']]);

        $this->companyjobrepo = $companyjobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->companyjobrepo->index();
        }
        return view('admin/job/jobmaster/companyjob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Companyjob $companyjob)
    {
        return view('/admin/job/jobmaster/companyjob/createorupdate', compact('companyjob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:4|max:70|unique:companyjobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'websiteurl' => 'required|min:10|max:80',
            'shortname' => 'required|min:2|max:20|unique:companyjobs,shortname,' . $request->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_alttag' => 'required',
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
            $this->companyjobrepo->store($collection);
            DB::commit();
            return redirect()->route('companyjob.index');
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
     * @param  \App\Models\Admin\Company\companyjob  $companyjob
     * @return \Illuminate\Http\Response
     */
    public function show(Companyjob $companyjob)
    {
        return view('/admin/job/jobmaster/companyjob/show', compact('companyjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Company\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Companyjob $companyjob)
    {
        return view('/admin/job/jobmaster/companyjob/createorupdate', compact('companyjob'));
    }
}
