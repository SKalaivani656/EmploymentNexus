<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin\Settings\Configuration\Adminconfigurationkey;

class AdminconfigurationkeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adminconfigurationkey::create([
            'uuid' => '88fc5a4d-8283-478b-aba2-8queens',

            "email_from_name" => 'System Admin',
            "email_from_mail" => 'systemadmin@gmail.com',
            "email_mail_driver" => 'smtp',
            "email_mail_host" => 'smtp.gmail.com',
            "email_mail_port" => '587',
            "email_mail_username" => 'systemadmin@gmail.com',
            "email_mail_password" => '',
            "email_mail_encryption" => 'tls',

            'mailchimpflag' => true,
            'mailchimpapikey' => 'xyz',
            'mailchimplistid' => 'xyz',   

            'recaptchasecretstatus' => false,
            'recaptchasitekey' => 'your_site_key',
            'recaptchasecretkey' => 'your_secret_key',

            'algoliaapp' => 'xyz',
            'algoliasecret' => 'xyz',
            
            'searchstatus' => 0,
        ]);


    }
}