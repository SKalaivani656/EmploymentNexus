<div class="container d-none d-sm-block">
    <header class="d-flex flex-wrap justify-content-center py-1 mb-2">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-2 fw-bold fst-italic" style="color: #131369;">
                Employment<span style="color:#00c5d0;">N</span>exus<span style="color:#00c5d0;">.</span>Com
            </span>
        </a>
        <ul class="nav nav-pills">
            {{-- <li class="nav-item mt-3"><a href="#" class="nav-link fw-bold active" aria-current="page">Home</a></li> --}}
            {{-- <li class="nav-item mt-3"><a href="#" style="color: rgb(19, 19, 105);" class="nav-link fw-bold" aria-current="page">Notification</a></li>
          <li class="nav-item mt-3"><a href="#" style="color: rgb(19, 19, 105);" class="nav-link fw-bold">Latest Annoucement</a></li> --}}
            <li class="nav-item mt-3 {{ Str::contains(url()->current(), 'jobs-blog') ? 'underline_two' : '' }}">
                <a href="{{ URL('/jobs-blog') }}" style="color: rgb(19, 19, 105);" class="nav-link fw-bold">
                    Career Guide
                </a>
            </li>
            <li class="nav-item mt-3 {{ Str::contains(url()->current(), 'jobs-video') ? 'underline_two' : '' }}">
                <a href="{{ URL('/jobs-video') }}" style="color: rgb(19, 19, 105);" class="nav-link fw-bold">
                    Video
                </a>
            </li>
            <li class="nav-item mt-3 {{ Str::contains(url()->current(), 'about-us') ? 'underline_two' : '' }}">
                <a href="{{ URL('/about-us') }}" style="color: rgb(19, 19, 105);" class="nav-link fw-bold">
                    About Us
                </a>
            </li>
            {{-- <li class="nav-item mt-3"><a href="#" style="color: rgb(19, 19, 105);" class="nav-link fw-bold">Study Material </a></li>
          <li class="nav-item mt-3"><a href="#" style="color: rgb(19, 19, 105);" class="nav-link fw-bold">About Us</a></li>
          <li class="nav-item mt-3"><a href="#" style="color: rgb(19, 19, 105);" class="nav-link fw-bold">Login/Register</a></li> --}}
        </ul>
    </header>
</div>
