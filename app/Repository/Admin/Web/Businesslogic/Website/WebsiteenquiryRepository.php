<?php

namespace App\Repository\Admin\Web\Businesslogic\Website;

use App\Models\Admin\Website\Websiteenquiry;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsiteenquiryRepository;
use Yajra\DataTables\DataTables;

class WebsiteenquiryRepository implements IWebsiteenquiryRepository
{

    public function index()
    {

        $websiteenquiry = Websiteenquiry::select(array('id', 'fname', 'uniqid', 'lname', 'phone', 'email', 'message', 'type', 'note', 'active'))
            ->latest();
        return DataTables::of($websiteenquiry)

            ->editColumn('created_at', function ($websiteenquiry) {
                return $websiteenquiry->created_at->format('d/m/Y H:i:s');
            })
            // ->addColumn('action', function ($websiteenquiry) {
            //     $action = '<td class="text-right">';

            //     $action .= '<a href="websiteenquiry/' . $websiteenquiry->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';

            //     $action .= ' </td>';
            //     return $action;
            // })
            ->rawColumns(['created_at'])
            ->make(true);
    }

}
