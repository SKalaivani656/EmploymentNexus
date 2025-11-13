<?php

namespace App\Repository\Website\Api\Businesslogic\Video;

use App\Http\Resources\Video\VideoclassificationCollection;
use App\Http\Resources\Video\VideoCollection;
use App\Http\Resources\Video\VideodetailResource;
use App\Models\Admin\Video\Categoryvideo;
use App\Models\Admin\Video\Postvideo;
use App\Models\Admin\Video\TagVideo;
use App\Repository\Website\Api\Interfacelayer\Video\IVideowebapiRepository;

class VideowebapiRepository implements IVideowebapiRepository
{
    public function videolist()
    {
        $postvideo = Postvideo::where('active', true)->latest()->paginate(10);
        return [true, new VideoCollection($postvideo), 'videolist'];
    }
    public function getvideobyid()
    {
        $postvideo = Postvideo::where('active', true)
            ->firstWhere('uuid', request()->videouuid);

        return [true, new VideodetailResource($postvideo), 'getvideobyid'];
    }

    public function videoclassification()
    {
        $model = request()->model;
        $is_popular = request()->is_popular;
        $is_top = request()->is_top;

        $query = $this->findmodel($model);

        if ($query) {
            $is_popular && $query->where('is_popular', $is_popular);
            $is_top && $query->where('is_top', $is_top);
        } else {
            return [false, 'Invalid Request'];
        }

        return [
            true,
            new VideoclassificationCollection($query->latest()->paginate(3)),
            'videoclassification',
        ];

    }

    public function getvideoclassificationbyid()
    {

        $uuid = request()->uuid;

        $query = $this->findmodel(request()->model);
        if ($query) {
            $uuid && $query->where('uuid', $uuid);
        } else {
            return [false, 'Invalid Request'];
        }
        if ($query->first()) {
            return [
                true,
                new VideoCollection($query->first()->videopost()->paginate(3)),
                'videoclassification',
            ];
        } else {
            return [false, 'Invalid Request'];
        }

    }

    public function videofilter()
    {

        $search = request()->search;

        $postvideo = Postvideo::where('active', true)
            ->where(function ($query) use ($search) {
                $query->where('title', "LIKE", "%{$search}%");
            })
            ->latest()->paginate(10);

        return [true, new VideoCollection($postvideo), 'videofilter'];
    }

    private function findmodel($model)
    {
        switch ($model) {
            case "category":
                return Categoryvideo::where('active', true);
                break;
            case "tag":
                return TagVideo::where('active', true);
                break;
            default:
                return false;
        }
    }
}
