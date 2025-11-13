<?php

namespace App\Http\Controllers\Website\Web\Seo;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Categoryblog;
use App\Models\Admin\Blog\Postblog;
use App\Models\Admin\Blog\Tagblog;
use App\Models\Admin\Exam\Master\Competitiveexam;
use App\Models\Admin\Job\Jobmaster\Branchjob;
use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Models\Admin\Job\Jobmaster\Coursejob;
use App\Models\Admin\Job\Jobmaster\Designationjob;
use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Models\Admin\Job\Jobmaster\Rolejob;
use App\Models\Admin\Job\Jobmaster\Skilljob;
use App\Models\Admin\Job\Jobmaster\Tagjob;
use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Models\Admin\Job\Jobpost\Postjob;
use App\Models\Admin\Video\Categoryvideo;
use App\Models\Admin\Video\Postvideo;
use App\Models\Admin\Video\Tagvideo;

class SitemapController extends Controller
{

    public function index()
    {

        return response()->view('website.sitemap.index')
            ->header('Content-Type', 'text/xml');
    }

    public function jobs()
    {
        $data = Postjob::latest()->get();
        $path = 'jobs';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobscategories()
    {
        $data = Categoryjob::latest()->get();
        $path = 'jobs/category';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobstags()
    {
        $data = Tagjob::latest()->get();
        $path = 'jobs/tag';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }

    public function jobbranches()
    {
        $data = Branchjob::latest()->get();
        $path = 'jobs/branch';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobcompanies()
    {
        $data = Companyjob::latest()->get();
        $path = 'jobs/company';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobcourses()
    {
        $data = Coursejob::latest()->get();
        $path = 'jobs/course';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobdesignation()
    {
        $data = Designationjob::latest()->get();
        $path = 'jobs/designation';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function joblanguages()
    {
        $data = Languagejob::latest()->get();
        $path = 'jobs/language';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobroles()
    {
        $data = Rolejob::latest()->get();
        $path = 'jobs/role';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobsills()
    {

        $data = Skilljob::latest()->get();
        $path = 'jobs/skill';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobtypes()
    {

        $data = Typejob::latest()->get();
        $path = 'jobs/type';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function jobcompetitiveexams()
    {

        $data = Competitiveexam::latest()->get();
        $path = 'jobs/competitiveexam';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }

    public function blogs()
    {

        $data = Postblog::latest()->get();
        $path = 'jobs-blog';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function blogscategories()
    {

        $data = Categoryblog::latest()->get();
        $path = 'jobs-blog/category';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function blogstags()
    {

        $data = Tagblog::latest()->get();
        $path = 'jobs-blog/tag';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }

    public function videos()
    {

        $data = Postvideo::latest()->get();
        $path = 'jobs-video';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }

    public function videoscategories()
    {

        $data = Categoryvideo::latest()->get();
        $path = 'jobs-video/category';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }
    public function videostags()
    {

        $data = Tagvideo::latest()->get();
        $path = 'jobs-video/tag';
        return response()->view('website.sitemap.list', compact('path', 'data'))
            ->header('Content-Type', 'text/xml');
    }

}
