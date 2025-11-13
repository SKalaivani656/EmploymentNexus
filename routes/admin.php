<?php

use App\Http\Controllers\Admin\Configuration\Google2fa\PasswordSecurityController;
use App\Http\Controllers\Admin\Web\Blog\CategoryblogController;
use App\Http\Controllers\Admin\Web\Blog\PostblogController;
use App\Http\Controllers\Admin\Web\Blog\TagblogController;
use App\Http\Controllers\Admin\Web\Dashboard\AdmindashboardController;
use App\Http\Controllers\Admin\Web\Exam\Master\CompetitiveexamController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\BranchjobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\CategoryjobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\CompanyjobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\CoursejobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\DesignationjobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\LanguagejobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\RolejobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\SkilljobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\TagjobController;
use App\Http\Controllers\Admin\Web\Job\Jobmaster\TypejobController;
use App\Http\Controllers\Admin\Web\Job\Jobmiscellaneous\JobnavlinkController;
use App\Http\Controllers\Admin\Web\Job\Jobpost\PostjobController;
use App\Http\Controllers\Admin\Web\Settings\Adminsettings\AdminsettingsController;
use App\Http\Controllers\Admin\Web\Settings\Configuration\AdminconfigurationkeyController;
use App\Http\Controllers\Admin\Web\Settings\Configuration\AdminconfigurationwebController;
use App\Http\Controllers\Admin\Web\Settings\Configuration\ColorController;
use App\Http\Controllers\Admin\Web\Settings\Employee\AddemployeeController;
use App\Http\Controllers\Admin\Web\Settings\Role\RoleController;
use App\Http\Controllers\Admin\Web\Tracking\LogininfoController;
use App\Http\Controllers\Admin\Web\Tracking\TrackingController;
use App\Http\Controllers\Admin\Web\Video\CategoryvideoController;
use App\Http\Controllers\Admin\Web\Video\PostvideoController;
use App\Http\Controllers\Admin\Web\Video\TagvideoController;
use App\Http\Controllers\Admin\Web\Website\WebsiteenquiryController;
use App\Http\Controllers\Admin\Web\Website\WebsitemarqueeController;
use App\Http\Controllers\Admin\Web\Website\WebsitesubscribeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Auth::routes();

Route::get('admin/session', function () {
    (session()->get('sessiontoggled') == 'toggled') ? session()->forget('sessiontoggled') : session(['sessiontoggled' => 'toggled']);
})->middleware('auth', 'preventbackbutton');

Route::get('admin/login', [LoginController::class, 'showadminloginform'])->name('adminlogin');
Route::post('admin/login', [LoginController::class, 'adminlogin'])->name('adminloginpost');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'preventbackbutton'], 'prefix' => 'admin'], function () {
    // Dashboard
    Route::get('/admindashboard', [AdmindashboardController::class, 'dashboard'])->name('admindashboard');
    Route::get('/loginlogs', [LogininfoController::class, 'loginlogs'])->name('loginlogs');
    Route::get('/trackinglogs', [TrackingController::class, 'trackinglogs'])->name('trackinglogs');

    Route::resources([

        //MASTER
        'branchjob' => BranchjobController::class,
        'categoryjob' => CategoryjobController::class,
        'companyjob' => CompanyjobController::class,
        'coursejob' => CoursejobController::class,
        'skilljob' => SkilljobController::class,
        'tagjob' => TagjobController::class,
        'typejob' => TypejobController::class,
        'rolejob' => RolejobController::class,
        'languagejob' => LanguagejobController::class,
        'designationjob' => DesignationjobController::class,

        'competitiveexam' => CompetitiveexamController::class,

        //Post Job
        'postjob' => PostjobController::class,

        //Blog
        'postblog' => PostblogController::class,
        'categoryblog' => CategoryblogController::class,
        'tagblog' => TagblogController::class,

        //Video
        'postvideo' => PostvideoController::class,
        'categoryvideo' => CategoryvideoController::class,
        'tagvideo' => TagvideoController::class,

        //role
        'role' => RoleController::class,

        //website
        'websitemarquee' => WebsitemarqueeController::class,
        'websiteenquiry' => WebsiteenquiryController::class,
        'websitesubscribe' => WebsitesubscribeController::class,

        //Job navlink
        'jobnavlink' => JobnavlinkController::class,

        //configuration
        'adminconfigurationweb' => AdminconfigurationwebController::class,
        'adminconfigurationkey' => AdminconfigurationkeyController::class,
        'color' => ColorController::class,

        'addemployee' => AddemployeeController::class,
    ]);
    Route::get('/ajaxbranchjob', [CoursejobController::class, 'ajaxbranchlistjob'])->name('ajaxbranchjob');
    Route::get('/ajaxcategorylistjob', [PostjobController::class, 'ajaxcategorylistjob'])->name('ajaxcategorylistjob');
    Route::post('/jobcontentimagedel', [PostjobController::class, 'jobcontentimagedel'])->name('jobcontentimagedel');
    Route::get('/getstatelist', [PostjobController::class, 'getstatelist'])->name('getstatelist');
    Route::get('/getcitylist', [PostjobController::class, 'getcitylist'])->name('getcitylist');

    Route::get('/ajaxcategorylistblog', [PostblogController::class, 'ajaxcategorylistblog'])->name('ajaxcategorylistblog');
    Route::post('/blogcontentimagedel', [PostblogController::class, 'blogcontentimagedel'])->name('blogcontentimagedel');

    Route::get('/ajaxvideocategory', [PostvideoController::class, 'ajaxvideocategory'])->name('ajaxvideocategory');

    // Settings
    Route::get('/settings', [AdminsettingsController::class, 'index'])->name('settings');
    // System Info
    Route::get('/systeminfo', [AdminsettingsController::class, 'systeminfo'])->name('systeminfo');
    Route::get('/cacheclear', [AdminsettingsController::class, 'cacheclear'])->name('cacheclear');

    // Add Employee //
    Route::get('/ajaxaddemployee', [AddemployeeController::class, 'ajaxaddemployee'])->name('ajaxaddemployee');
    Route::get('/profile', [AddemployeeController::class, 'profile'])->name('profile');
    Route::get('/changepasswordform', [AddemployeeController::class, 'changepasswordform'])->name('changepasswordform');
    Route::post('/changepassword', [AddemployeeController::class, 'changepassword'])->name('changepassword');

    //ROLE

    Route::get('/ajaxaddemployee', [AddemployeeController::class, 'ajaxaddemployee'])->name('ajaxaddemployee');

    Route::get('/2fa', [PasswordSecurityController::class, 'show2faForm'])->name('2fa');
    Route::post('/generate2faSecret', [PasswordSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
    Route::post('/2fa', [PasswordSecurityController::class, 'enable2fa'])->name('enable2fa');
    Route::post('/disable2fa', [PasswordSecurityController::class, 'disable2fa'])->name('disable2fa');
});
