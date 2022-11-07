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
            <li class="nav-item">
                <a href="{{ route("admin.assets.index") }}"
                    class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-lemon-o nav-icon"></i>
                    List Bahan
                </a>
            </li>
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
            @can('transaction_management')
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cart-arrow-down nav-icon"></i>
                    Transaksi Manajemen
                </a>
                <ul class="nav-dropdown-items">
                    @can('pemasukan_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.pemasukan.index") }}"
                            class="nav-link {{ request()->is('admin/pemasukan') || request()->is('admin/pemasukan/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-download nav-icon"></i>
                            Pemasukan
                        </a>
                    </li>
                    @endcan
                    @can('pengeluaran_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.pengeluaran.index") }}"
                            class="nav-link {{ request()->is('admin/pengeluaran') || request()->is('admin/pengeluaran/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-upload nav-icon"></i>
                            Pengeluaran
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('transaction_access')
            
            @endcan
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
