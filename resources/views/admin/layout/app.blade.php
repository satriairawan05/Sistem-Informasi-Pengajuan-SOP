@include('admin.partials.header')
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </form>
            <ul class="navbar-nav narbar-left">
                <div class="mt-1" style="margin-top: 2px;"><i class="ti-time text-white"></i>&nbsp;<span id="waktu" class="text-white"></span></div> <div class="horizontal"></div>
            </ul>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="post" class="dropdown-item has-icon text-danger">
                            @csrf
                            <button type="submit" class="btn btn-sm">
                                <i class="fas fa-sign-out-alt mt-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('app')
        </div>
        @include('admin.partials.watermark')
    </div>
</div>

@include('admin.partials.footer')
