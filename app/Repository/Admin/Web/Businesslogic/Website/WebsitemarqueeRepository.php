<?php

namespace App\Repository\Admin\Web\Businesslogic\Website;

use App\Models\Admin\Website\Websitemarquee;
use App\Models\Helper\Sequenceidhelper;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsitemarqueeRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use App\Models\Helper\Trackmessagehelper;

class WebsitemarqueeRepository implements IWebsitemarqueeRepository
{

    public function index()
    {
        $websitemarquee = Websitemarquee::select(array('id', 'uniqid', 'marquee', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($websitemarquee)
            ->setRowClass(function ($websitemarquee) {
                return ($websitemarquee->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($websitemarquee) {
                return $websitemarquee->created_at->format('d/m/Y H:i:s');
            })
            ->editColumn('marquee', function ($websitemarquee) {
                return strip_tags($websitemarquee->marquee);
            })
            ->addColumn('action', function ($websitemarquee) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('marquee-show')) {
                $action .= '<a href="websitemarquee/' . $websitemarquee->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('marquee-show')) {
                $action .= ' <a href="websitemarquee/' . $websitemarquee->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Websitemarquee');

        $collection['active'] = request()->has('active');

        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            Websitemarquee::where('id', request()->id)->update($collection);
            toast('Websitemarquee Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Websitemarquee';
        } else {
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'MQ', 'App\Models\Admin\Website\Websitemarquee');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Websitemarquee::create($collection);
            toast('New Websitemarquee Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Websitemarquee';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Websitemarquee', $sessionid, 'WEB');
    }

}
