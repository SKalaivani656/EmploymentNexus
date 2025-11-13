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
                    $categoryjob = App\Models\Admin\Job\Jobmaster\Categoryjob::where('active', true)
                        ->where('is_top', true)
                        ->get();
                @endphp



                @if ($categoryjob->isNotEmpty())
                    @foreach ($categoryjob as $eachcategoryjob)

                        <li
                            class="nav-item {{ Str::contains(url()->current(), $eachcategoryjob->slug) ? 'underline' : '' }}">
                            <a style="font-size:14px;" class="nav-link fw-bold active"
                                href="{{ route('jobtype', ['category', $eachcategoryjob->slug]) }}">{{ $eachcategoryjob->name }}</a>
                        </li>


                    @endforeach
                @endif
                <hr class="text-white">
                <li class="nav-item d-sm-block d-md-none">
                    <a style="font-size:14px;" class="nav-link fw-bold active" href="{{ URL('/jobs-blog') }}">Career
                        Guide</a>
                </li>
                <li class="nav-item d-sm-block d-md-none">
                    <a style="font-size:14px;" class="nav-link fw-bold active" href="{{ URL('/jobs-video') }}">
                        Video</a>
                </li>
                <li class="nav-item d-sm-block d-md-none">
                    <a style="font-size:14px;" class="nav-link fw-bold active" href="{{ URL('/about-us') }}">About
                        Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@php
$jobnavlink = App\Models\Admin\Job\Jobmiscellaneous\Jobnavlink::where('active', true)->get();
@endphp
@if ($jobnavlink->isNotEmpty())
    <div class="nav-scroller bg-body shadow-sm mb-3">
        <nav class="nav nav-underline" aria-label="Secondary navigation">
            @foreach ($jobnavlink as $eachjobnavlink)
                <a class="nav-link fw-bold" href="{{ $eachjobnavlink->link }}"
                    style="color:rgb(19, 19, 105);">{{ $eachjobnavlink->name }}</a>
            @endforeach
        </nav>
    </div>
@endif
{{-- <marquee class=""><span class="fw-bold" style="color:rgb(19, 19, 105);">“Choose a job you love and you’ll never have to
        work a day in your life” – Confucius</span></marquee> --}}


@php
$marquee = App\Models\Admin\Website\Websitemarquee::where('active', true)
    ->where('marqueetype', 1)
    ->first();
@endphp
@if ($marquee)
    <marquee>
        <span>
            {!! $marquee->marquee !!}
        </span>
    </marquee>
@endif
