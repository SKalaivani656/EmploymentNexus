<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmaster;

use App\Models\Admin\Job\Jobmaster\Branchjob;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IBranchjobRepository;
use App\Traits\UploadTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BranchjobRepository implements IBranchjobRepository
{

    use UploadTrait;

    public function index()
    {
        $branchjob = Branchjob::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($branchjob)
            ->setRowClass(function ($branchjob) {
                return ($branchjob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($branchjob) {
                return $branchjob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($branchjob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('branchjob-show')) {
                    $action .= '<a href="branchjob/' . $branchjob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('branchjob-edit')) {
                    $action .= ' <a href="branchjob/' . $branchjob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Branchjob');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_image'] = request()->has('is_image');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/branchjob/images/', '/images/branchjob/thumbnail/', 'App\Models\Admin\Job\Jobmaster\Branchjob', 70, [250, 125]);
        }

        if (!empty(request()->id)) {
            $branchjob = Branchjob::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $branchjob->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $branchjob->update($collection);
            toast('Branchjob Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Branchjob';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'B', 'App\Models\Admin\Job\Jobmaster\Branchjob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Branchjob::create($collection);
            toast('New Branchjob Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Branchjob';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Branch Job', $sessionid, 'WEB');
    }

}
