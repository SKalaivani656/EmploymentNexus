<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmaster;

use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICategoryjobRepository;
use App\Traits\UploadTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryjobRepository implements ICategoryjobRepository
{

    use UploadTrait;

    public function index()
    {
        $categoryjob = Categoryjob::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($categoryjob)
            ->setRowClass(function ($categoryjob) {
                return ($categoryjob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($categoryjob) {
                return $categoryjob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($categoryjob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('categoryjob-show')) {
                    $action .= '<a href="categoryjob/' . $categoryjob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('categoryjob-edit')) {
                    $action .= ' <a href="categoryjob/' . $categoryjob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Categoryjob');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_image'] = request()->has('is_image');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/categoryjob/images/', '/images/categoryjob/thumbnail/', 'App\Models\Admin\Job\Jobmaster\Categoryjob', 70, [250, 125]);
        }

        if (!empty(request()->id)) {
            $categoryjob = Categoryjob::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $categoryjob->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $categoryjob->update($collection);
            toast('Categoryjob Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Categoryjob';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'CAT', 'App\Models\Admin\Job\Jobmaster\Categoryjob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Categoryjob::create($collection);
            toast('New Categoryjob Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Categoryjob';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Cateogory Job', $sessionid, 'WEB');
    }

}
