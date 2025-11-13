<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmaster;

use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICompanyjobRepository;
use App\Traits\UploadTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CompanyjobRepository implements ICompanyjobRepository
{

    use UploadTrait;

    public function index()
    {
        $companyjob = Companyjob::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($companyjob)
            ->setRowClass(function ($companyjob) {
                return ($companyjob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($companyjob) {
                return $companyjob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($companyjob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('companyjob-show')) {
                    $action .= '<a href="companyjob/' . $companyjob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('companyjob-edit')) {
                    $action .= ' <a href="companyjob/' . $companyjob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Companyjob');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_image'] = request()->has('is_image');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/companyjob/images/', '/images/companyjob/thumbnail/', 'App\Models\Admin\Job\Jobmaster\Companyjob', 60, [70, 70]);
        }

        if (!empty(request()->id)) {
            $companyjob = Companyjob::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $companyjob->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $companyjob->update($collection);
            toast('Companyjob Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Companyjob';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'COM', 'App\Models\Admin\Job\Jobmaster\Companyjob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Companyjob::create($collection);
            toast('New Companyjob Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Companyjob';

        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Company Job', $sessionid, 'WEB');
    }

}
