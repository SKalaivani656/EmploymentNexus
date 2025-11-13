<?php

namespace App\Http\Controllers\Admin\Web\Website;

use App\Http\Controllers\Controller;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsiteenquiryRepository;
use Illuminate\Http\Request;

class WebsiteenquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $websiteenquiryrepo;

    public function __construct(IWebsiteenquiryRepository $websiteenquiryrepo)
    {
        $this->middleware(['auth']);
      

        $this->websiteenquiryrepo = $websiteenquiryrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->websiteenquiryrepo->index();
        }
        return view('admin/website/websiteenquiry/index');
    }

    public function show(Websiteenquiry $websiteenquiry)
    {
        return view('/admin/website/websiteenquiry/show', compact('websiteenquiry'));
    }

}
