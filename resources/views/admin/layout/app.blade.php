@include('admin.partials.header')
@php
    $user = \App\Models\User::where('id', auth()->user()->id)->first();
    $isOnline = $user->id == auth()->user()->id;
    $userName = auth()->user()->name;
    $initial = implode('',array_map(function ($n) {return $n[0];}, explode(' ', ucwords(strtolower($userName)))));
@endphp
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
                <div class="mt-1" style="margin-top: 2px;"><i class="ti-time text-white"></i>&nbsp;<span id="waktu" class="text-white"></span></div>
                <div class="horizontal"></div>
            </ul>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <figure class="avatar avatar-md text-primary bg-white" data-initial="{{ $initial }}"></figure>
                        <i class="avatar-presence @if($isOnline) online @endif"></i>
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('account.change', auth()->user()->id) }}" class="dropdown-item has-icon">
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
