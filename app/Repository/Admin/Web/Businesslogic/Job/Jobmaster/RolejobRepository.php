<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmaster;

use App\Models\Admin\Job\Jobmaster\Rolejob;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IRolejobRepository;
use App\Traits\UploadTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class RolejobRepository implements IRolejobRepository
{

    use UploadTrait;

    public function index()
    {
        $rolejob = Rolejob::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($rolejob)
            ->setRowClass(function ($rolejob) {
                return ($rolejob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($rolejob) {
                return $rolejob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($rolejob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('rolejob-show')) {
                    $action .= '<a href="rolejob/' . $rolejob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('rolejob-edit')) {
                    $action .= ' <a href="rolejob/' . $rolejob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Rolejob');

        $collection['active'] = request()->has('active');
        $collection['is_image'] = request()->has('is_image');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/rolejob/images/', '/images/rolejob/thumbnail/', 'App\Models\Admin\Job\Jobmaster\Rolejob', 70, [250, 125]);
        }

        if (!empty(request()->id)) {
            $rolejob = Rolejob::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $rolejob->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $rolejob->update($collection);
            toast('Rolejob Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Rolejob';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'ROLE', 'App\Models\Admin\Job\Jobmaster\Rolejob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Rolejob::create($collection);
            toast('New Rolejob Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Rolejob';

        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Role Job', $sessionid, 'WEB');
    }

}
