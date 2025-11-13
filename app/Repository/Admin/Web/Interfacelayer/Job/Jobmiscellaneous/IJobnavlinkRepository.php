<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobmiscellaneous;

interface IJobnavlinkRepository
{
    public function index();

    public function store($collection = []);
}
