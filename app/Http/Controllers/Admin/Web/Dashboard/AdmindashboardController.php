<?php

namespace App\Http\Controllers\Admin\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Postblog;
use App\Models\Admin\Job\Jobpost\Postjob;
use App\Models\Admin\Video\Postvideo;
use Carbon\Carbon;

class AdmindashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        $data = $this->dashboarddata();
        return view('admin.dashboard.admindashboard', compact('data'));
    }

    protected function dashboarddata()
    {

        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight", $previous_week);
        $end_week = strtotime("next saturday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);

        $data['todayjobs'] = Postjob::where('active', true)->whereDate('posted_on', Carbon::today())->count();
        $data['yesterdayjobs'] = Postjob::where('active', true)->whereDate('posted_on', Carbon::yesterday())->count();
        $data['currentweekjobs'] = Postjob::where('active', true)->whereBetween('posted_on', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['lastweekjobs'] = Postjob::where('active', true)->whereBetween('posted_on', [$start_week, $end_week])->count();
        $data['currentmonthjobs'] = Postjob::where('active', true)->whereMonth('posted_on', '=', Carbon::now()->subMonth()->month)->count();
        $data['lastmonthjobs'] = Postjob::where('active', true)->whereMonth('posted_on', '=', Carbon::now()->subMonth()->month)->count();
        $data['draftjobs'] = Postjob::where('active', false)->count();
        $data['totaljobs'] = Postjob::where('active', true)->count();

        $data['todayblogs'] = Postblog::where('active', true)->whereDate('posted_on', Carbon::today())->count();
        $data['yesterdayblogs'] = Postblog::where('active', true)->whereDate('posted_on', Carbon::yesterday())->count();
        $data['currentweekblogs'] = Postblog::where('active', true)->whereBetween('posted_on', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['lastweekblogs'] = Postblog::where('active', true)->whereBetween('posted_on', [$start_week, $end_week])->count();
        $data['currentmonthblogs'] = Postblog::where('active', true)->whereMonth('posted_on', '=', Carbon::now()->subMonth()->month)->count();
        $data['lastmonthblogs'] = Postblog::where('active', true)->whereMonth('posted_on', '=', Carbon::now()->subMonth()->month)->count();
        $data['draftblogs'] = Postblog::where('active', false)->count();
        $data['totalblogs'] = Postblog::where('active', true)->count();

        $data['todayvideos'] = Postvideo::where('active', true)->whereDate('posted_on', Carbon::today())->count();
        $data['yesterdayvideos'] = Postvideo::where('active', true)->whereDate('posted_on', Carbon::yesterday())->count();
        $data['currentweekvideos'] = Postvideo::where('active', true)->whereBetween('posted_on', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['lastweekvideos'] = Postvideo::where('active', true)->whereBetween('posted_on', [$start_week, $end_week])->count();
        $data['currentmonthvideos'] = Postvideo::where('active', true)->whereMonth('posted_on', '=', Carbon::now()->subMonth()->month)->count();
        $data['lastmonthvideos'] = Postvideo::where('active', true)->whereMonth('posted_on', '=', Carbon::now()->subMonth()->month)->count();
        $data['draftvideos'] = Postvideo::where('active', false)->count();
        $data['totalvideos'] = Postvideo::where('active', true)->count();

        return $data;
    }

}
