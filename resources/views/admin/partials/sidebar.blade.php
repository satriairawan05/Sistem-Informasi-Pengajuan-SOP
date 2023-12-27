@php
    $sop = 0;
    $jsa = 0;
    $ibpr = 0;
    $ik = 0;
    $form = 0;
    $dept = 0;
    $account = 0;

    $pages = \App\Models\User::leftJoin('group_pages', 'users.group_id', '=', 'group_pages.group_id')
        ->leftJoin('groups', 'users.group_id', '=', 'groups.group_id')
        ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
        ->where('group_pages.access', '=', 1)
        ->where('group_pages.group_id', '=', auth()->user()->group_id)
        ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
        ->get();

    foreach ($pages as $r) {
        if ($r->page_name == 'SOP') {
            if ($r->action == 'Read') {
                $sop = $r->access;
            }
        }

        if ($r->page_name == 'Interaksi Kerja') {
            if ($r->action == 'Read') {
                $ik = $r->access;
            }
        }

        if ($r->page_name == 'JSA') {
            if ($r->action == 'Read') {
                $jsa = $r->access;
            }
        }

        if ($r->page_name == 'IBPR') {
            if ($r->action == 'Read') {
                $ibpr = $r->access;
            }
        }

        if ($r->page_name == 'Formulir') {
            if ($r->action == 'Read') {
                $form = $r->access;
            }
        }

        if ($r->page_name == 'Departemen') {
            if ($r->action == 'Read') {
                $dept = $r->access;
            }
        }

        if ($r->page_name == 'User') {
            if ($r->action == 'Read') {
                $account = $r->access;
            }
        }
    }
@endphp

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
            @if ($sop == 1)
                <li class="dropdown {{ Request::is('sop*') ? 'active' : '' }}">
                    <a href="{{ route('sop.index') }}" class="nav-link"><i class="fas fa-envelope"></i>
                        <span>SOP</span></a>
                </li>
            @endif
            @if ($ik == 1)
                <li class="dropdown {{ Request::is('interaksi_kerja*') ? 'active' : '' }}">
                    <a href="{{ route('interaksi_kerja.index') }}" class="nav-link"><i class="fas fa-envelope"></i>
                        <span>Interaksi Kerja</span></a>
                </li>
            @endif
            @if ($form == 1)
                <li class="dropdown {{ Request::is('formulir*') ? 'active' : '' }}">
                    <a href="{{ route('formulir.index') }}" class="nav-link"><i class="fas fa-envelope"></i>
                        <span>Formulir</span></a>
                </li>
            @endif
            @if ($jsa == 1)
                <li class="dropdown {{ Request::is('jsa*') ? 'active' : '' }}">
                    <a href="{{ route('jsa.index') }}" class="nav-link"><i class="fas fa-envelope"></i>
                        <span>JSA</span></a>
                </li>
            @endif
            @if ($ibpr == 1)
                <li class="dropdown {{ Request::is('ibpr*') ? 'active' : '' }}">
                    <a href="{{ route('ibpr.index') }}" class="nav-link"><i class="fas fa-envelope"></i>
                        <span>IBPR</span></a>
                </li>
            @endif
            <li class="menu-header">Setting</li>
            @if ($dept == 1)
                <li class="dropdown {{ Request::is('departemen*') ? 'active' : '' }}">
                    <a href="{{ route('departemen.index') }}" class="nav-link"><i class="fas fa-building"></i>
                        <span>Departemen</span></a>
                </li>
            @endif)
            @if ($account == 1)
                <li class="dropdown {{ Request::is('account*') ? 'active' : '' }}">
                    <a href="{{ route('account.index') }}" class="nav-link"><i class="far fa-user"></i>
                        <span>Users</span></a>
                </li>
            @endif
            @if (auth()->user()->group_id == 1)
                <li class="dropdown {{ Request::is('role*') ? 'active' : '' }}">
                    <a href="{{ route('role.index') }}" class="nav-link"><i class="fas fa-user-cog"></i>
                        <span>Roles</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
