<nav class="sidebar sidebar-offcanvas" id="sidebar">
    
    <ul class="nav">

        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        @auth('admin')
        <li class="nav-item menu-items @if ( request()->segment(1) === 'dashboard')  active @endif">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        @can('Show Roles And Permissions')    
        <li class="nav-item menu-items @if ( request()->segment(1) === 'role')  active @endif">
            <a class="nav-link" href="{{ route('role.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">Roles And Permissions</span>
            </a>
        </li>
        @endcan

        @can('Show Managers')
        <li class="nav-item menu-items @if ( request()->segment(1) === 'admin')  active @endif">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-account-star"></i>
                </span>
                <span class="menu-title">Managers</span>
            </a>
        </li>
        @endcan
        
        @can('Show Users')
        <li class="nav-item menu-items @if ( request()->segment(1) === 'user')  active @endif">
            <a class="nav-link" href="{{ route('user.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title">Users</span>
            </a>
        </li>
        @endcan
        
        @can('Show Pharmacies')
        <li class="nav-item menu-items @if ( request()->segment(1) === 'pharmacy')  active @endif">
            <a class="nav-link" href="{{ route('pharmacy.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-pill"></i>
                </span>
                <span class="menu-title">Pharamcies</span>
            </a>
        </li>
        @endcan

        @can('Add Timetables')
        <li class="nav-item menu-items @if ( request()->segment(1) === 'timetable')  active @endif">
            <a class="nav-link" href="{{ route('timetable.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-calendar-clock"></i>
                </span>
                <span class="menu-title">Timetable</span>
            </a>
        </li>
        @endcan
        @endauth

        @auth('web')
        <li class="nav-item menu-items @if ( request()->segment(1) === 'home')  active @endif">
            <a class="nav-link" href="{{ route('home.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-calendar-clock"></i>
                </span>
                <span class="menu-title">Timetable</span>
            </a>
        </li>
        @endauth
        
    </ul>
</nav>
