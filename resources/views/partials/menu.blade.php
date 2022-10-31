<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @can('user_management_access')
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon"></i>
                    Manajemen User
                </a>
                <ul class="nav-dropdown-items">
                    @can('permission_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}"
                            class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-unlock-alt nav-icon"></i>
                            Permission
                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}"
                            class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-briefcase nav-icon"></i>
                            Role
                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}"
                            class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user nav-icon"></i>
                            User
                        </a>
                    </li>
                    @endcan
                    @can('team_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.teams.index") }}"
                            class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-users nav-icon"></i>
                            Cabang
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('asset_access')
            
            @endcan
            @can('stock_access')
            <li class="nav-item">
                <a href="{{ route("admin.stocks.index") }}"
                    class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-lemon-o nav-icon"></i>
                    Stok Bahan
                </a>
            </li>
            @endcan
            @can('transaction_access')
            
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')

            @endcan
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
