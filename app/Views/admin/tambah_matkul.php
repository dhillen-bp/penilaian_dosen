<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Mata Kuliah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/data_mahasiswa')  ?>">Data Mata Kuliah</a></li>
                        <li class="breadcrumb-item active">Tambah Mata Kuliah</li>
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
                            <h3 class="card-title">Tambah Mata Kuliah</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" action="" method="post">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="kd_matkul">Kode Mata Kuliah</label>
                                    <input type="text" name="kd_matkul" class="form-control" id="kd_matkul" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="nm_matkul">Nama Mata Kuliah</label>
                                    <input type="text" name="nm_matkul" class="form-control" id="nm_matkul" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="status">Dosen</label>
                                    <select class="custom-select" name="id_dosen" id="id_dosen" required>
                                        <?php

                                        foreach ($dosens as $dosen) : ?>
                                            <option value="<?= $dosen['nidn']; ?>" <?= ($dosen['nm_dosen'] == $dosen['nidn']) ? 'selected' : '' ?>><?= $dosen['nm_dosen']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Tahun Ajar</label>
                                    <select class="custom-select" name="id_angkatan" id="id_angkatan">
                                        <?php
                                        foreach ($angkatans as $angkatan) : ?>
                                            <option value="<?= $angkatan['tahun_ajar']; ?>"><?= $angkatan['tahun_ajar']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_semester">Semester</label>
                                    <input type="text" name="id_semester" class="form-control" id="id_semester" required>
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