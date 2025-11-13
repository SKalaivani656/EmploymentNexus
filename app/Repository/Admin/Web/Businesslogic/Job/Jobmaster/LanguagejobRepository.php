<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobmaster;

use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ILanguagejobRepository;
use App\Traits\UploadTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class LanguagejobRepository implements ILanguagejobRepository
{
    use UploadTrait;

    public function index()
    {
        $languagejob = Languagejob::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($languagejob)
            ->setRowClass(function ($languagejob) {
                return ($languagejob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($languagejob) {
                return $languagejob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($languagejob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('languagejob-show')) {
                    $action .= '<a href="languagejob/' . $languagejob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('languagejob-edit')) {
                    $action .= ' <a href="languagejob/' . $languagejob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
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
        Log::info("SessionID " . $sessionid . ' Function : add/edit Languagejob');

        $collection['active'] = request()->has('active');
        $collection['is_image'] = request()->has('is_image');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/languagejob/images/', '/images/languagejob/thumbnail/', 'App\Models\Admin\Job\Jobmaster\Languagejob', 70, [250, 125]);
        }

        if (!empty(request()->id)) {
            $languagejob = Languagejob::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $languagejob->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $languagejob->update($collection);
            toast('languagejob Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Languagejob';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'LANG', 'App\Models\Admin\Job\Jobmaster\Languagejob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Languagejob::create($collection);
            toast('New Languagejob Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Language Job';

        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Language Job', $sessionid, 'WEB');
    }

}
