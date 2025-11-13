<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster;

interface ISkilljobRepository
{
    public function index();

    public function store($collection = []);

}
