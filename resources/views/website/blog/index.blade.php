@extends('components.website.bloglayouts.blogapp')
@section('title', $postblog->isNotEmpty() ? $postblog->first()->seo_title : '')
@section('description', $postblog->isNotEmpty() ? $postblog->first()->seo_description : '')
@section('keyword', $postblog->isNotEmpty() ? $postblog->first()->seo_keyword : '')
@section('image', $postblog->isNotEmpty() ? url('/images/blog/images/' . $postblog->first()->image) : '')
@section('headSection')
@endsection

@section('main-content')
    @if ($searchitem ?? '')
        <p><b> Search item : <span style="color:#00c5d0;">{{ $searchitem }} </span></b></p>
    @endif

    @forelse ($postblog as $eachpostblog)
        @include('website.blog.bloglist')
    @empty
        <p>Oops!! No Record Found</p>
    @endforelse

    <div class="pagination justify-content-center m-4">
        {{ $postblog->links() }}
    </div>



@endsection

@section('footerSection')
@endsection
