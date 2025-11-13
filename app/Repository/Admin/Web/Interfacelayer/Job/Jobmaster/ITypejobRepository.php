<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster;

interface ITypejobRepository
{
    public function index();

    public function store($collection = []);

}
