<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pages
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#homepage" aria-expanded="true" aria-controls="homepage">
            <i class="fas fa-fw fa-cog"></i>
            <span>Homepage</span>
        </a>
        <div id="homepage" class="collapse" aria-labelledby="homepage" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Homepage Contents:</h6>
                <a class="collapse-item" href="buttons.html">Sliders</a>
                <a class="collapse-item" href="cards.html">Service</a>
                <a class="collapse-item" href="cards.html">About</a>
            </div>
        </div>
        <a class="nav-link " href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>About</span>
        </a>
        <a class="nav-link " href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Teams</span>
        </a>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#components" aria-expanded="true" aria-controls="components">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="components" class="collapse" aria-labelledby="components" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Other Components:</h6>
                <a class="collapse-item" href="buttons.html">Services</a>
                <a class="collapse-item" href="cards.html">Testimonials</a>
                <a class="collapse-item" href="cards.html">Faqs</a>
                <a class="collapse-item" href="cards.html">Partners/Clients</a>
            </div>
        </div>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blogs" aria-expanded="true" aria-controls="blogs">
            <i class="fas fa-fw fa-cog"></i>
            <span>Blogs</span>
        </a>
        <div id="blogs" class="collapse" aria-labelledby="blogs" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Blog Components:</h6>
                <a class="collapse-item" href="buttons.html">Blog Category</a>
                <a class="collapse-item" href="cards.html">Blog Post</a>
                <a class="collapse-item" href="cards.html">Comments</a>
            </div>
        </div>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Contact
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-folder"></i>
            <span>Contact Details</span>
        </a>

    </li>
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-folder"></i>
            <span>Contact Message</span>
        </a>

    </li>
</ul>
<!-- End of Sidebar -->
