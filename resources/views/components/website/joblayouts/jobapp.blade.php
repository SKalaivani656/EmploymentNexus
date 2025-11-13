<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-website.commonlayouts.commonheader />
    <x-website.commonlayouts.commonheaderlibrary />
    @livewireStyles
</head>

<body class="bg-light">
    <x-website.commonlayouts.commonnavbar />
    <x-website.joblayouts.jobnavbar />
    <main class="container">
        <div class="row">
            <div class="col-md-3 order-2 order-lg-1">

                @hasSection('leftsidefilter')
                    @livewire('website.job.jobhomesearchlivewire')
                    <x-website.joblayouts.jobleftside />
                @else
                    @livewire('website.job.jobsearchlivewire')
                @endif
            </div>
            <div class="col-md-6 order-1 order-lg-2">
                @section('main-content')
                @show
            </div>
            <div class="col-md-3 order-3 order-lg-3">
                <x-website.joblayouts.jobrightside />
            </div>
        </div>
    </main>
    <x-website.commonlayouts.commonfooter />
    <x-website.commonlayouts.commonfooterlibrary />
    @livewireScripts
</body>

</html>
