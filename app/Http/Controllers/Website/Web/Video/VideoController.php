<?php

namespace App\Http\Controllers\Website\Web\Video;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video\Categoryvideo;
use App\Models\Admin\Video\Postvideo;
use App\Models\Admin\Video\Tagvideo;

class VideoController extends Controller
{

    public function video()
    {
        $data = $this->videodata(false);
        $datatwo = $this->categoryandtag();

        $latestvideo = $data[0];
        $postvideo = $data[1];

        $categoryvideo = $datatwo[0];
        $tagvideo = $datatwo[1];

        return view('website.video.index',
            compact('latestvideo', 'postvideo', 'categoryvideo', 'tagvideo'));

    }

    public function article($slug)
    {
        $data = $this->videodata($slug);
        $datatwo = $this->categoryandtag();

        $latestvideo = $data[0];
        $postvideo = $data[1];

        $categoryvideo = $datatwo[0];
        $tagvideo = $datatwo[1];

        return view('website.video.index',
            compact('latestvideo', 'postvideo', 'categoryvideo', 'tagvideo'));

    }

    public function category($slug)
    {
        $category = Categoryvideo::where('slug', $slug)->first();
        $searchitem = $category->name;
        $postvideo = isset($category) ? $category->postvideo : [];

        $datatwo = $this->categoryandtag();
        $categoryvideo = $datatwo[0];
        $tagvideo = $datatwo[1];

        return view('website.video.categoryandtag',
            compact('searchitem', 'postvideo', 'categoryvideo', 'tagvideo'));
    }

    public function tag($slug)
    {
        $tag = Tagvideo::where('slug', $slug)->first();
        $searchitem = $tag->name;
        $postvideo = isset($tag) ? $tag->postvideo : [];

        $datatwo = $this->categoryandtag();
        $categoryvideo = $datatwo[0];
        $tagvideo = $datatwo[1];

        return view('website.video.categoryandtag',
            compact('searchitem', 'postvideo', 'categoryvideo', 'tagvideo'));
    }

    public function categoryvideolist()
    {

        $list = 'category';

        $data = Categoryvideo::where('active', 1)
            ->orderBy('name')
            ->paginate(50);

        $datatwo = $this->categoryandtag();
        $categoryvideo = $datatwo[0];
        $tagvideo = $datatwo[1];

        return view('website.video.videotypelist',
            compact('list', 'data', 'categoryvideo', 'tagvideo'));

    }

    public function tagvideolist()
    {
        $list = 'tag';

        $data = Tagvideo::where('active', 1)
            ->orderBy('name')
            ->paginate(50);

        $datatwo = $this->categoryandtag();
        $categoryvideo = $datatwo[0];
        $tagvideo = $datatwo[1];

        return view('website.video.videotypelist',
            compact('list', 'data', 'categoryvideo', 'tagvideo'));
    }

    protected function videodata($slug)
    {
        $latestvideo = null;
        if ($slug) {
            $latestvideo = Postvideo::where('active', 1)
                ->where('slug', $slug)
                ->first();
        } else {
            $latestvideo = Postvideo::where('active', 1)
                ->with('categoryvideo', 'tagvideo')
                ->latest()
                ->first();
        }
        if ($latestvideo) {
            $postvideo = Postvideo::where('active', 1)
                ->where('id', '<>', $latestvideo->id)
                ->with('categoryvideo', 'tagvideo')
                ->latest()
                ->paginate(6);
        } else {
            $postvideo = null;
        }

        return [$latestvideo, $postvideo];
    }

    protected function categoryandtag()
    {
        $categoryvideo = Categoryvideo::where('active', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        $tagvideo = Tagvideo::where('active', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return [$categoryvideo, $tagvideo];
    }
}
