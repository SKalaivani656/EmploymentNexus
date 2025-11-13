<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmaster;

interface IBranchjobRepository
{
    public function index();

    public function store($collection = []);
}
