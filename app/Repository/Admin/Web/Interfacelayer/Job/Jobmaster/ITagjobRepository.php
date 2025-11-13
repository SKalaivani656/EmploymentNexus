<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster;

interface ITagjobRepository
{
    public function index();

    public function store($collection = []);

}
