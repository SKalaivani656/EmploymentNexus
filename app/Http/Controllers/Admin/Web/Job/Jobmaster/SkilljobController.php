<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Skilljob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ISkilljobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkilljobController extends Controller
{

    public $skilljobrepo;

    public function __construct(ISkilljobRepository $skilljobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:skilljob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:skilljob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:skilljob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:skilljob-show', ['only' => ['show']]);
        // $this->middleware('permission:skilljob-delete', ['only' => ['destroy']]);

        $this->skilljobrepo = $skilljobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->skilljobrepo->index();
        }
        return view('admin/job/jobmaster/skilljob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Skilljob $skilljob)
    {
        return view('/admin/job/jobmaster/skilljob/createorupdate', compact('skilljob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:2|max:35|unique:skilljobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'shortname' => 'required|min:2|max:20|unique:skilljobs,shortname,' . $request->id,
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
            $this->skilljobrepo->store($collection);
            DB::commit();
            return redirect()->route('skilljob.index');
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
     * @param  \App\Models\Admin\Course\Skilljob  $skilljob
     * @return \Illuminate\Http\Response
     */
    public function show(Skilljob $skilljob)
    {
        return view('/admin/job/jobmaster/skilljob/show', compact('skilljob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Course\Skilljob
     * @return \Illuminate\Http\Response
     */
    public function edit(Skilljob $skilljob)
    {
        return view('/admin/job/jobmaster/skilljob/createorupdate', compact('skilljob'));
    }
}
