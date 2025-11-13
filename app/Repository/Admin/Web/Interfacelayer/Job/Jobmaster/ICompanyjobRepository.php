<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster;

interface ICompanyjobRepository
{
    public function index();

    public function store($collection = []);

}
