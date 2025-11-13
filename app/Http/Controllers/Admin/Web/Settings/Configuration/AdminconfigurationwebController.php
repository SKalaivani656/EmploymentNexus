<?php

namespace App\Http\Controllers\Admin\Web\Settings\Configuration;

use App\Http\Controllers\Controller;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdminconfigurationwebRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminconfigurationwebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $adminconfigwebrepo;

    public function __construct(IAdminconfigurationwebRepository $adminconfigwebrepo)
    {
        $this->middleware(['auth']);

        $this->adminconfigwebrepo = $adminconfigwebrepo;
    }

    public function index()
    {
        return $this->adminconfigwebrepo->index();

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
            $this->adminconfigwebrepo->store($collection);
            DB::commit();

            toast('Admin Configuration Updated', 'success', 'top-right')->persistent("Close");

            return redirect()->route('adminconfigurationweb.index');
        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException$e) {
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

            'address_one' => 'required',
            'address_two' => 'nullable',
            'address_three' => 'nullable',
            'phone1' => 'required',
            'phone2' => 'nullable',
            'email' => 'required',
            'website' => 'required',

            'bank_accountname' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'branch' => 'required',

            'theme_color' => 'nullable',
            'text_color' => 'nullable',
            'background_color' => 'nullable',

            'headerbg_color' => 'nullable',
            'headertext_color' => 'nullable',
            'footerbg_color' => 'nullable',
            'footertext_color' => 'nullable',

            'uplode_logo_image' => 'nullable',
            'favicon_image' => 'nullable',
            'disqusflag' => 'nullable',
            'disquscode' => 'nullable',

            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'linkedin' => 'nullable',
            'youtube' => 'nullable',

            'quora' => 'nullable',
            'medium' => 'nullable',
            'reddit' => 'nullable',

            'googleanalyticsapi' => 'nullable',
            'googleanalyticscode' => 'nullable',

            'copyrights' => 'nullable',
            'timezone' => 'required',
            'dateformate' => 'required',
            'dateformat_javascript' => 'nullable',

            'googleadsverticalcode' => 'nullable',
            'googleadshorizontalcode' => 'nullable',

            'socialmediaicon' => 'nullable',
        ]);

    }
}
