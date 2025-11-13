<?php

namespace App\Repository\Admin\Web\Interfacelayer\Blog;

interface ICategoryblogRepository
{
    public function index();

    public function store($collection = []);
}
