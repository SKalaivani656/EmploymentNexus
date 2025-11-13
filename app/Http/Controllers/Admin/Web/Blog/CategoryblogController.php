<?php

namespace App\Http\Controllers\Admin\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Categoryblog;
use App\Repository\Admin\Web\Interfacelayer\Blog\ICategoryblogRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryblogController extends Controller
{

    public $categoryblogrepo;

    public function __construct(ICategoryblogRepository $categoryblogrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:categoryblog-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:categoryblog-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categoryblog-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:categoryblog-show', ['only' => ['show']]);
        // $this->middleware('permission:categoryblog-delete', ['only' => ['destroy']]);

        $this->categoryblogrepo = $categoryblogrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->categoryblogrepo->index();
        }
        return view('admin/blog/categoryblog/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categoryblog $categoryblog)
    {
        return view('/admin/blog/categoryblog/createorupdate', compact('categoryblog'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|min:5|max:35|unique:categoryblogs,name,' . $request->id,
            'shortname' => 'required|min:2|max:20|unique:categoryblogs,shortname,' . $request->id,
            'slug' => 'required|min:20|max:80',
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
            $this->categoryblogrepo->store($collection);
            DB::commit();
            return redirect()->route('categoryblog.index');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (QueryException $e) {
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
     * @param  \App\Models\Admin\Category\categoryblog  $categoryblog
     * @return \Illuminate\Http\Response
     */
    public function show(Categoryblog $categoryblog)
    {
        return view('/admin/blog/categoryblog/show', compact('categoryblog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoryblog $categoryblog)
    {
        return view('/admin/blog/categoryblog/createorupdate', compact('categoryblog'));
    }
}
