<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmiscellaneous;

use App\Models\Admin\Job\Jobmiscellaneous\Jobnavlink;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmiscellaneous\IJobnavlinkRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class JobnavlinkRepository implements IJobnavlinkRepository
{

    public function index()
    {
        $jobnavlink = Jobnavlink::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($jobnavlink)
            ->setRowClass(function ($jobnavlink) {
                return ($jobnavlink->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($jobnavlink) {
                return $jobnavlink->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($jobnavlink) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('jobnavlink-show')) {
                $action .= '<a href="jobnavlink/' . $jobnavlink->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('jobnavlink-edit')) {
                $action .= ' <a href="jobnavlink/' . $jobnavlink->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                }
                $action .= ' </td>';
                return $action;
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);
    }

    public function store($collection = [])
    {
        $sessionid = request()->session()->get('sessionid');
        Log::info("SessionID " . $sessionid . ' Function : add/edit jobnavlink');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['is_footer'] = request()->has('is_footer');

        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            Jobnavlink::where('id', request()->id)->update($collection);
            toast('Jobnavlink Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Jobnavlink';
        } else {
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'J', 'App\Models\Admin\Job\Jobmiscellaneous\Jobnavlink');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Jobnavlink::create($collection);
            toast('New Jobnavlink Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Jobnavlink';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Jobnavlink', $sessionid, 'WEB');
    }

}
