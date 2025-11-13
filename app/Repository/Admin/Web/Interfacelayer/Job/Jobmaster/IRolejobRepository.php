<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster;

interface IRolejobRepository
{
    public function index();

    public function store($collection = []);

}
