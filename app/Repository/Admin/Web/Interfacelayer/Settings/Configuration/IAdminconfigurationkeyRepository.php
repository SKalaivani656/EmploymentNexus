<?php

namespace App\Repository\Admin\Web\Interfacelayer\Settings\Configuration;

interface IAdminconfigurationkeyRepository
{
    public function index();

    public function store($collection = []);

}
