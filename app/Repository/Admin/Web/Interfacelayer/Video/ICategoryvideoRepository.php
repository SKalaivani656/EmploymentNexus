<?php

namespace App\Repository\Admin\Web\Interfacelayer\Video;

interface ICategoryvideoRepository
{
    public function index();

    public function store($collection = []);
}
