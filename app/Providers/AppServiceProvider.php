<?php

namespace App\Providers;

use App\Models\Admin\Blog\Categoryblog;
use App\Models\Admin\Blog\Postblog;
use App\Models\Admin\Blog\Tagblog;
use App\Models\Admin\Exam\Master\Competitiveexam;
use App\Models\Admin\Job\Jobmaster\Branchjob;
use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Models\Admin\Job\Jobmaster\Coursejob;
use App\Models\Admin\Job\Jobmaster\Designationjob;
use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Models\Admin\Job\Jobmaster\Rolejob;
use App\Models\Admin\Job\Jobmaster\Skilljob;
use App\Models\Admin\Job\Jobmaster\Tagjob;
use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Models\Admin\Job\Jobmiscellaneous\Jobnavlink;
use App\Models\Admin\Job\Jobpost\Postjob;
use App\Models\Admin\Video\Categoryvideo;
use App\Models\Admin\Video\Postvideo;
use App\Models\Admin\Video\Tagvideo;
use App\Observers\Blog\CategoryblogpostionObserver;
use App\Observers\Blog\PostblogpostionObserver;
use App\Observers\Blog\TagblogpostionObserver;
use App\Observers\Exam\Master\CompetitiveexampostionObserver;
use App\Observers\Job\BranchjobpostionObserver;
use App\Observers\Job\CategoryjobpostionObserver;
use App\Observers\Job\CompanyjobpostionObserver;
use App\Observers\Job\CoursejobpostionObserver;
use App\Observers\Job\DesignationjobpositionObserver;
use App\Observers\Job\Jobmiscellaneous\JobnavlinkpositionObserver;
use App\Observers\Job\LanguagejobpostionObserver;
use App\Observers\Job\PostjobpostionObserver;
use App\Observers\Job\RolejobpostionObserver;
use App\Observers\Job\SkilljobpostionObserver;
use App\Observers\Job\TagjobpostionObserver;
use App\Observers\Job\TypejobpostionObserver;
use App\Observers\Video\CategoryvideopositionObserver;
use App\Observers\Video\PostvideopositionObserver;
use App\Observers\Video\TagvideopositionObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Job
        Postjob::observe(PostjobpostionObserver::class);
        Branchjob::observe(BranchjobpostionObserver::class);
        Categoryjob::observe(CategoryjobpostionObserver::class);
        Companyjob::observe(CompanyjobpostionObserver::class);
        Coursejob::observe(CoursejobpostionObserver::class);
        Languagejob::observe(LanguagejobpostionObserver::class);
        Rolejob::observe(RolejobpostionObserver::class);
        Skilljob::observe(SkilljobpostionObserver::class);
        Tagjob::observe(TagjobpostionObserver::class);
        Typejob::observe(TypejobpostionObserver::class);
        Designationjob::observe(DesignationjobpositionObserver::class);

        // Job
        Jobnavlink::observe(JobnavlinkpositionObserver::class);

        // Blog
        Postblog::observe(PostblogpostionObserver::class);
        Categoryblog::observe(CategoryblogpostionObserver::class);
        Tagblog::observe(TagblogpostionObserver::class);

        //Video
        Categoryvideo::observe(CategoryvideopositionObserver::class);
        Tagvideo::observe(TagvideopositionObserver::class);
        Postvideo::observe(PostvideopositionObserver::class);

        //Competitiveexam
        Competitiveexam::observe(CompetitiveexampostionObserver::class);

    }
}
