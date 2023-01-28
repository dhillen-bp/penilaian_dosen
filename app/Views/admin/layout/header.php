<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <base href="<?= base_url('assets') ?>/">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-purple navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <?php if (session()->get('level') == 'admin') : ?>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?= base_url('/admin/data_mahasiswa')  ?>" class="nav-link">Data Mahasiswa</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?= base_url('/admin/data_dosen')  ?>" class="nav-link">Data Dosen</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?= base_url('/admin/data_kuesioner')  ?>" class="nav-link">Data Kuesioner</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?= base_url('/admin/data_admin')  ?>" class="nav-link">Data Admin</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Account -->
                <li class="nav-item dropdown">
                    <a href="/#" class="bg-purple dropdown-item" data-toggle="dropdown">
                        <div class="image user-panel">
                            <img src="img/user_profile/new_user.png" alt="User Avatar" class="img-size-20 img-bordered-sm img-circle">
                            <div class="image">
                                <h3 class="dropdown-item-title username text-light">
                                    <?= session()->get('username') ?>
                                </h3>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center">
                        <div href="#" class="dropdown-item">
                            <!-- Profil Start -->
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="img/user_profile/new_user.png" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?= session()->get('username') ?></h3>

                                <p class="text-muted text-center"> <?= session()->get('level') ?></p>
                            </div>
                            <!-- Profil End -->
                        </div>
                        <div class="dropdown-divider"></div>

                        <a href="<?= base_url(); ?>/admin/logout" class="btn btn-danger btn-block"><b> Logout <i class="fas fa-sign-out-alt ml-1"></i></b></a>
                    </div>
                </li>
                <!-- END Profil Dropdown Menu -->
            </ul>
        </nav>
        <!-- /.navbar -->