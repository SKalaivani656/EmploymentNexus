<?php

namespace App\Repository\Admin\Web\Businesslogic\Settings\Configuration;

use App\Models\Helper\Trackmessagehelper;
use App\Models\Admin\Settings\Configuration\Adminconfigurationkey;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdminconfigurationkeyRepository;

class AdminconfigurationkeyRepository implements IAdminconfigurationkeyRepository
{

    public function index()
    {
        $adminconfigurationkey = Adminconfigurationkey::where('uuid', '88fc5a4d-8283-478b-aba2-8queens')->first();

        return view('/admin/settings/configuration/adminconfigurationkey/createOrUpdate', compact('adminconfigurationkey'));
    }
    public function store($collection = [])
    {

       
        Adminconfigurationkey::where('id', 1)->update($collection);
        $sessionid = request()->session()->get('sessionid');
        Trackmessagehelper::trackmessage('Configuration updated', 'ADMIN', 'ADMIN CONFIGURATION UPDATE', $sessionid, 'WEB');
    }

}
