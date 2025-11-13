<?php

namespace App\Http\Controllers\Admin\Web\Exam\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\Exam\Master\Competitiveexam;
use App\Repository\Admin\Web\Interfacelayer\Exam\Master\ICompetitiveexamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitiveexamController extends Controller
{
    public $competitiveexamrepo;

    public function __construct(ICompetitiveexamRepository $competitiveexamrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:competitiveexam-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:competitiveexam-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:competitiveexam-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:competitiveexam-show', ['only' => ['show']]);
        // $this->middleware('permission:competitiveexam-delete', ['only' => ['destroy']]);

        $this->competitiveexamrepo = $competitiveexamrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->competitiveexamrepo->index();
        }
        return view('admin/exam/master/competitiveexam/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competitiveexam $competitiveexam)
    {
        return view('/admin/exam/master/competitiveexam/createorupdate', compact('competitiveexam'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:65|unique:competitiveexams,name,' . $request->id,
            'slug' => 'required|min:20|max:80',
            'shortname' => 'required|min:2|max:20',
            'seo_keyword' => 'required|min:30|max:150',
            'seo_description' => 'required|min:40|max:200',
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
            $this->competitiveexamrepo->store($collection);

            DB::commit();
            return redirect()->route('competitiveexam.index');
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
     * @param  \App\Models\Admin\Category\competitiveexam  $competitiveexam
     * @return \Illuminate\Http\Response
     */
    public function show(Competitiveexam $competitiveexam)
    {
        return view('/admin/exam/master/competitiveexam/show', compact('competitiveexam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category\competitiveexam  $competitiveexam
     * @return \Illuminate\Http\Response
     */
    public function edit(Competitiveexam $competitiveexam)
    {
        return view('/admin/exam/master/competitiveexam/createorupdate', compact('competitiveexam'));
    }

}
