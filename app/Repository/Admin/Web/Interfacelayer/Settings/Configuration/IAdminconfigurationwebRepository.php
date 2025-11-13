<?php

namespace App\Repository\Admin\Web\Interfacelayer\Settings\Configuration;

interface IAdminconfigurationwebRepository
{
    public function index();

    public function store($collection = []);

}
