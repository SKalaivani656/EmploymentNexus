@php $categoryblog = App\Models\Admin\blog\Categoryblog::where('active', true)->get() @endphp
@if ($categoryblog->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-blog/category') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Categories
        </a>
        @foreach ($categoryblog as $eachcategoryblog)
            <small><a href="{{ route('categoryblog', [$eachcategoryblog->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachcategoryblog->name }}<span>({{ $eachcategoryblog->postblog()->count() }})</span></a></small>
        @endforeach
    </div>
@endif

@php $tagblog = App\Models\Admin\blog\Tagblog::where('active', true)->get() @endphp
@if ($tagblog->isNotEmpty())
    <div class="list-group shadow-sm mb-3 border-0 rounded-3">
        <a href="{{ url('/jobs-blog/tag') }}"
            class="list-group-item border-0 active border-light bg-white text-dark fw-bold" aria-current="true">
            Tags
        </a>
        @foreach ($tagblog as $eachtagblog)
            <small><a href="{{ route('tagblog', [$eachtagblog->slug]) }}"
                    class="list-group-item border-0 rounded-3 list-group-item-action fw-bold d-flex justify-content-between align-items-center text-muted">{{ $eachtagblog->name }}<span>({{ $eachtagblog->postblog()->count() }})</span></a></small>
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