<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Tagjob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ITagjobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagjobController extends Controller
{

    public $tagjobrepo;

    public function __construct(ITagjobRepository $tagjobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:tagjob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:tagjob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tagjob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:tagjob-show', ['only' => ['show']]);
        // $this->middleware('permission:tagjob-delete', ['only' => ['destroy']]);

        $this->tagjobrepo = $tagjobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->tagjobrepo->index();
        }
        return view('admin/job/jobmaster/tagjob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tagjob $tagjob)
    {
        return view('/admin/job/jobmaster/tagjob/createorupdate', compact('tagjob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:tagjobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'shortname' => 'required|min:2|max:20|unique:tagjobs,shortname,' . $request->id,
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
            $this->tagjobrepo->store($collection);
            DB::commit();
            return redirect()->route('tagjob.index');
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
     * @param  \App\Models\Admin\Course\tagjob  $tagjob
     * @return \Illuminate\Http\Response
     */
    public function show(Tagjob $tagjob)
    {
        return view('/admin/job/jobmaster/tagjob/show', compact('tagjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Course\tagjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagjob $tagjob)
    {
        return view('/admin/job/jobmaster/tagjob/createorupdate', compact('tagjob'));
    }
}
