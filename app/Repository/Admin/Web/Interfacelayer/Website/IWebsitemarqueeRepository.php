<?php

namespace App\Repository\Admin\Web\Interfacelayer\Website;

interface IWebsitemarqueeRepository
{
    public function index();

    public function store($collection = []);

}
