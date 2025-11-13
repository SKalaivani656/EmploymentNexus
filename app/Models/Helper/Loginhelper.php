<?php

namespace App\Models\Helper;

use App\Models\Helper\Loginhelper;
use App\Models\Miscellaneous\Logininfo;
use App\Models\Miscellaneous\Tracking;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class Loginhelper extends Model
{

/// need to clean up this file

    public static function deviceInfo($sessionid, $user, $function)
    {

        try {
            $agent = new Agent();
            $insertData = array(
                'device' => $agent->device(),
                'robot' => $agent->robot(),
                'browser' => $agent->browser(),
                'browser_v' => $agent->version($agent->browser()),
                'platform' => $agent->platform(),
                'platform_v' => $agent->version($agent->platform()),
                'languages' => json_encode($agent->languages()),
                'serverIp' => request()->ip(),
                'clientIp' => Loginhelper::getIp(),
                'user_id' => Auth::guard($user)->user()->id,
                'user_code' => Auth::guard($user)->user()->user_code,
                'panel' => ($user == 'web') ? 'ADMIN' : strtoupper($user),
                'user_name' => Auth::guard($user)->user()->name,
                'user_uniqid' => Auth::guard($user)->user()->uniqid,
                'login_status' => true,
                'email' => Auth::guard($user)->user()->email,
                'sessionid' => $sessionid,
            );
            $tracking = Auth::guard($user)->user()->name . ' - ' . $function . ' Session Id : ' . $sessionid . ', Logged Platform Device : ' . $agent->platform() . ', ' . $agent->browser();
            Log::info('Login :' . $tracking);

            Logininfo::create($insertData);
            Loginhelper::trackingInfo($tracking, $sessionid, $user, $function);

        } catch (Exception $e) {
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error one - Session ID : ' . $sessionid . ' login deviceInfo -' . $e->getMessage());
            Auth::guard($user)->logout();
        } catch (\Illuminate\Database\QueryException$e) {
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error two - Session ID : ' . $sessionid . ' login deviceInfo -' . $e->getMessage());
            Auth::guard($user)->logout();
        } catch (PDOException $e) {
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error three - Session ID : ' . $sessionid . ' login deviceInfo -' . $e->getMessage());
            Auth::guard($user)->logout();
        }
    }

    public static function trackingInfo($trackmsg, $sessionid, $user, $function)
    {
        try {
            Tracking::create([
                'details' => $trackmsg,
                'name' => Auth::guard($user)->user()->name,
                'user_id' => Auth::guard($user)->user()->id,
                'user_uniqid' => Auth::guard($user)->user()->uniqid,
                'user_code' => Auth::guard($user)->user()->user_code,
                'sessionid' => $sessionid,
                'panel' => ($user == 'web') ? 'ADMIN' : strtoupper($user),
                'function' => $function,
                'portal' => 'WEB',
            ]);
            toast('Hi ' . Auth::guard($user)->user()->name . ', !! You have logged in Successfully', 'success', 'top-right')
                ->persistent("Close");

        } catch (Exception $e) {
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error one - Session ID : ' . $sessionid . ' login trackingInfo ' . $e->getMessage());
            Auth::guard($user)->logout();
        } catch (\Illuminate\Database\QueryException$e) {
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error two - Session ID : ' . $sessionid . ' login trackingInfo' . $e->getMessage());
            Auth::guard($user)->logout();
        } catch (PDOException $e) {
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            Log::error('Error three - Session ID : ' . $sessionid . ' login trackingInfo' . $e->getMessage());
            Auth::guard($user)->logout();
        }
    }

    public static function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

}
