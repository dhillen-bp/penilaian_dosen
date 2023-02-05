<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/data_mahasiswa')  ?>">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item active">Tambah Mahasiswa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Mahasiswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" action="" method="post">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="nim">Nomor Induk Mahasiswa</label>
                                    <input type="text" name="nim" class="form-control" id="nim" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Mahasiswa</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Masuk</label> <small class="text-danger">* </small><small class="text-muted">Contoh : 2020</small>
                                    <input type="text" name="tahun_masuk" class="form-control" id="tahun_masuk" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" required>
                                        <label class="custom-control-label" for="exampleCheck1">Pastikan telah mengisi form dengan benar!</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="submit" class="btn btn-default float-right" id="back">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script>
        // tombol kembali
        let btnBack = document.getElementById('back');
        btnBack.addEventListener('click', () => {
            window.history.back();
        });
    </script>

</div>

<?= $this->endSection(); ?>