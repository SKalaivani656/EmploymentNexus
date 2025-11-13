<?php

namespace App\Http\Controllers\Admin\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Postblog;
use App\Repository\Admin\Web\Interfacelayer\Blog\IPostblogRepository;
use Carbon\Carbon;
use File;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostblogController extends Controller
{

    public $postblogrepo;

    public function __construct(IPostblogRepository $postblogrepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:postblog-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:postblog-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:postblog-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:postblog-show', ['only' => ['show']]);
        // $this->middleware('permission:postblog-delete', ['only' => ['destroy']]);

        $this->postblogrepo = $postblogrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->postblogrepo->index();
        }
        return view('admin/blog/postblog/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Postblog $postblog)
    {
        $countries = $this->postblogrepo->create();
        $postblog->posted_on = Carbon::now();
        return view('/admin/blog/postblog/createorupdate', compact('postblog', 'countries'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'title' => 'required|min:30|max:80|unique:postblogs,title,' . $request->id,
            'subtitle' => 'required|min:30|max:100',
            'slug' => 'required|min:20|max:80',
            'seo_keyword' => 'required|min:30|max:150',
            'seo_description' => 'required|min:40|max:200',
            'image_alttag' => 'required',
            'short_description' => 'required|min:20',
            'body' => 'required|min:40',
            'posted_on' => 'required|date',
            'position' => 'nullable|numeric',
            'video_link' => 'nullable|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'schemaorg' => 'required',
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
            $this->postblogrepo->store($collection);
            DB::commit();
            return redirect()->route('postblog.index');
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
     * @param  \App\Models\Admin\Post\postblog  $postblog
     * @return \Illuminate\Http\Response
     */
    public function show(Postblog $postblog)
    {
        return view('/admin/blog/postblog/show', compact('postblog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Post\Branchjob  $Branchjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Postblog $postblog)
    {
        $countries = $this->postblogrepo->edit();
        return view('/admin/blog/postblog/createorupdate', compact('postblog', 'countries'));
    }

    public function ajaxcategorylistblog()
    {
        return $this->postblogrepo->ajaxcategorylistblog();
    }

    public function blogcontentimagedel(Request $request)
    {
        if ($request->get('src')) {
            $path = (explode("images/blog/blogcontent/", $request->get('src')));
            File::delete(public_path('/images/blog/blogcontent/' . $path[1]));
            echo 'deleted successfully';
        }
    }
}
