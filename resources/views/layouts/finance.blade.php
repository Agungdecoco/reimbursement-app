@extends('layouts.app')

@section('body')

    <body>
        <nav>
            <div class="logo-name">
                {{-- <div class="logo-image">
                    <img src="images/logo.png" alt="">
                </div> --}}

                <span class="logo_name">{{ Auth::user()->nama }} ({{ Auth::user()->jabatan }})</span>
            </div>

            <div class="menu-items">
                <ul class="nav-links" style="padding-left: 0px">
                    <li><a href="{{ route('finance.home') }}">
                            <i class="uil uil-estate"></i>
                            <span class="link-name">Pengajuan</span>
                        </a></li>
                </ul>

                <ul class="logout-mode" style="padding-left: 0px">
                    <li class="mode">
                        <a href="#">
                            <i class="uil uil-moon"></i>
                            <span class="link-name">Dark Mode</span>
                        </a>

                        <div class="mode-toggle">
                            <span class="switch"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>

                <div class="search-box">
                    <i class="uil uil-search"></i>
                    <input type="text" placeholder="Search here...">
                </div>
                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a> --}}
                <a class="dropdown-item text-end me-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            <div class="dash-content">

                <div class="activity">
                    @yield('content')
                </div>
            </div>
        </section>

        <script src="assets/js/script.js"></script>
    </body>
@endsection
