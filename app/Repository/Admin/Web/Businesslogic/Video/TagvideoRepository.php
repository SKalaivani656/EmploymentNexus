<?php

namespace App\Repository\Admin\Web\Businesslogic\Video;

use App\Models\Admin\Video\Tagvideo;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Video\ITagvideoRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TagvideoRepository implements ITagvideoRepository
{

    public function index()
    {
        $tagvideo = Tagvideo::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($tagvideo)
            ->setRowClass(function ($tagvideo) {
                return ($tagvideo->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($tagvideo) {
                return $tagvideo->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($tagvideo) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('tagvideo-show')) {
                $action .= '<a href="tagvideo/' . $tagvideo->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('tagvideo-edit')) {
                $action .= ' <a href="tagvideo/' . $tagvideo->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit tag Blog');

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

            $tagvideo = Tagvideo::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $tagvideo->created_at->format('Y') . ' jobs preparenext.com';
            $tagvideo->fill($collection);
            $tagvideo->save();

            toast('tag Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing tag Blog';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'T', 'App\Models\Admin\Video\Tagvideo');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Tagvideo::create($collection);
            toast('New Video tag Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Video tag';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Video tag', $sessionid, 'WEB');
    }

}
