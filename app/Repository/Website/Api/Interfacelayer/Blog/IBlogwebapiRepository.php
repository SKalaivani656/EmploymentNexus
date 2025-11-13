<?php

namespace App\Repository\Website\Api\Interfacelayer\Blog;

interface IBlogwebapiRepository
{
    public function bloglist();

    public function getblogbyid();

    public function blogclassification();

    public function getblogclassificationbyid();

    public function blogfilter();
}
