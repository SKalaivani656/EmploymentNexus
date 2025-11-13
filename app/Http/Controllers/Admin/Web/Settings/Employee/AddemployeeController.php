<?php

namespace App\Http\Controllers\Admin\Web\Settings\Employee;

use App\Http\Controllers\Controller;
use App\Models\Admin\Auth\User;
use App\Repository\Admin\Web\Interfacelayer\Settings\Employee\IAddemployeeRepository;
use Auth;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AddemployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IAddemployeeRepository $addemployeerepo)
    {
        $this->middleware(['auth']);
        $this->middleware('permission:addemployee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:addemployee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:addemployee-delete', ['only' => ['destroy']]);
        $this->addemployeerepo = $addemployeerepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables)
    {
        if (request()->ajax()) {

            return $this->addemployeerepo->index();
        }
        return view('admin/settings/addemployee/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $addemployee)
    {
        $role = Role::pluck('name', 'id')->all();
        return view('/admin/settings/addemployee/createorupdate', compact('addemployee', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function checkvalidation($request)
    {
        return $this->validate($request, [

            'name' => 'required|min:5|max:35',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'is_accountactive' => 'required',
            'address' => 'nullable|max:255',
            'remarks' => 'nullable|max:255',

        ]);

    }

    public function store(Request $request)
    {

        //   return $request->all();
        try {
            $collection = $this->checkvalidation($request);
            $collection['password'] = Hash::make($collection['password']);

            if (request()->file('avatar')) {
                $this->validate(request(), [
                    'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }

            $this->addemployeerepo->createorupdate($collection, $request);
            DB::commit();
            return redirect()->route('addemployee.index');

        } catch (Exception $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        } catch (PDOException $e) {
            DB::rollback();
            toast('ERROR : ' . $e->getMessage(), 'error', 'top-right')->persistent("Close");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Model\/updates\addemployee
     * @return \Illuminate\Http\Response
     */
    public function show(User $addemployee)
    {
        $role = Role::where('id', $addemployee->role)->first();
        return view('/admin/settings/addemployee/profile', compact('addemployee', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Model\/updates\addemployee
     * @return \Illuminate\Http\Response
     */
    public function edit(User $addemployee)
    {
        // return $addemployee;
        $addemployee->password = '';
        $role = Role::pluck('name', 'id')->all();
        return view('/admin/settings/addemployee/createorupdate', compact('addemployee', 'role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Model\/updates\addemployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $user->delete();
        // toast('Deleted Successfully', 'error', 'top-right');
        // return redirect()->route('addemployee.index');
    }

    public function profile()
    {
        $addemployee = User::findOrFail(Auth::user()->id);
        return view('/admin/settings/addemployee/profile', compact('addemployee'));
    }

    public function changepasswordform()
    {
        return view('/admin/settings/addemployee/changepassword');
    }
    public function changepassword(Request $request)
    {
        try {
            $validator = $this->validate($request, [
                'current-password' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);

            if (Hash::check($request['current-password'], Auth::user()->password)) {
                $user_id = Auth::user()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request['password']);
                $obj_user->save();
                alert()->success('SUCCESS', 'Password Changed Successfully');
                return redirect()->back();
            } else {
                toast('Invalid Current Password', 'error', 'top-right')->persistent("Close");
                return redirect()->back();
            }

        } catch (Exception $e) {
            return $e;
        }

    }
}
