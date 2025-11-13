<nav class="navbar navbar-expand-lg sticky-top navbar-dark" style="background:#00c5d0;">
    <div class="container-fluid">
        <a class="navbar-brand d-block d-sm-none" href="{{ URL('/') }}">PrepareNext.Com</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-bold active" aria-current="page" href="{{ URL('/') }}">Home</a>
                </li>
                @php
                    $categoryblog = App\Models\Admin\Blog\Categoryblog::where('active', true)->get();
                @endphp
                @if ($categoryblog->isNotEmpty())
                    @foreach ($categoryblog as $eachcategoryblog)
                        <li
                            class="nav-item {{ Str::contains(url()->current(), $eachcategoryblog->slug) ? 'underline' : '' }}">
                            <a class="nav-link fw-bold active"
                                href="{{ route('categoryblog', [$eachcategoryblog->slug]) }}">{{ $eachcategoryblog->name }}</a>
                        </li>
                    @endforeach
                @endif
        </div>
    </div>
</nav>
@php
$tagblog = App\Models\Admin\Blog\Tagblog::where('active', true)->get();
@endphp
@if ($tagblog->isNotEmpty())
    <div class="nav-scroller bg-body shadow-sm mb-3">
        <nav class="nav nav-underline" aria-label="Secondary navigation">
            @foreach ($tagblog as $eachtagblog)
                <a class="nav-link fw-bold" href="{{ route('tagblog', [$eachtagblog->slug]) }}"
                    style="color:rgb(19, 19, 105);">{{ $eachtagblog->name }}</a>
            @endforeach
        </nav>
    </div>
@endif
@php
$marquee = App\Models\Admin\Website\Websitemarquee::where('active', true)
    ->where('marqueetype', 2)
    ->first();
@endphp
@if ($marquee)
    <marquee>
        <span>
            {!! $marquee->marquee !!}
        </span>
    </marquee>
@endif
