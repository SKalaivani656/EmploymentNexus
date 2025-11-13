      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
      <style>
          .nav-scroller {
              position: relative;
              z-index: 2;
              height: 2.75rem;
              overflow-y: hidden;
          }

          .nav-scroller .nav {
              display: flex;
              flex-wrap: nowrap;
              padding-bottom: 1rem;
              margin-top: -1px;
              overflow-x: auto;
              color: rgba(255, 255, 255, .75);
              text-align: center;
              white-space: nowrap;
              -webkit-overflow-scrolling: touch;
          }

          .nav-underline .nav-link {
              padding-top: .75rem;
              padding-bottom: .75rem;
              font-size: 1.0rem;
              color: #000;
          }

          .nav-underline .nav-link:hover {
              color: #007bff;
          }

          .nav-underline .active {
              font-weight: 500;
              color: #343a40;
          }

          .text-white-50 {
              color: rgba(255, 255, 255, .5);
          }

          .bg-purple {
              background-color: #37474f;
          }

      </style>


      @section('headSection')
      @show
