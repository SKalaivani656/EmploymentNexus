<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmaster;

use App\Models\Admin\Job\Jobmaster\Tagjob;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ITagjobRepository;
use App\Traits\UploadTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TagjobRepository implements ITagjobRepository
{

    use UploadTrait;

    public function index()
    {
        $tagjob = Tagjob::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($tagjob)
            ->setRowClass(function ($tagjob) {
                return ($tagjob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($tagjob) {
                return $tagjob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($tagjob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('tagjob-show')) {
                    $action .= '<a href="tagjob/' . $tagjob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('tagjob-edit')) {
                    $action .= ' <a href="tagjob/' . $tagjob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit tagjob');

        $collection['active'] = request()->has('active');
        $collection['is_image'] = request()->has('is_image');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/tagjob/images/', '/images/tagjob/thumbnail/', 'App\Models\Admin\Job\Jobmaster\Tagjob', 70, [250, 125]);
        }

        if (!empty(request()->id)) {
            $tagjob = Tagjob::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $tagjob->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $tagjob->update($collection);
            toast('Tagjob Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing tagjob';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'TAG', 'App\Models\Admin\Job\Jobmaster\Tagjob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Tagjob::create($collection);
            toast('New Tagjob Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Tagjob';

        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Tag Job', $sessionid, 'WEB');
    }

}
