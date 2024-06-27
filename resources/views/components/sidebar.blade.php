<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{!! route('dashboard') !!}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        features
    </div>

    <!-- Nav Item - Tags -->
    <li class="nav-item @yield('tags')">
        <a class="nav-link" href="{!! route('tags.index') !!}">
            <i class="fa fa-tags"></i>
            <span>Tags</span></a>
    </li>

    <!-- Nav Item - Services -->
    <li class="nav-item @yield('services')">
        <a class="nav-link" href="{!! route('services.index') !!}">
            <i class="fa fa-list-ul"></i>
            <span>Services</span></a>
    </li>

    <!-- Nav Item - Products -->
    <li class="nav-item @yield('products')">
        <a class="nav-link" href="{!! route('products.index') !!}">
            <i class="fa fa-archive"></i>
            <span>Products</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>