<?php

namespace App\Repository\Admin\Web\Businesslogic\Settings\Employee;

use App\Models\Admin\Auth\User;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Settings\Employee\IAddemployeeRepository;
use App\Traits\UploadTrait;
use Auth;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class AddemployeeRepository implements IAddemployeeRepository
{
    use UploadTrait;

    public function index()
    {
        $addemployee = User::where('email', '!=', 'preparenext@gmail.com')
            ->select(array('id', 'uniqid', 'name', 'is_accountactive', 'email', 'created_by', 'created_at'));
        return DataTables::of($addemployee)
            ->editColumn('created_at', function ($addemployee) {
                return $addemployee->created_at->format('d/m/Y H:i:s');
            })
            ->editColumn('is_accountactive', function ($addemployee) {
                if ($addemployee->is_accountactive) {
                    return 'Active';
                } else {
                    return 'In Active';
                }

                return 'NA';
            })
            ->addColumn('action', function ($addemployee) {

                $action = '<td class="text-right">';
                if (auth()->user()->can('addemployee-show')) {
                    $action .= '<a href="addemployee/' . $addemployee->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('addemployee-edit')) {
                    $action .= ' <a href="addemployee/' . $addemployee->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                }
                $action .= ' </td>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function createorupdate($collection = [])
    {
        $sessionid = request()->session()->get('sessionid');
        Log::info("SessionID " . $sessionid . ' Function : add/edit User');

        if (request()->hasFile('avatar')) {
            $collection['avatar'] = $this->uploadOne(request()->file('avatar'), '/images/avatar/images/', '/images/avatar/thumbnail/', 'App\Models\Admin\Auth\User', 70, [250, 125]);
        }

        $collection['active'] = true;
        //dd($collection);
        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            User::where('id', request()->id)->update($collection);
            $user = User::find(request()->id);
            DB::table('model_has_roles')->where('model_id', request()->id)->delete();
            $user->assignRole(request()->role);
            $user->save();
            toast('Employee Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Employee';
        } else {
            $uniqueId = Sequenceidhelper::getNextSequenceId(5, 'EMP', 'App\Models\Admin\Auth\User');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;
            User::create($collection)->assignRole(request()->role);

            toast('New Employee Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Employee';
        }

        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT Addemployee', $sessionid, 'WEB');

    }

}
