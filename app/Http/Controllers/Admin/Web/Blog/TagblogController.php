<?php

namespace App\Http\Controllers\Admin\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Tagblog;
use App\Repository\Admin\Web\Interfacelayer\Blog\ITagblogRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagblogController extends Controller
{

    public $tagblogrepo;

    public function __construct(ITagblogRepository $tagblogrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:tagblog-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:tagblog-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tagblog-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:tagblog-show', ['only' => ['show']]);
        // $this->middleware('permission:tagblog-delete', ['only' => ['destroy']]);

        $this->tagblogrepo = $tagblogrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->tagblogrepo->index();
        }
        return view('admin/blog/tagblog/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tagblog $tagblog)
    {
        return view('/admin/blog/tagblog/createorupdate', compact('tagblog'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'name' => 'required|max:80|unique:tagblogs,name,' . $request->id,
            'shortname' => 'required|min:2|max:20|unique:tagblogs,shortname,' . $request->id,
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
            $this->tagblogrepo->store($collection);
            DB::commit();
            return redirect()->route('tagblog.index');
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
     * @param  \App\Models\Admin\Tag\tagblog  $tagblog
     * @return \Illuminate\Http\Response
     */
    public function show(Tagblog $tagblog)
    {
        return view('/admin/blog/tagblog/show', compact('tagblog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Tag\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagblog $tagblog)
    {
        return view('/admin/blog/tagblog/createorupdate', compact('tagblog'));
    }
}
