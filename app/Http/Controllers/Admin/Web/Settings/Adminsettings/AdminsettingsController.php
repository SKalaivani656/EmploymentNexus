<?php

namespace App\Http\Controllers\Admin\Web\Settings\Adminsettings;

use App\Http\Controllers\Controller;

class AdminsettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return view('/admin/settings/settings');
    }

}
