<?php

namespace App\Models\Helper;

use App\Models\Miscellaneous\Tracking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Trackmessagehelper extends Model
{
    public static function trackmessage($trackmsg, $panel, $function, $sessionid, $portal)
    {
        $user = Auth::user();
        Tracking::create([
            'details' => $trackmsg,
            'name' => ($user) ? $user->name : '',
            'user_id' => ($user) ? $user->id : 0,
            'user_uniqid' => ($user) ? $user->uniqid : '',
            'sessionid' => $sessionid,
            'panel' => $panel,
            'function' => $function,
            'portal' => $portal,
        ]);
    }

}
