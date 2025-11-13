<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
    <x-website.commonlayouts.commonheader />
    <x-website.commonlayouts.commonheaderlibrary />
    @livewireStyles
   </head>
   <body class="bg-light">
    <x-website.commonlayouts.commonnavbar />
    <x-website.videolayouts.videonavbar />
      <main class="container">
         <div class="row">
            <div class="col-md-3">
                <x-website.videolayouts.videoleftside />
            </div>
            <div class="col-md-6">
                @section('main-content')
                @show 
            </div>
            <div class="col-md-3">
                <x-website.videolayouts.videorightside />
            </div>
         </div>
      </main>
      <x-website.commonlayouts.commonfooter />
      <x-website.commonlayouts.commonfooterlibrary />
      @livewireScripts
   </body>
</html>