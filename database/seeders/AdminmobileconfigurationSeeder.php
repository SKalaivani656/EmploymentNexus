<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Configuration\Adminmobileconfiguration;
use Illuminate\Database\Seeder;

class AdminmobileconfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adminmobileconfiguration::create([
            'uuid' => '88fc5a4d-8283-478b-aba2-8queens',
            'android_app_version' => "0.0.0",
            'ios_app_version' => '0.0.0',
        ]);

    }
}
