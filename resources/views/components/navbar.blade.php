<header id="header">
    <nav>
        <h1 class="ms-4 fs-2 fw-bold"><a href="{{ url('/') }}" class="text-decoration-none text-dark">ReBook.</a></h1>
        <ul>
            <li><a href="{{ url('/') }}" class="text-dark text-decoration-none">Home</a></li>
            <li><a href="{{ route('booking') }}" class="text-dark text-decoration-none">MyBookings</a></li>
        </ul>

        @if (Route::has('login'))
            @auth
                <div id="nav-right" class="d-flex border-start border-2 align-items-center" style="border-color: #D4D4D4; height: 40px;">
                    <img src="{{ asset('img/notification.svg') }}" class="notif-pict">
                    @if(Auth::user()->image == null)
                        <img src="{{ asset('img/icon-user.png') }}" alt="" style="width: 35px;" class="rounded-circle">
                    @else
                        <img src="{{ Auth::user()->image }}" alt="image-profile" srcset="" class="user-pict rounded-5" style="width: 50px; height: 50px">
                    @endif
                </div>
                <div class="sub-menu-wrap shadow-lg" id="subMenu">
                    <div class="sub-menu bg-white">
                        <div class="user-info d-flex align-items-center">
                            <h6 class="fs-5 fw-bold">{{ Auth::user()->username }}</h6>
                        </div>
                        <hr class="w-100" style="background-color: gray;">

                        <a href="{{ route('profile') }}" class="sub-menu-link">
                            @if (Auth::user()->image == null)
                                <img src="{{ asset('img/icon-user.png') }}" alt="" style="width: 35px;">
                            @else
                                <img src="{{ Auth::user()->image }}" alt="" style="width: 40px; height: 40px" class="rounded-circle">
                            @endif
                            <p>Edit Profile</p>
                            <i class="fa-solid fa-chevron-right me-2"></i>
                        </a>
                        <a href="{{ route('my-restaurant.index') }}" class="sub-menu-link">
                            <img src="{{ asset('img/home.svg') }}" alt="">
                            <p>My Restaurant</p>
                            <i class="fa-solid fa-chevron-right me-2"></i>
                        </a>
                        <a href="{{ route('logout') }}" class="sub-menu-link" style="padding-bottom: 10px">
                            <img src="{{ asset('img/logout.svg') }}" alt="">
                            <p>Logout</p>
                            <i class="fa-solid fa-chevron-right me-2"></i>
                        </a>
                    </div>
                </div>
                <div class="notification-wrap shadow-lg" id="notifMenu">
                    <div class="sub-menu bg-white" style="padding: 20px;">
                        <div class="notif-info d-flex" style="margin-left: 30px;">
                            <h6 class="text-center">No Notification</h6>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary me-4">Login</a>
            @endauth
        @endif

    </nav>
    <hr class="mt-0" style="padding: 1px; background-color: grey;">
</header>