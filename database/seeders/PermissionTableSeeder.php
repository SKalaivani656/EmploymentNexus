<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Side Nav Start
            'dashboard' => 'side_nav',
            'jobmaster' => 'side_nav',
            'jobmiscellaneous' => 'side_nav',
            'jobpost' => 'side_nav',
            'blog' => 'side_nav',
            'exam' => 'side_nav',
            'website' => 'side_nav',
            'video' => 'side_nav',
            'tracking' => 'side_nav',
            'settings' => 'side_nav',

            // Branch

            'branchjob-list' => 'branch',
            'branchjob-create' => 'branch',
            'branchjob-edit' => 'branch',
            'branchjob-show' => 'branch',
            // 'branchjob-delete' => 'branch',

            //category

            'categoryjob-list' => 'category',
            'categoryjob-create' => 'category',
            'categoryjob-edit' => 'category',
            'categoryjob-show' => 'category',
            // 'category-delete' => 'category',

            //company

            'companyjob-list' => 'company',
            'companyjob-create' => 'company',
            'companyjob-edit' => 'company',
            'companyjob-show' => 'company',
            // 'company-delete' => 'company',


            //language
            'languagejob-list' => 'language',
            'languagejob-create' => 'language',
            'languagejob-edit' => 'language',
            'languagejob-show' => 'language',
            // 'language-delete' => 'language',

            

            'designationjob-list' => 'designation',
            'designationjob-create' => 'designation',
            'designationjob-edit' => 'designation',
            'designationjob-show' => 'designation',
            // 'designationjob-delete' => 'designation',

            //course

            'coursejob-list' => 'course',
            'coursejob-create' => 'course',
            'coursejob-edit' => 'course',
            'coursejob-show' => 'course',
            // 'coursejob-delete' => 'course',

            //skill

            'skilljob-list' => 'skill',
            'skilljob-create' => 'skill',
            'skilljob-edit' => 'skill',
            'skilljob-show' => 'skill',
            // 'skilljob-delete' => 'skill',

            //type

            'typejob-list' => 'type',
            'typejob-create' => 'type',
            'typejob-edit' => 'type',
            'typejob-show' => 'type',
            // 'typejob-delete' => 'type',

            //rolejob
            'rolejob-list' => 'rolejob',
            'rolejob-create' => 'rolejob',
            'rolejob-edit' => 'rolejob',
            'rolejob-show' => 'rolejob',
            // 'rolejob-delete' => 'rolejob',

            // role start
            'role-list' => 'role',
            'role-create' => 'role',
            'role-edit' => 'role',
            // 'role-delete' => 'role',
            // role End

             // addemployee start
             'addemployee-list' => 'addemployee',
             'addemployee-create' => 'addemployee',
             'addemployee-edit' => 'addemployee',
             'addemployee-show' => 'addemployee',
             // 'addemployee-delete' => 'addemployee',
             // addemployee End

            //Tag
            'tagjob-list' => 'tag',
            'tagjob-create' => 'tag',
            'tagjob-edit' => 'tag',
            'tagjob-show' => 'tag',
            // 'tag-delete' => 'tag',

             //Tag
             'jobnavlink-list' => 'jobnavlink',
             'jobnavlink-create' => 'jobnavlink',
             'jobnavlink-edit' => 'jobnavlink',
             'jobnavlink-show' => 'jobnavlink',
             // 'jobnavlink-delete' => 'jobnavlink',

            //postjob
            'postjob-list' => 'postjob',
            'postjob-create' => 'postjob',
            'postjob-edit' => 'postjob',
            'postjob-show' => 'postjob',
            // 'postjob-delete' => 'postjob',

            
            //postblog
            'postblog-list' => 'postblog',
            'postblog-create' => 'postblog',
            'postblog-edit' => 'postblog',
            'postblog-show' => 'postblog',
            // 'postblog-delete' => 'postblog',

              //categoryblog

              'categoryblog-list' => 'categoryblog',
              'categoryblog-create' => 'categoryblog',
              'categoryblog-edit' => 'categoryblog',
              'categoryblog-show' => 'categoryblog',
              // 'categoryblog-delete' => 'categoryblog',

               //tagblog

               'tagblog-list' => 'tagblog',
               'tagblog-create' => 'tagblog',
               'tagblog-edit' => 'tagblog',
               'tagblog-show' => 'tagblog',
               // 'tagblog-delete' => 'tagblog',

               
               //competitiveexam

               'competitiveexam-list' => 'competitiveexam',
               'competitiveexam-create' => 'competitiveexam',
               'competitiveexam-edit' => 'competitiveexam',
               'competitiveexam-show' => 'competitiveexam',
               // 'competitiveexam-delete' => 'competitiveexam',

                //marquee

                'marquee-list' => 'marquee',
                'marquee-create' => 'marquee',
                'marquee-edit' => 'marquee',
                'marquee-show' => 'marquee',
                // 'marquee-delete' => 'marquee',

                  //enquiry

                  'enquiry-list' => 'enquiry',
              
                   //subscribe

                   'subscribe-list' => 'subscribe',
               
               //postvideo

              'postvideo-list' => 'postvideo',
              'postvideo-create' => 'postvideo',
              'postvideo-edit' => 'postvideo',
              'postvideo-show' => 'postvideo',
              // 'postvideo-delete' => 'postvideo',

             //categoryvideo

             'categoryvideo-list' => 'categoryvideo',
             'categoryvideo-create' => 'categoryvideo',
             'categoryvideo-edit' => 'categoryvideo',
            'categoryvideo-show' => 'categoryvideo',
         // 'categoryvideo-delete' => 'categoryvideo',

         //tagvideo

        'tagvideo-list' => 'tagvideo',
        'tagvideo-create' => 'tagvideo',
        'tagvideo-edit' => 'tagvideo',
        'tagvideo-show' => 'tagvideo',
        // 'tagvideo-delete' => 'tagvideo',
  
 
        //loginifo

       'loginifo-list' => 'loginifo',

    

  
        //useractivity

       'useractivity-list' => 'useractivity',

 

 

            // settings start
            'user' => 'settings',
            'changepassword'=> 'settings',
            'admin-config' => 'settings',
            'key-config'=> 'settings',
            'color'=> 'settings',
            // 'clear-cache' => 'settings',
            // 'system-info' => 'settings',
            'roles-permission' => 'settings',
            // settings End

        ];

        foreach ($permissions as $key => $value) {
            Permission::create(['name' => $key, 'permissionsheading' => $value]);
        }
    }
}
