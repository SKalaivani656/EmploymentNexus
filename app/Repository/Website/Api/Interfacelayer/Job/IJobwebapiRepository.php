<?php

namespace App\Repository\Website\Api\Interfacelayer\Job;

interface IJobwebapiRepository
{
    public function joblist();

    public function getjobbyid();

    public function pushnotification();

    public function getjobtypelist();

    public function jobclassification();

    public function getjobclassificationbyid();

    public function jobsearch();

    public function jobfilter();
}
