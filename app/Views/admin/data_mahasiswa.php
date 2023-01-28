<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SPDK | Sistem Penilaian Kinerja Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index?page=">Home</a></li>
                        <li class="breadcrumb-item active">Data Dosen</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-9">Data Mahasiswa</h3>
                            <a href="/admin/tambah_mahasiswa"><button type="button" class="btn btn-primary btn-block col-3"><i class="fa fa-plus"></i> Tambah Mahasiswa</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Tahun Masuk</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mahasiswa as $mhs) : ?>
                                        <tr>
                                            <td><?= $mhs['nim']; ?></td>
                                            <td><?= $mhs['nama']; ?></td>
                                            <td><?= $mhs['tahun_masuk']; ?></td>
                                            <td><?= $mhs['username']; ?></td>
                                            <td class="text-muted"><?= "enkripsi"; ?></td>
                                            <td>
                                                <a href="/admin/edit_mahasiswa/<?= $mhs['nim']; ?>"> <button class="btn btn-primary"> Edit </button> </a>
                                                <a href="/admin/hapus_mahasiswa/<?= $mhs['nim']; ?>" data-toggle="modal" data-target="#hapus-mahasiswa<?= $mhs['nim']; ?>"> <button class="btn btn-danger"> Hapus </button> </a>
                                            </td>
                                            <!-- Modal Hapus Mahasiswa -->
                                            <div class="modal fade" id="hapus-mahasiswa<?= $mhs['nim']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body bg-light">
                                                            <p>Anda Yakin Menghapus Data NIM : <b> <?= $mhs['nim']; ?> </b> dengan Nama : <b> <?= $mhs['nama']; ?></b>?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between bg-light">
                                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                            <a href="<?= base_url(''); ?>/admin/hapus_mahasiswa/<?= $mhs['nim'] ?>"><button type="submit" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- End Modal Hapus Mahasiswa -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection(); ?>