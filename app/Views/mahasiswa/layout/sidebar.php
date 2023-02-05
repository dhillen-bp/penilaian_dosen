<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/mahasiswa')  ?>" class="brand-link">
        <img src="img/logo/amikomska.png" alt="Amikom Solo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SPKD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3 pb-3 d-flex">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari Menu" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('/mahasiswa')  ?>" class="nav-link">
                        <i class="fa fa-table nav-icon"></i>
                        <p>Data Dosen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/mahasiswa/nilai_dosen')  ?>" class="nav-link">
                        <i class="fa fa-edit nav-icon"></i>
                        <p>Penilaian Dosen</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>