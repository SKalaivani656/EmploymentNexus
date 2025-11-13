<?php

namespace App\Http\Controllers\Website\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\Categoryblog;
use App\Models\Admin\Blog\Postblog;
use App\Models\Admin\Blog\Tagblog;

class BlogController extends Controller
{

    public function blog()
    {
        $postblog = Postblog::where('active', 1)
            ->with('categoryblog', 'tagblog')
            ->latest()
            ->paginate(6);

        $categoryblog = Categoryblog::where('active', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        $tagblog = Tagblog::where('active', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('website.blog.index',
            compact('postblog', 'categoryblog', 'tagblog'));

    }

    // public function category(Request $request, $id, $slug)
    // {
    //     $category = Categoryblog::find($id);
    //     $postblog = isset($category) ? $category->posts() : [];

    //     $categoryblog = Categoryblog::where('active', 1)
    //         ->inRandomOrder()
    //         ->take(10)
    //         ->get();

    //     $tagblog = Tagblog::where('active', 1)
    //         ->inRandomOrder()
    //         ->take(10)
    //         ->get();

    //     return view('website.blog.index',
    //         compact('postblog', 'categoryblog', 'tagblog'));
    // }

    // public function tag(Request $request, $id, $slug)
    // {
    //     $tag = Tagblog::find($id);
    //     $postblog = isset($tag) ? $tag->posts() : [];

    //     $categoryblog = Categoryblog::where('active', 1)
    //         ->inRandomOrder()
    //         ->take(10)
    //         ->get();

    //     $tagblog = Tagblog::where('active', 1)
    //         ->inRandomOrder()
    //         ->take(10)
    //         ->get();

    //     return view('website.blog.index',
    //         compact('postblog', 'categoryblog', 'tagblog'));
    // }

    public function blogdescription($slug)
    {

        $data = Postblog::where('active', 1)->where('slug', $slug)->first();

        $postblog = Postblog::where('active', 1)
            ->where('id', '<>', $data->id)
            ->latest()
            ->paginate(10);

        $datatwo = $this->categoryandtag();
        $categoryblog = $datatwo[0];
        $tagblog = $datatwo[1];

        return view('website.blog.blogdescription',
            compact('data', 'postblog', 'categoryblog', 'tagblog'));
    }

    public function category($slug)
    {
        $category = Categoryblog::where('slug', $slug)->first();
        $searchitem = $category->name;
        $postblog = isset($category) ? $category->postblog()->paginate(10) : [];

        $datatwo = $this->categoryandtag();
        $categoryblog = $datatwo[0];
        $tagblog = $datatwo[1];

        return view('website.blog.index',
            compact('searchitem', 'postblog', 'categoryblog', 'tagblog'));
    }

    public function tag($slug)
    {
        $tag = Tagblog::where('slug', $slug)->first();
        $searchitem = $tag->name;
        $postblog = isset($tag) ? $tag->postblog()->paginate(10) : [];

        $datatwo = $this->categoryandtag();
        $categoryblog = $datatwo[0];
        $tagblog = $datatwo[1];

        return view('website.blog.index',
            compact('searchitem', 'postblog', 'categoryblog', 'tagblog'));
    }

    public function categorybloglist()
    {

        $list = 'category';

        $data = Categoryblog::where('active', 1)
            ->orderBy('name')
            ->paginate(50);

        $datatwo = $this->categoryandtag();
        $categoryblog = $datatwo[0];
        $tagblog = $datatwo[1];

        return view('website.blog.blogtypelist',
            compact('list', 'data', 'categoryblog', 'tagblog'));

    }

    public function tagbloglist()
    {
        $list = 'tag';

        $data = Tagblog::where('active', 1)
            ->orderBy('name')
            ->paginate(50);

        $datatwo = $this->categoryandtag();
        $categoryblog = $datatwo[0];
        $tagblog = $datatwo[1];

        return view('website.blog.blogtypelist',
            compact('list', 'data', 'categoryblog', 'tagblog'));
    }

    protected function blogdata($slug)
    {
        if ($slug) {
            $latestblog = Postblog::where('active', 1)
                ->where('slug', $slug)
                ->first();
        } else {
            $latestblog = Postblog::where('active', 1)
                ->with('categoryblog', 'tagblog')
                ->latest()
                ->first();
        }

        $postblog = Postblog::where('active', 1)
            ->where('id', '<>', $latestblog->id)
            ->with('categoryblog', 'tagblog')
            ->latest()
            ->paginate(6);

        return [$latestblog, $postblog];
    }

    protected function categoryandtag()
    {
        $categoryblog = Categoryblog::where('active', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        $tagblog = Tagblog::where('active', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return [$categoryblog, $tagblog];
    }
}
