<?php

namespace App\Http\Controllers\Admin\Web\Settings\Configuration;

use App\Http\Controllers\Controller;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdminconfigurationkeyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminconfigurationkeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $adminconfigkeyrepo;

    public function __construct(IAdminconfigurationkeyRepository $adminconfigkeyrepo)
    {
        $this->middleware(['auth']);

        $this->adminconfigkeyrepo = $adminconfigkeyrepo;
    }

    public function index()
    {
        return $this->adminconfigkeyrepo->index();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $sessionid = $request->session()->get('sessionid');
            Log::info("SessionID " . $sessionid . ' Function : adminconfiguration');

            $collection = $this->checkvalidation($request);

            DB::beginTransaction();
            $this->adminconfigkeyrepo->store($collection);
            DB::commit();

            toast('Admin Configuration Updated', 'success', 'top-right')->persistent("Close");

            return redirect()->route('adminconfigurationkey.index');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
    }

    public function checkvalidation($request)
    {
        return $this->validate($request, [

            "email_from_name" => 'required',
            "email_from_mail" => 'required',
            "email_mail_driver" => 'required',
            "email_mail_host" => 'required',
            "email_mail_port" => 'required',
            "email_mail_username" => 'required',
            "email_mail_password" => 'nullable',
            "email_mail_encryption" => 'required',

            'mailchimpflag' => 'nullable',
            'mailchimpapikey' => 'nullable',
            'mailchimplistid' => 'nullable',

            'recaptchasecretstatus' => 'nullable',
            'recaptchasitekey' => 'required',
            'recaptchasecretkey' => 'required',

            'algoliaapp' => 'nullable',
            'algoliasecret' => 'nullable',

            'searchstatus' => 'required',
        ]);

    }

}
