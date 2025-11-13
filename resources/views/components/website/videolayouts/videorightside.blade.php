@php $categoryvideo = App\Models\Admin\video\Categoryvideo::where('active', true)->get() @endphp
@if ($categoryvideo->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-video/category') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Categories
        </a>
        @foreach ($categoryvideo as $eachcategoryvideo)
            <small><a href="{{ route('categoryvideo', [$eachcategoryvideo->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachcategoryvideo->name }}<span>({{ $eachcategoryvideo->postvideo()->count() }})</span></a></small>
        @endforeach
    </div>
@endif

@php $tagvideo = App\Models\Admin\video\Tagvideo::where('active', true)->get() @endphp
@if ($tagvideo->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-video/tag') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Tags
        </a>
        @foreach ($tagvideo as $eachtagvideo)
            <small><a href="{{ route('tagvideo', [$eachtagvideo->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachtagvideo->name }}<span>({{ $eachtagvideo->postvideo()->count() }})</span></a></small>
        @endforeach
    </div>
@endif


<!-- <div class="card shadow-sm mb-3 border-0 rounded-3">
   
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1817660922195990" data-ad-slot="1473750696"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});

    </script>
</div> -->
<div class="card shadow-sm mb-3 border-0 rounded-3 text-center">
    <img src="{{ url('images/banner.jpg') }}" 
         alt="Job Banner" 
         class="img-fluid rounded-3" 
         style="width:100%; height:auto;">
</div>
