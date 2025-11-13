<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\Web\Businesslogic\Blog\TagblogRepository;
use App\Repository\Admin\Web\Businesslogic\Blog\PostblogRepository;
use App\Repository\Admin\Web\Businesslogic\Video\TagvideoRepository;
use App\Repository\Admin\Web\Interfacelayer\Blog\ITagblogRepository;
use App\Repository\Admin\Web\Businesslogic\Video\PostvideoRepository;
use App\Repository\Admin\Web\Interfacelayer\Blog\IPostblogRepository;
use App\Repository\Admin\Web\Interfacelayer\Video\ITagvideoRepository;
use App\Repository\Admin\Web\Businesslogic\Blog\CategoryblogRepository;
use App\Repository\Admin\Web\Interfacelayer\Video\IPostvideoRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobpost\PostjobRepository;
use App\Repository\Admin\Web\Businesslogic\Video\CategoryvideoRepository;
use App\Repository\Admin\Web\Interfacelayer\Blog\ICategoryblogRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\TagjobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\RolejobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\TypejobRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobpost\IPostjobRepository;
use App\Repository\Admin\Web\Interfacelayer\Video\ICategoryvideoRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\SkilljobRepository;
use App\Repository\Admin\Web\Businesslogic\Website\WebsiteenquiryRepository;
use App\Repository\Admin\Web\Businesslogic\Website\WebsitemarqueeRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ITagjobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\BranchjobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\CoursejobRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IRolejobRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ITypejobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\CompanyjobRepository;
use App\Repository\Admin\Web\Businesslogic\Website\WebsitesubscribeRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ISkilljobRepository;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsiteenquiryRepository;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsitemarqueeRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\CategoryjobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\LanguagejobRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IBranchjobRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICoursejobRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICompanyjobRepository;
use App\Repository\Admin\Web\Interfacelayer\Website\IWebsitesubscribeRepository;
use App\Repository\Admin\Web\Businesslogic\Exam\Master\CompetitiveexamRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ICategoryjobRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\ILanguagejobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmaster\DesignationjobRepository;
use App\Repository\Admin\Web\Businesslogic\Settings\Employee\AddemployeeRepository;
use App\Repository\Admin\Web\Interfacelayer\Exam\Master\ICompetitiveexamRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster\IDesignationjobRepository;
use App\Repository\Admin\Web\Businesslogic\Job\Jobmiscellaneous\JobnavlinkRepository;
use App\Repository\Admin\Web\Interfacelayer\Settings\Employee\IAddemployeeRepository;
use App\Repository\Admin\Web\Businesslogic\Settings\Configuration\AdmincolorRepository;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobmiscellaneous\IJobnavlinkRepository;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdmincolorRepository;
use App\Repository\Admin\Web\Businesslogic\Settings\Configuration\AdminconfigurationkeyRepository;
use App\Repository\Admin\Web\Businesslogic\Settings\Configuration\AdminconfigurationwebRepository;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdminconfigurationkeyRepository;
use App\Repository\Admin\Web\Interfacelayer\Settings\Configuration\IAdminconfigurationwebRepository;

class AdminRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Master
        $this->app->bind(IBranchjobRepository::class, BranchjobRepository::class);
        $this->app->bind(ICategoryjobRepository::class, CategoryjobRepository::class);
        $this->app->bind(ICompanyjobRepository::class, CompanyjobRepository::class);
        $this->app->bind(ICoursejobRepository::class, CoursejobRepository::class);
        $this->app->bind(ISkilljobRepository::class, SkilljobRepository::class);
        $this->app->bind(ITagjobRepository::class, TagjobRepository::class);
        $this->app->bind(ITypejobRepository::class, TypejobRepository::class);
        $this->app->bind(IRolejobRepository::class, RolejobRepository::class);
        $this->app->bind(ILanguagejobRepository::class, LanguagejobRepository::class);
        $this->app->bind(IDesignationjobRepository::class, DesignationjobRepository::class);

        //Job navlink
        $this->app->bind(IJobnavlinkRepository::class, JobnavlinkRepository::class);

        //competitive

        $this->app->bind(ICompetitiveexamRepository::class, CompetitiveexamRepository::class);

        //Website
        $this->app->bind(IWebsitemarqueeRepository::class, WebsitemarqueeRepository::class);
        $this->app->bind(IWebsiteenquiryRepository::class, WebsiteenquiryRepository::class);
        $this->app->bind(IWebsitesubscribeRepository::class, WebsitesubscribeRepository::class);

        //Post Job
        $this->app->bind(IPostjobRepository::class, PostjobRepository::class);

        //blog Job
        $this->app->bind(ICategoryblogRepository::class, CategoryblogRepository::class);
        $this->app->bind(IPostblogRepository::class, PostblogRepository::class);
        $this->app->bind(ITagblogRepository::class, TagblogRepository::class);

        //VIDEO
        $this->app->bind(ICategoryvideoRepository::class, CategoryvideoRepository::class);
        $this->app->bind(IPostvideoRepository::class, PostvideoRepository::class);
        $this->app->bind(ITagvideoRepository::class, TagvideoRepository::class);

        //Settings
        $this->app->bind(IAddemployeeRepository::class, AddemployeeRepository::class);
        $this->app->bind(IAdminconfigurationkeyRepository::class, AdminconfigurationkeyRepository::class);
        $this->app->bind(IAdminconfigurationwebRepository::class, AdminconfigurationwebRepository::class);
        $this->app->bind(IAdmincolorRepository::class, AdmincolorRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
