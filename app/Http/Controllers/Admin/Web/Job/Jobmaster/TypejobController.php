<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ITypejobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypejobController extends Controller
{

    public $typejobrepo;

    public function __construct(ITypejobRepository $typejobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:typejob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:typejob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:typejob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:typejob-show', ['only' => ['show']]);
        // $this->middleware('permission:typejob-delete', ['only' => ['destroy']]);

        $this->typejobrepo = $typejobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->typejobrepo->index();
        }
        return view('admin/job/jobmaster/typejob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Typejob $typejob)
    {
        return view('/admin/job/jobmaster/typejob/createorupdate', compact('typejob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:typejobs,name,' . $request->id,
            'schemaorg_type' => 'required',
            'shortname' => 'required|min:2|max:20|unique:typejobs,shortname,' . $request->id,
            'slug' => 'required|min:10|max:80',
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
            $this->typejobrepo->store($collection);
            DB::commit();
            return redirect()->route('typejob.index');
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
     * @param  \App\Models\Admin\Course\typejob  $typejob
     * @return \Illuminate\Http\Response
     */
    public function show(Typejob $typejob)
    {
        return view('/admin/job/jobmaster/typejob/show', compact('typejob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Course\typejob
     * @return \Illuminate\Http\Response
     */
    public function edit(Typejob $typejob)
    {
        return view('/admin/job/jobmaster/typejob/createorupdate', compact('typejob'));
    }
}
