<?php

namespace App\Repository\Admin\Web\Businesslogic\Video;

use App\Models\Admin\Video\Categoryvideo;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Video\ICategoryvideoRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryvideoRepository implements ICategoryvideoRepository
{

    public function index()
    {
        $categoryvideo = Categoryvideo::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($categoryvideo)
            ->setRowClass(function ($categoryvideo) {
                return ($categoryvideo->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($categoryvideo) {
                return $categoryvideo->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($categoryvideo) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('categoryvideo-show')) {
                $action .= '<a href="categoryvideo/' . $categoryvideo->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('categoryvideo-edit')) {
                $action .= ' <a href="categoryvideo/' . $categoryvideo->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Category Blog');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;

            $categoryvideo = Categoryvideo::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $categoryvideo->created_at->format('Y') . ' jobs preparenext.com';
            $categoryvideo->fill($collection);
            $categoryvideo->save();

            toast('Category Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Category Blog';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'C', 'App\Models\Admin\Video\Categoryvideo');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Categoryvideo::create($collection);
            toast('New Video Category Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Video Category';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Video Category', $sessionid, 'WEB');
    }

}
