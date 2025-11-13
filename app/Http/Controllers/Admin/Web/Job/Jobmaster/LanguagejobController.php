<?php

namespace App\Http\Controllers\Admin\Web\Job\Jobmaster;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ILanguagejobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LanguagejobController extends Controller
{
    public $languagejobrepo;

    public function __construct(ILanguagejobRepository $languagejobrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:languagejob-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:languagejob-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:languagejob-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:languagejob-show', ['only' => ['show']]);
        // $this->middleware('permission:languagejob-delete', ['only' => ['destroy']]);

        $this->languagejobrepo = $languagejobrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->languagejobrepo->index();
        }
        return view('admin/job/jobmaster/languagejob/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Languagejob $languagejob)
    {
        return view('/admin/job/jobmaster/languagejob/createorupdate', compact('languagejob'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:4|max:35|unique:languagejobs,name,' . $request->id,
            'slug' => 'required|min:10|max:80',
            'shortname' => 'required|min:2|max:20|unique:languagejobs,shortname,' . $request->id,
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
            $this->languagejobrepo->store($collection);
            DB::commit();
            return redirect()->route('languagejob.index');
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
     * @param  \App\Models\Admin\language\languagejob  $languagejob
     * @return \Illuminate\Http\Response
     */
    public function show(Languagejob $languagejob)
    {
        return view('/admin/job/jobmaster/languagejob/show', compact('languagejob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\language\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Languagejob $languagejob)
    {
        return view('/admin/job/jobmaster/languagejob/createorupdate', compact('languagejob'));
    }
}
