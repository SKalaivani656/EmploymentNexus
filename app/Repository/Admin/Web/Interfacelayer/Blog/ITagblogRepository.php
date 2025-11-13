<?php

namespace App\Repository\Admin\Web\Interfacelayer\Blog;

interface ITagblogRepository
{
    public function index();

    public function store($collection = []);
}
