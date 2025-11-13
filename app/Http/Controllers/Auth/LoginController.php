<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Helper\Loginhelper;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showadminloginform()
    {
        return view('admin.auth.login');
    }

    public function adminlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            if (Auth::user()->is_accountactive != true) {
                Auth::logout();
                toast('Your Account Has Not Been Activated', 'error', 'top-right');
                return back()->withInput($request->only('phone', 'remember'));
            }

            $sessionid = (string) Str::uuid();
            $request->session()->put('sessionid', $sessionid);
            Loginhelper::deviceInfo($sessionid, 'web', 'Web Login Admin');
            return redirect()->intended('/admin/admindashboard');
        }

        toast('Invalid Credentials, Please Try Again', 'error', 'top-right')->persistent("Close");
        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Log::info("User : " . Auth::user()->name . " Session ID :" . $request->session()->get('sessionid'));
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
