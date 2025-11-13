<?php

namespace App\Repository\Website\Api\Businesslogic\Employee;

use App\Models\Employee\Auth\Employee;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Website\Api\Interfacelayer\Employee\IEmployeewebapiRepository;
use DB;
use Illuminate\Support\Str;

class EmployeewebapiRepository implements IEmployeewebapiRepository
{
    public function devicetoken()
    {
        Employee::create([
            'device_token' => request('device_token'),
            'device_model' => request('device_model'),
            'device_brand' => request('device_brand'),
            'device_manufacturer' => request('device_manufacturer'),
        ]);

        $trackmsg = 'New Token Updted Successfully';
        Trackmessagehelper::trackmessage($trackmsg, 'EMPLOYEE', 'devicetoken', (string) Str::uuid(), 'API');
        DB::commit();
        return [true, [], $trackmsg];
    }

    public function subscribe()
    {

        $trackmsg = 'New Email Subscribed Successfully';
        Trackmessagehelper::trackmessage($trackmsg, 'EMPLOYEE', 'devicetoken', (string) Str::uuid(), 'API');
        DB::commit();
        return [true, [], $trackmsg];
    }

}
