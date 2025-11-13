<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Configuration\Adminconfigurationweb;
use Illuminate\Database\Seeder;

class AdminconfigurationwebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adminconfigurationweb::create([
            'uuid' => '88fc5a4d-8283-478b-aba2-8queens',
            'name' => "8 Queens",

            'address_one' => 'No: 38, Nehru Nagar,2nd Avenue, ',
            'address_two' => 'Anna Nagar West. Chennai 600040.',
            'address_three' => 'Land mark: Near Thirumangalam metro station.',
            'phone1' => '0123456789',
            'phone2' => '0123456789',
            'email' => 'webtoolcollection@gmail.com',
            'website' => 'https://www.smartleadersias.com/',

            'bank_accountname' => '8 Queens',
            'bank_name' => 'SBI',
            'account_number' => '12345678',
            'ifsc_code' => 'SB02135',
            'branch' => 'Anna Naga',

            'theme_color' => 'bg-red-600',
            'text_color' => 'text-white',
            'background_color' => 'bg-white',

            'headerbg_color' => 'bg-red-600',
            'headertext_color' => 'text-white',
            'footerbg_color' => 'bg-blue-900',
            'footertext_color' => 'text-gray-50',

            'uplode_logo_image' => '',
            'favicon_image' => '',
            'disqusflag' => true,
            'disquscode' => '<div id="disqus_thread"></div>
            <script>(function() { // DONT EDIT BELOW THIS LINE
            var d = document, s = d.createElement("script");
            s.src = "https://mindchirps.disqus.com/embed.js";
            s.setAttribute("data-timestamp", +new Date());
            (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>',

            'facebook' => 'https://www.facebook.com/',
            'twitter' => 'https://twitter.com/',
            'instagram' => 'https://www.instagram.com/',
            'linkedin' => 'https://www.linkedin.com/',
            'youtube' => 'https://www.youtube.com/',

            'googleanalyticsapi' => 'xyz',
            'googleanalyticscode' => '<!-- Global Site Tag (gtag.js) - Google Analytics -->',

            'copyrights' => '© Copyright 2025. All Rights Reserved.',
            'timezone' => 'Asia/Kolkata',
            'dateformate' => 'd/m/Y',
            'dateformat_javascript' => 'd/m/Y',

            'googleadsverticalcode' => '',
            'googleadshorizontalcode' => '',

            'socialmediaicon' => '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cf1e590ca138275"></script>',

        ]);

    }
}
