<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmaster;

use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ITypejobRepository;
use App\Traits\UploadTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TypejobRepository implements ITypejobRepository
{

    use UploadTrait;

    public function index()
    {
        $typejob = Typejob::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($typejob)
            ->setRowClass(function ($typejob) {
                return ($typejob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($typejob) {
                return $typejob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($typejob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('typejob-show')) {
                    $action .= '<a href="typejob/' . $typejob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('typejob-edit')) {
                    $action .= ' <a href="typejob/' . $typejob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit typejob');

        $collection['active'] = request()->has('active');
        $collection['is_image'] = request()->has('is_image');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/typejob/images/', '/images/typejob/thumbnail/', 'App\Models\Admin\Job\Jobmaster\Typejob', 70, [250, 125]);
        }

        if (!empty(request()->id)) {
            $typejob = Typejob::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $typejob->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $typejob->update($collection);
            toast('Typejob Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing typejob';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'TYPE', 'App\Models\Admin\Job\Jobmaster\Typejob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Typejob::create($collection);
            toast('New Typejob Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Typejob';

        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Type Job', $sessionid, 'WEB');
    }

}
