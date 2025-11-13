<?php

namespace App\Repository\Admin\Web\Businesslogic\Settings\Configuration;

use App\Traits\UploadTrait;
use App\Models\Helper\Trackmessagehelper;
use App\Models\Admin\Settings\Configuration\Color;
use App\Models\Admin\Settings\Configuration\Adminconfigurationweb;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdminconfigurationwebRepository;

class AdminconfigurationwebRepository implements IAdminconfigurationwebRepository
{

    Use UploadTrait;
    public function index()
    {
        $adminconfigurationweb = Adminconfigurationweb::where('uuid', '88fc5a4d-8283-478b-aba2-8queens')->first();
        $themecolor = Color::where('type', 'bg')->pluck('color', 'color')->all();
        $textcolor = Color::where('type', 'text')->pluck('color', 'color')->all();
        return view('/admin/settings/configuration/adminconfigurationweb/createOrUpdate', compact('adminconfigurationweb', 'themecolor', 'textcolor'));

    }
    public function store($collection = [])
    {
        if (request()->hasFile('uplode_logo_image')) {
            $collection['uplode_logo_image'] = $this->uploadOne( request()->file('uplode_logo_image'),'/images/adminconfigurationweb/uploadimages/', '/images/adminconfigurationweb/uploadthumbnail/', 'App\Models\Admin\Settings\Configuration\Adminconfigurationweb', 70, [250, 125]);
        }
        if (request()->hasFile('favicon_image')) {
            $collection['favicon_image'] = $this->uploadOne(request()->file('favicon_image'),'/images/adminconfigurationweb/faviconimages/', '/images/adminconfigurationweb/faviconthumbnail/', 'App\Models\Admin\Settings\Configuration\Adminconfigurationweb', 70, [250, 125]);
        }


        Adminconfigurationweb::where('id', 1)->update($collection);
        $sessionid = request()->session()->get('sessionid');
        Trackmessagehelper::trackmessage('Configuration updated', 'ADMIN', 'ADMIN CONFIGURATION UPDATE', $sessionid, 'WEB');
    }

}
