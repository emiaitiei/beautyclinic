<div class="main-header">
    <div class="main-header-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="light">
        <a href="<?= base_url() ?>" style="color:white;">
            Beauty Clinic
        </a>
        <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
        </button>
        </div>
        <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
        </button>
    </div>
    <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav
    class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
    >
    <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
        <li class="nav-item topbar-user dropdown hidden-caret">
            <a
            class="dropdown-toggle profile-pic"
            data-bs-toggle="dropdown"
            href="#"
            aria-expanded="false"
            >
            <span class="profile-username">
                <span class="op-7">Halo,</span>
                <span class="fw-bold"><?= session()->get('nama_user'); ?></span>
            </span>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                    <a class="dropdown-item" href="/logout">Logout</a>
                </li>
            </div>
            </ul>
        </li>
        </ul>
    </div>
    </nav>
    <!-- End Navbar -->
</div>