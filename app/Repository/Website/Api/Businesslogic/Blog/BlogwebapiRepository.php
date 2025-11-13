<?php

namespace App\Repository\Website\Api\Businesslogic\Blog;

use App\Http\Resources\Blog\BlogclassificationCollection;
use App\Http\Resources\Blog\BlogCollection;
use App\Http\Resources\Blog\BlogdetailResource;
use App\Models\Admin\Blog\Categoryblog;
use App\Models\Admin\Blog\Postblog;
use App\Models\Admin\Blog\Tagblog;
use App\Models\Admin\Worldinfo\City;
use App\Models\Admin\Worldinfo\State;
use App\Repository\Website\Api\Interfacelayer\Blog\IBlogwebapiRepository;

class BlogwebapiRepository implements IBlogwebapiRepository
{
    public function bloglist()
    {
        $postblog = Postblog::where('active', true)->latest()->paginate(10);
        return [true, new BlogCollection($postblog), 'bloglist'];
    }
    public function getblogbyid()
    {
        $postblog = Postblog::where('active', true)
            ->firstWhere('uuid', request()->bloguuid);

        return [true, new BlogdetailResource($postblog), 'getblogbyid'];
    }

    public function blogclassification()
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
            new BlogclassificationCollection($query->latest()->paginate(3)),
            'blogclassification',
        ];

    }

    public function getblogclassificationbyid()
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
                new BlogCollection($query->first()->postblog()->paginate(3)),
                'blogclassification',
            ];
        } else {
            return [false, 'Invalid Request'];
        }

    }

    public function blogfilter()
    {

        $search = request()->search;

        $postblog = Postblog::where('active', true)
            ->where(function ($query) use ($search) {
                $query->where('title', "LIKE", "%{$search}%")
                    ->orWhere('subtitle', "LIKE", "%{$search}%");
            })
            ->latest()->paginate(10);

        return [true, new BlogCollection($postblog), 'blogfilter'];
    }

    private function findmodel($model)
    {
        switch ($model) {
            case "category":
                return Categoryblog::where('active', true);
                break;
            case "tag":
                return Tagblog::where('active', true);
                break;
            case "city":
                return City::where('active', true);
                break;
            case "state":
                return State::where('active', true);
                break;
            default:
                return false;
        }
    }
}
