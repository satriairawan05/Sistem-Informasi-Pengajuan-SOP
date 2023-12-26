<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logoakg.png') }}" alt="{{ env('APP_NAME') }}"
                    class="h-50 w-50"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ Request::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master Data</li>
            <li class="dropdown">
                <a href="#" class="nav-link"><i class="fas fa-envelope"></i>
                    <span>SOP</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link"><i class="fas fa-envelope-open"></i>
                    <span>JSA</span></a>
            </li>
            <li class="menu-header">Setting</li>
            <li class="dropdown {{ Request::is('departemen*') ? 'active' : '' }}">
                <a href="{{ route('departemen.index') }}" class="nav-link"><i class="fas fa-building"></i>
                    <span>Departemen</span></a>
            </li>
            <li class="dropdown {{ Request::is('account*') ? 'active' : '' }}">
                <a href="{{ route('account.index') }}" class="nav-link"><i class="far fa-user"></i>
                    <span>Users</span></a>
            </li>
            @if (auth()->user()->group_id == 1)
                <li class="dropdown {{ Request::is('role*') ? 'active' : '' }}">
                    <a href="{{ route('role.index') }}" class="nav-link"><i class="fas fa-user-cog"></i>
                        <span>Roles</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
