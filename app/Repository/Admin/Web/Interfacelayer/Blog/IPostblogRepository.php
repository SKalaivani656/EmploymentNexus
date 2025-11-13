<?php

namespace App\Repository\Admin\Web\Interfacelayer\Blog;

interface IPostblogRepository
{
    public function index();

    public function create();

    public function store($collection = []);

    public function edit();

    public function ajaxcategorylistblog();

}
