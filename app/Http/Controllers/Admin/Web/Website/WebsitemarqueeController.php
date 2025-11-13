<?php

namespace App\Http\Controllers\Admin\Web\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Website\Websitemarquee;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsitemarqueeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsitemarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $websitemarqueerepo;

    public function __construct(IWebsitemarqueeRepository $websitemarqueerepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:marquee-list', ['only' => ['index', 'show', 'create', 'store', 'edit', 'destroy']]);
        $this->middleware('permission:marquee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:marquee-edit', ['only' => ['edit', 'store']]);
        $this->middleware('permission:marquee-show', ['only' => ['show']]);
        // $this->middleware('permission:marquee-delete', ['only' => ['destroy']]);

        $this->websitemarqueerepo = $websitemarqueerepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->websitemarqueerepo->index();
        }
        return view('admin/website/websitemarquee/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Websitemarquee $websitemarquee)
    {
        return view('/admin/website/websitemarquee/createorupdate', compact('websitemarquee'));
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [
            'marquee' => 'required|min:5|unique:websitemarquees,marquee,' . $request->id,
            'marqueetype' => 'nullable|unique:websitemarquees,marqueetype,' . $request->id,
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
            $this->websitemarqueerepo->store($collection);
            DB::commit();
            return redirect()->route('websitemarquee.index');
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
     * @param  \App\Models\Admin\Course\websitemarquee  $websitemarquee
     * @return \Illuminate\Http\Response
     */
    public function show(Websitemarquee $websitemarquee)
    {
        return view('/admin/website/websitemarquee/show', compact('websitemarquee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Course\websitemarquee
     * @return \Illuminate\Http\Response
     */
    public function edit(Websitemarquee $websitemarquee)
    {
        return view('/admin/website/websitemarquee/createorupdate', compact('websitemarquee'));
    }
}
