<?php

namespace App\Repository\Website\Api\Interfacelayer\Video;

interface IVideowebapiRepository
{
    public function videolist();

    public function getvideobyid();

    public function videoclassification();

    public function getvideoclassificationbyid();

    public function videofilter();
}
