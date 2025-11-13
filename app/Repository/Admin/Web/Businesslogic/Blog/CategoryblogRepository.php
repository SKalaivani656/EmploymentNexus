<?php

namespace App\Repository\Admin\Web\Businesslogic\Blog;

use App\Models\Admin\Blog\Categoryblog;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Blog\ICategoryblogRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryblogRepository implements ICategoryblogRepository
{

    public function index()
    {
        $categoryblog = Categoryblog::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($categoryblog)
            ->setRowClass(function ($categoryblog) {
                return ($categoryblog->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($categoryblog) {
                return $categoryblog->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($categoryblog) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('categoryblog-show')) {
                    $action .= '<a href="categoryblog/' . $categoryblog->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('categoryblog-edit')) {
                    $action .= ' <a href="categoryblog/' . $categoryblog->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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

            $categoryblog = Categoryblog::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $categoryblog->created_at->format('Y') . ' jobs preparenext.com';
            $categoryblog->fill($collection);
            $categoryblog->save();

            toast('Category Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Category Blog';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'C', 'App\Models\Admin\Blog\Categoryblog');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Categoryblog::create($collection);
            toast('New Category Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Category Blog';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Category Blog', $sessionid, 'WEB');
    }

}
