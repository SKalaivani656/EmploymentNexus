<?php

namespace App\Repository\Admin\Web\Interfacelayer\Video;

interface ITagvideoRepository
{
    public function index();

    public function store($collection = []);
}
