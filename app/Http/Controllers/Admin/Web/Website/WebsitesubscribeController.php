<?php

namespace App\Http\Controllers\Admin\Web\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Website\Websitesubscribe;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsitesubscribeRepository;
use Illuminate\Http\Request;

class WebsitesubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $websitesubscriberepo;

    public function __construct(IWebsitesubscribeRepository $websitesubscriberepo)
    {
        $this->middleware(['auth']);
       
        $this->websitesubscriberepo = $websitesubscriberepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->websitesubscriberepo->index();
        }
        return view('admin/website/websitesubscribe/index');
    }

    public function show(Websitesubscribe $websitesubscribe)
    {
        return view('/admin/website/websitesubscribe/show', compact('websitesubscribe'));
    }

}
