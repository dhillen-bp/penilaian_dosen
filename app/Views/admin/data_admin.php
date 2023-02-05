<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SPKD | Sistem Penilaian Kinerja Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/data_mahasiswa') ?>">Home</a></li>
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
                            <h3 class="card-title col-10">Data Dosen</h3>
                            <a href="/admin/tambah_admin"><button type="button" class="btn btn-primary btn-block col-2"><i class="fa fa-plus"></i> Tambah Admin</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Admin</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($admins as $admin) : ?>
                                        <tr>
                                            <td><?= $admin['id_admin']; ?></td>
                                            <td><?= $admin['username']; ?></td>
                                            <td><?= $admin['password']; ?></td>
                                            <td><?= $admin['level']; ?></td>
                                            <td>
                                                <a href="/admin/edit_admin/<?= $admin['id_admin']; ?>"> <button class="btn btn-primary"> Edit </button> </a>
                                                <a href="/admin/hapus_admin/<?= $admin['id_admin']; ?>" data-toggle="modal" data-target="#hapus-admin<?= $admin['id_admin']; ?>"> <button class="btn btn-danger"> Hapus </button> </a>
                                            </td>
                                        </tr>
                                        <!-- Modal Hapus Kuesioner -->
                                        <div class="modal fade" id="hapus-admin<?= $admin['id_admin']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-light">
                                                        <p>Anda Yakin Menghapus Data Kuesioner dengan ID : <b> <?= $admin['id_admin']; ?></b>?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between bg-light">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url(''); ?>/admin/hapus_admin/<?= $admin['id_admin'] ?>"><button type="submit" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- End Modal Hapus admin -->
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