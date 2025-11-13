<?php

namespace App\Http\Controllers\Website\Web\Mobileapp;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Postblog;
use App\Models\Admin\Job\Jobpost\Postjob;

class MobileappController extends Controller
{

    public function jobdescription($uuid)
    {
        $postjob = Postjob::where('uuid', $uuid)->first();
        return view('website/mobileapp/jobdescription', compact('postjob'));
    }

    public function blogdescription($uuid)
    {
        $postblog = Postblog::where('uuid', $uuid)->first();
        return view('website/mobileapp/blogdescription', compact('postblog'));
    }
}
