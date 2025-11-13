<?php

namespace App\Repository\Admin\Web\Interfacelayer\Job\Jobpost;

interface IPostjobRepository
{
    public function index();

    public function create();

    public function store($collection = []);

    public function edit();

    public function ajaxcategorylistjob();

    public function getstatelist();

    public function getcitylist();

}
