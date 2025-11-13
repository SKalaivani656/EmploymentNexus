<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Website\Api\Businesslogic\Job\JobwebapiRepository;
use App\Repository\Website\Api\Businesslogic\Blog\BlogwebapiRepository;
use App\Repository\Website\Api\Interfacelayer\Job\IJobwebapiRepository;
use App\Repository\Website\Api\Businesslogic\Video\VideowebapiRepository;
use App\Repository\Website\Api\Interfacelayer\Blog\IBlogwebapiRepository;
use App\Repository\Website\Api\Interfacelayer\Video\IVideowebapiRepository;
use App\Repository\Website\Api\Businesslogic\Employee\EmployeewebapiRepository;
use App\Repository\Website\Api\Interfacelayer\Employee\IEmployeewebapiRepository;

class ApiRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        //Web Api
        $this->app->bind(IEmployeewebapiRepository::class, EmployeewebapiRepository::class);
        $this->app->bind(IJobwebapiRepository::class, JobwebapiRepository::class);
        $this->app->bind(IBlogwebapiRepository::class, BlogwebapiRepository::class);
        $this->app->bind(IVideowebapiRepository::class, VideowebapiRepository::class);

        

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
