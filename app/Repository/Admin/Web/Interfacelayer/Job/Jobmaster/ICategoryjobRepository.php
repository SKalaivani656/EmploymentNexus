<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster;

interface ICategoryjobRepository
{
    public function index();

    public function store($collection = []);

}
