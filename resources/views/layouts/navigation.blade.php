<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Bakery Shop</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <li class="{{ Route::is('dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="menu-label">Admin</li>
            <li class="{{ Route::is('users.index') ? 'mm-active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">manage_accounts</i>
                    </div>
                    <div class="menu-title">User Management</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
    </div>
</aside>
