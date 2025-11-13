<?php

namespace App\Repository\Admin\Web\Businesslogic\Website;

use App\Models\Admin\Website\Websitesubscribe;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsitesubscribeRepository;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class WebsitesubscribeRepository implements IWebsitesubscribeRepository
{

    public function index()
    {

        $websitesubscribe = Websitesubscribe::select(array('id', 'fname', 'uniqid', 'lname', 'email', 'active'))
            ->latest();
        return DataTables::of($websitesubscribe)

            ->editColumn('created_at', function ($websitesubscribe) {
                return Carbon::parse($websitesubscribe->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($websitesubscribe) {
                $action = '<td class="text-right">';

                $action .= '<a href="websitesubscribe/' . $websitesubscribe->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';

                $action .= ' </td>';
                return $action;
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);
    }

}
