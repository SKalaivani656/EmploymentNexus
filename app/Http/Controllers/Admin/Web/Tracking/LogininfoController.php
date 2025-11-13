<?php

namespace App\Http\Controllers\Admin\Web\Tracking;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Logininfo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LogininfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginlogs(DataTables $datatables)
    {
        if (request()->ajax()) {
            $logininfo = Logininfo::select(array('id', 'user_name', 'email', 'device', 'browser', 'platform', 'serverIp', 'clientIp', 'login_status', 'created_at'));
            return DataTables::of($logininfo)
                ->make(true);
        }
        return view('/admin/tracking/logs/loginlogs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Miscellaneous\Logininfo  $logininfo
     * @return \Illuminate\Http\Response
     */
    public function show(Logininfo $logininfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Miscellaneous\Logininfo  $logininfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logininfo $logininfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Miscellaneous\Logininfo  $logininfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logininfo $logininfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Miscellaneous\Logininfo  $logininfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logininfo $logininfo)
    {
        //
    }
}
