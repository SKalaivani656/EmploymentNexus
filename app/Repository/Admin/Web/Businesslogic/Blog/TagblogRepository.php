<?php

namespace App\Repository\Admin\Web\Businesslogic\Blog;

use App\Models\Admin\Blog\Tagblog;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Blog\ITagblogRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TagblogRepository implements ITagblogRepository
{

    public function index()
    {
        $tagblog = Tagblog::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($tagblog)
            ->setRowClass(function ($tagblog) {
                return ($tagblog->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($tagblog) {
                return $tagblog->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($tagblog) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('tagblog-show')) {
                    $action .= '<a href="tagblog/' . $tagblog->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('tagblog-edit')) {
                    $action .= ' <a href="tagblog/' . $tagblog->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Tagblog');

        $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;

            $tagblog = Tagblog::find(request()->id);
            $collection['seo_title'] = request('title') . ' - ' . $tagblog->created_at->format('Y') . ' jobs preparenext.com';
            $tagblog->fill($collection);
            $tagblog->save();

            toast('Tag Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Tag Blog';
        } else {
            $collection['seo_title'] = request('title') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'T', 'App\Models\Admin\Blog\Tagblog');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Tagblog::create($collection);
            toast('New Tag Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Tag Blog';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Tag Blog', $sessionid, 'WEB');
    }

}
