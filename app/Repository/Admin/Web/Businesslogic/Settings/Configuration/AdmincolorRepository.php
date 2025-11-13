<?php

namespace App\Repository\Admin\Web\Businesslogic\Settings\Configuration;

use Yajra\DataTables\DataTables;

use App\Models\Admin\Settings\Configuration\Color;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdmincolorRepository;

class AdmincolorRepository implements IAdmincolorRepository
{

    public function index()
    {
        $color = Color::select(array('id', 'type', 'hexacode', 'is_default'))
                ->latest();
            return DataTables::of($color)
                ->editColumn('is_default', function ($color) {
                    return ($color->is_default == true) ? 'BOOTSTRAP CSS' : 'MATERIAL CSS';
                })

                ->rawColumns(['is_default'])
        
        
                ->make(true);
    }
   

}
