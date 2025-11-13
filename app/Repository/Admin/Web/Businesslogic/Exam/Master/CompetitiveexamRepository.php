<?php

namespace App\Repository\Admin\Web\Businesslogic\Exam\Master;

use App\Models\Admin\Exam\Master\Competitiveexam;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Exam\Master\ICompetitiveexamRepository;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CompetitiveexamRepository implements ICompetitiveexamRepository
{

    public function index()
    {
        $competitiveexam = Competitiveexam::select(array('id', 'uniqid', 'name', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($competitiveexam)
            ->setRowClass(function ($competitiveexam) {
                return ($competitiveexam->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($competitiveexam) {
                return $competitiveexam->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($competitiveexam) {
                $action = '<td class="text-right">';
                // if (auth()->user()->can('branch-show')) {
                $action .= '<a href="competitiveexam/' . $competitiveexam->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                // }
                // if (auth()->user()->can('branch-edit')) {
                $action .= ' <a href="competitiveexam/' . $competitiveexam->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                // }
                $action .= ' </td>';
                return $action;
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);
    }

    public function store($collection = [])
    {
        $sessionid = request()->session()->get('sessionid');
        Log::info("SessionID " . $sessionid . ' Function : add/edit competitive Exam');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['is_leftsidemenu'] = request()->has('is_leftsidemenu');
        $collection['is_footer'] = request()->has('is_footer');
        $collection['is_mobile'] = request()->has('is_mobile');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (!empty(request()->id)) {
            $competitiveexam = Competitiveexam::find(request()->id);
            $collection['seo_title'] = request('name') . ' - ' . $competitiveexam->created_at->format('Y') . ' jobs preparenext.com';
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $competitiveexam->update($collection);
            toast('Competitiveexam Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Competitive Exam';
        } else {
            $collection['seo_title'] = request('name') . ' - ' . date('Y') . ' jobs preparenext.com';
            $uniqueId = Sequenceidhelper::getNextSequenceId(7, 'COM', 'App\Models\Admin\Exam\Master\Competitiveexam');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            Competitiveexam::create($collection);
            toast('New Competitive Exam Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Competitive Exam';
        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Competitive Exam', $sessionid, 'WEB');
    }

}
