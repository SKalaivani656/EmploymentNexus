@extends('components.website.videolayouts.videoapp')
@section('title', $latestvideo ? $latestvideo->title : '')
@section('description', $latestvideo ? $latestvideo->description : '')
@section('keyword', $latestvideo ? $latestvideo->keyword : '')
@section('image', $latestvideo ? url('/images/video/images/' . $latestvideo->image) : '')
@section('headSection')
    @if ($latestvideo && $latestvideo->schemaorg)
        {!! $latestvideo->schemaorg !!}
    @endif
@endsection

@section('main-content')

    @if ($latestvideo)
        <div class="card shadow-sm mb-3">
            @if ($latestvideo->link)
                <video style="height: 350px;" id="vid2" class="video-js vjs-default-skin w-auto" controls
                    data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{ $latestvideo->link }}"}] }'></video>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $latestvideo->title }}</h5>
                <p class="card-text">{!! $latestvideo->body !!}</p>

                @if ($latestvideo->categoryvideo->isNotEmpty())
                    @php
                        $num_of_items = count($latestvideo->categoryvideo);
                        $num_count = 0;
                    @endphp
                    <div class="float-start fw-bold text-sm text-dark hoverlink">
                        Categories :
                        @foreach ($latestvideo->categoryvideo as $eachcategoryvideo)
                            @php $num_count = $num_count + 1; @endphp
                            <a href="{{ route('categoryvideo', [$eachcategoryvideo->slug]) }}"
                                class="fw-normal text-dark text-decoration-none" target="_blank">
                                {{ $eachcategoryvideo->name }}
                            </a>
                            @if ($num_count < $num_of_items)
                                <small>,</small>
                            @endif
                        @endforeach
                    </div>
                    <div class="float-end">
                        <a href="javascript:void(0)" class="float-end" data-bs-toggle="tooltip" title="Share"
                            onclick="sharemodal('{{ $latestvideo->title }}', '{{ URL('jobs-video/' . $latestvideo->slug) }}')">
                            <i class="bi bi-share-fill text-secondary" data-bs-toggle="modal" data-bs-target="#sharemodal"
                                style="font-size: 1.5rem"></i>
                        </a>
                    </div>
                @endif


                @if ($latestvideo->tagvideo->isNotEmpty())
                    @php
                        $num_of_items = count($latestvideo->tagvideo);
                        $num_count = 0;
                    @endphp
                    <small class="fw-bold text-sm text-dark hoverlink">
                        Tags :
                        @foreach ($latestvideo->tagvideo as $eachtagvideo)
                            @php $num_count = $num_count + 1; @endphp
                            <a href="{{ route('tagvideo', [$eachtagvideo->slug]) }}"
                                class="fw-normal text-dark text-decoration-none" target="_blank">
                                {{ $eachtagvideo->name }}
                            </a>
                            @if ($num_count < $num_of_items)
                                <small>,</small>
                            @endif
                        @endforeach
                    </small><br>
                @endif

            </div>
            <div class="card-footer">
                <small class="text-dark float-end">
                    <i class="bi bi bi-clock"></i>
                    {{ $latestvideo->created_at->diffForHumans() }}
                </small>
            </div>
        </div>
    @endif

    @if ($postvideo)
        @foreach ($postvideo as $key => $eachvideo)
            <a href="{{ URL('jobs-video/' . $eachvideo->slug) }}" class="text-decoration-none">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src={{ $eachvideo->img_link }} class="img-fluid rounded"
                                alt="{{ $eachvideo->seo_keyword }}">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $eachvideo->title }}</h5>
                                {{-- <p class="card-text">{!! $eachvideo->body !!}</p> --}}
                                <div class="card-text">

                                    <small class="text-muted">
                                        <i class="bi bi bi-clock"></i>
                                        {{ $eachvideo->created_at->diffForHumans() }}
                                    </small>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach

        <div class="pagination justify-content-center m-4">
            {{ $postvideo->links() }}
        </div>
    @endif

@endsection

@section('footerSection')
    <link href="{{ asset('youtube/video-js.css') }}" rel="stylesheet">
    <script src="{{ asset('youtube/video.min.js') }}"></script>
    <script src="{{ asset('youtube/youtube.min.js') }}"></script>
@endsection
