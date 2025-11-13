

<nav class="navbar navbar-expand-lg  indigo_darken_4 py-2 px-4 navbar-dark rounded">
    <div class="container-fluid">
        <div class="navbar-brand d-flex align-items-center">
            <a href="#" class="" id="sidebar-toggle">
                <i class="bi bi-text-left text-white fs-2 me-3" style="font-weight: bold;"></i>
            </a>
            <h2 class="fs-2 m-0 text-white ms-5">{{ $modulename }}</h2>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item ">
                    <a class="nav-link second-text fw-bold" href="#"  role="button" data-bs-toggle="offcanvas" data-bs-target="#notification" aria-controls="offcanvasExample">
                        <i class="bi bi-bell-fill me-2 fs-5"></i>
                    </a>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="notification" aria-labelledby="offcanvasnotification">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasnotification">Offcanvas Notification</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">

                        </div>
                    </div>
                </li> -->
                <!-- <li class="nav-item ">
                    <a class="nav-link second-text fw-bold" href="#"  role="button" data-bs-toggle="offcanvas" data-bs-target="#reminder" aria-controls="offcanvasExample">
                        <i class="bi bi-app-indicator me-2 fs-5"></i>
                    </a>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="reminder" aria-labelledby="offcanvasreminder">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasreminder">Offcanvas Reminder</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">

                        </div>
                    </div>
                </li> -->
                <!-- <li class="nav-item ">
                    <a class="nav-link second-text fw-bold" href="#"  role="button" data-bs-toggle="offcanvas" data-bs-target="#approval" aria-controls="offcanvasExample">
                        <i class="bi bi-clipboard-check me-2 fs-5"></i>
                    </a>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="approval" aria-labelledby="offcanvasapproval">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasapproval">Offcanvas Approval</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">

                        </div>
                    </div>
                </li> -->

                <li class="nav-item dropdown" style="margin-right:50px;">
                    <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill me-2 fs-5"></i>AK
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <div class="p-3 border-bottom">
                                <span>{{ Auth()->user()->name }}</span>
                                <span class="text-secondary">{{ Auth()->user()->email }}</span>
                            </div>
                        </li>
                        @can('addemployee-show')
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        @endcan
                        @can('changepassword')
                        <li><a class="dropdown-item" href="{{ route('changepasswordform') }}">Change Password</a></li>
                        @endcan
                        <li><a class="dropdown-item" href="{{ route('2fa') }}">2FA</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>
