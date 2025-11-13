<?php

namespace App\Repository\Admin\Web\Interfacelayer\Video;

interface IPostvideoRepository
{
    public function index();

    public function store($collection = []);

    public function ajaxvideocategory();
}
