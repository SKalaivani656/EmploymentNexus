<?php

namespace App\Http\Controllers\Website\Web\Job;

use App\Http\Controllers\Controller;
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
use App\Models\Admin\Worldinfo\City;
use App\Models\Admin\Worldinfo\Country;
use App\Models\Admin\Worldinfo\State;
use Illuminate\Support\Str;

class WebjobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Postjob::where('active', true)->latest()->first();
        $classifyname = 'all';
        return view('website/job/home',
            compact('data', 'classifyname'));
    }

    public function jobtype()
    {

        $classifyname = request()->type;

        switch ($classifyname) {
            case "category":
                $data = Categoryjob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "tag":
                $data = Tagjob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "designation":
                $data = Designationjob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "branch":
                $data = Branchjob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "course":
                $data = Coursejob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "company":
                $data = Companyjob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "role":
                $data = Rolejob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "skill":
                $data = Skilljob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "language":
                $data = Languagejob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "type":
                $data = Typejob::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;
            case "competitiveexam":
                $data = Competitiveexam::where('active', true)
                    ->where('slug', request()->slug)
                    ->first();
                break;

            case "country":
                $data = Country::where('active', true)
                    ->where('name', Str::slug(request()->slug, ' '))
                    ->first();
                break;
            case "state":
                $data = State::where('active', true)
                    ->where('name', Str::slug(request()->slug, ' '))
                    ->first();
                break;
            case "city":
                $data = City::where('active', true)
                    ->where('name', Str::slug(request()->slug, ' '))
                    ->first();
                break;
            default:
                return redirect()->back();
        }

        return view('website/job/home', compact('data', 'classifyname'));

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Employee\Adminemployeedevicetoken  $adminemployeedevicetoken
     * @return \Illuminate\Http\Response
     */
    public function show(Postjob $postjob)
    {
        return view('website/job/jobdescription', compact('postjob'));
    }

    public function listdata($list)
    {

        switch ($list) {
            case "category":
                $data = Categoryjob::where('active', true)->get();
                break;
            case "tag":
                $data = Tagjob::where('active', true)->get();
                break;
            case "designation":
                $data = Designationjob::where('active', true)->get();
                break;
            case "branch":
                $data = Branchjob::where('active', true)->get();
                break;
            case "course":
                $data = Coursejob::where('active', true)->get();
                break;
            case "company":
                $data = Companyjob::where('active', true)->get();
                break;
            case "role":
                $data = Rolejob::where('active', true)->get();
                break;
            case "skill":
                $data = Skilljob::where('active', true)->get();
                break;
            case "language":
                $data = Languagejob::where('active', true)->get();
                break;
            case "type":
                $data = Typejob::where('active', true)->get();
                break;
            case "country":
                $data = Country::where('active', true)->get();
                break;
            case "competitiveexam":
                $data = Competitiveexam::where('active', true)->get();
                break;
            case "state":
                $data = State::where('active', true)->where('country_id', 101)->get();
                break;
            case "city":
                $data = City::where('active', true)->get();
                break;
            default:
                return redirect()->back();
        }

        return view('website/job/joblist', compact('data', 'list'));
    }

}
