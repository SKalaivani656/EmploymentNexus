<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Rolejob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IRolejobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolejobController extends Controller
{

    public $rolejobrepo;

    public function __construct(IRolejobRepository $rolejobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:rolejob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:rolejob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rolejob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:rolejob-show', ['only' => ['show']]);
        // $this->middleware('permission:rolejob-delete', ['only' => ['destroy']]);

        $this->rolejobrepo = $rolejobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->rolejobrepo->index();
        }
        return view('admin/job/jobmaster/rolejob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rolejob $rolejob)
    {
        return view('/admin/job/jobmaster/rolejob/createorupdate', compact('rolejob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:rolejobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'shortname' => 'required|min:2|max:20|unique:rolejobs,shortname,' . $request->id,
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
            $this->rolejobrepo->store($collection);
            DB::commit();
            return redirect()->route('rolejob.index');
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
     * @param  \App\Models\Admin\Course\rolejob  $rolejob
     * @return \Illuminate\Http\Response
     */
    public function show(Rolejob $rolejob)
    {
        return view('/admin/job/jobmaster/rolejob/show', compact('rolejob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Course\rolejob
     * @return \Illuminate\Http\Response
     */
    public function edit(Rolejob $rolejob)
    {
        return view('/admin/job/jobmaster/rolejob/createorupdate', compact('rolejob'));
    }
}
