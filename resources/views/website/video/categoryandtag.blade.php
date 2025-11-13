 @extends('components.website.videolayouts.videoapp')
 @section('title', $postvideo->isNotEmpty() ? $postvideo->first()->title : '')
 @section('description', $postvideo->isNotEmpty() ? $postvideo->first()->description : '')
 @section('keyword', $postvideo->isNotEmpty() ? $postvideo->first()->keyword : '')
 @section('image', $postvideo->isNotEmpty() ? url('/images/video/images/' . $postvideo->first()->image) : '')
 @section('headSection')
 @endsection

 @section('main-content')

     <p><b> Search item : <span style="color:#00c5d0;">{{ $searchitem }} </span></b></p>

     @forelse($postvideo as $key => $value)

         @if ($loop->first)
             <div class="card shadow-sm mb-3">
                 @if ($value->link)
                     <video style="height: 350px;" id="vid2" class="video-js vjs-default-skin w-auto" controls
                         data-setup='{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "{{ $value->link }}"}] }'></video>
                 @endif
                 <div class="card-body">
                     <h5 class="card-title">{{ $value->title }}</h5>
                     <p class="card-text">{!! $value->body !!}</p>

                     @if ($value->categoryvideo->isNotEmpty())
                         @php
                             $num_of_items = count($value->categoryvideo);
                             $num_count = 0;
                         @endphp
                         <small class="fw-bold text-sm text-dark hoverlink">
                             Categories :
                             @foreach ($value->categoryvideo as $eachcategoryvideo)
                                 @php $num_count = $num_count + 1; @endphp
                                 <a href="{{ route('categoryvideo', [$eachcategoryvideo->slug]) }}"
                                     class="fw-normal text-dark text-decoration-none" target="_blank">
                                     {{ $eachcategoryvideo->name }}
                                 </a>
                                 @if ($num_count < $num_of_items)
                                     <small>,</small>
                                 @endif
                             @endforeach
                         </small><br>
                     @endif


                     @if ($value->tagvideo->isNotEmpty())
                         @php
                             $num_of_items = count($value->tagvideo);
                             $num_count = 0;
                         @endphp
                         <small class="fw-bold text-sm text-dark hoverlink">
                             Tags :
                             @foreach ($value->tagvideo as $eachtagvideo)
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
                         {{ $value->created_at->diffForHumans() }}
                     </small>
                 </div>
             </div>
         @else

             <a href="{{ URL('jobs-video/' . $value->slug) }}" class="text-decoration-none">
                 <div class="card mb-3">
                     <div class="row g-0">
                         <div class="col-md-5">
                             <img src={{ $value->img_link }} class="img-fluid rounded" alt="{{ $value->seo_keyword }}">
                         </div>
                         <div class="col-md-7">
                             <div class="card-body">
                                 <h5 class="card-title text-dark">{{ $value->title }}</h5>
                                 {{-- <p class="card-text">{!! $value->body !!}</p> --}}
                                 <p class="card-text">
                                     <small class="text-muted">
                                         <i class="bi bi bi-clock"></i>
                                         {{ $value->created_at->diffForHumans() }}
                                     </small>
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </a>
         @endif
     @empty
         <p>Oops!! No Video found</p>
     @endforelse

 @endsection

@section('footerSection')
 <link href="{{ asset('youtube/video-js.css') }}" rel="stylesheet">
 <script src="{{ asset('youtube/video.min.js') }}"></script>
 <script src="{{ asset('youtube/youtube.min.js') }}"></script>
@endsection
