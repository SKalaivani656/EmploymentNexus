@extends('components.website.bloglayouts.blogapp')
@section('title', $data ? $data->seo_title : '')
@section('description', $data ? $data->seo_description : '')
@section('keyword', $data ? $data->seo_keyword : '')
@section('image', $data ? url('/images/blog/images/' . $data->image) : '')
@section('headSection')
    {!! $data->schemaorg !!}
@endsection

@section('main-content')
    <div class="card mb-3">



        <div class="card-body">
            <div class="card-title">
                <h3>{{ $data->title }}</h3>
            </div>



            @if ($data->country)
                <div class="col-auto">
                    <small>
                        <i class="bi bi-geo-alt-fill"></i>
                        <a class="font-weight-bold text-dark text-decoration-none" href="#">
                            {{ $data->country }}</a>
                        @if ($data->state)
                            <small>,</small> <a class="font-weight-bold text-dark text-decoration-none"
                                href="#">{{ $data->state }}</a>
                        @endif
                        @if ($data->city)
                            <small>,</small> <a class="font-weight-bold text-dark text-decoration-none"
                                href="#">{{ $data->city }}</a>
                        @endif
                    </small>
                </div>
            @endif


            @if ($data->image_status && $data->image)
                <img src="{{ asset('/storage/images/blog/thumbnail/' . $data->image) }}" class="card-img-top"
                    alt="{{ $data->image_alttag }}">
            @endif


            {{-- Category --}}

            @if ($data->categoryblog->isNotEmpty())
                @php
                    $num_of_items = count($data->categoryblog);
                    $num_count = 0;
                @endphp
                <div class="float-start fw-bold text-sm text-dark hoverlink mt-2">
                    Category :
                    @foreach ($data->categoryblog as $eachcategory)
                        @php $num_count = $num_count + 1; @endphp
                        <a href="{{ route('categoryblog', [$eachcategory->slug]) }}" class="text-decoration-none" style=""
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Category" target="_blank">
                            <span class="badge bg-secondary"> {{ $eachcategory->name }} </span>
                        </a>
                        @if ($num_count < $num_of_items)
                            <small>,</small>
                        @endif
                    @endforeach
                </div>
                <div class="float-end mt-2">
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" title="Share"
                        onclick="sharemodal('{{ $data->title }}', '{{ URL('jobs-blog/' . $data->slug) }}')">
                        <i class="bi bi-share-fill text-secondary" data-bs-toggle="modal" data-bs-target="#sharemodal"
                            style="font-size: 1.3rem"></i>
                    </a>
                </div>
            @endif

            <section class="card-text mt-5">{!! $data->body !!}</section>

            @if ($data->video_status && $data->video_link)
                <video style="height: 350px;" id="vid2" class="video-js vjs-default-skin w-auto" controls
                    data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{ $data->video_link }}"}] }'>
                </video>
            @endif
        </div>




        <div class="card-footer">
            <small class="text-muted">
                <i class="bi bi bi-clock"></i>
                {{ $data->created_at->diffForHumans() }}
            </small>

            @if ($data->tagblog->isNotEmpty())
                @php
                    $num_of_items = count($data->tagblog);
                    $num_count = 0;
                @endphp
                <span class="fw-bold text-sm text-dark hoverlink float-end">
                    @foreach ($data->tagblog as $eachtag)
                        @php $num_count = $num_count + 1; @endphp
                        <a href="{{ route('tagblog', [$eachtag->slug]) }}" class="text-decoration-none" target="_blank">
                            <span class="badge rounded-pill bg-primary"> {{ $eachtag->name }} </span>
                        </a>
                        @if ($num_count < $num_of_items)
                            <small>,</small>
                        @endif
                    @endforeach
                </span>
            @endif
        </div>
        @if ($data->blogcomment)
            <div class="card-body shadow-sm">
                @include('helper.comments.disqus')
            </div>
        @endif
    </div>


    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-header bg-white">
            <b style="color:orangered"> Related Post </b>
        </div>
    </div>



    @forelse ($postblog as $eachpostblog)
        @include('website.blog.bloglist')
    @empty
        <p>Oops!! No Related Job Found</p>
    @endforelse







    <div class="pagination justify-content-center m-4">
        {{ $postblog->links() }}
    </div>



@endsection

@section('footerSection')

@if ($data->video_status && $data->video_link)
    <link href="{{ asset('youtube/video-js.css') }}" rel="stylesheet">
    <script src="{{ asset('youtube/video.min.js') }}"></script>
    <script src="{{ asset('youtube/youtube.min.js') }}"></script>
@endif

@endsection
