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
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/data_mahasiswa')  ?>">Home</a></li>
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
                            <h3 class="card-title col-9">Data Dosen</h3>
                            <a href="/admin/tambah_dosen"><button type="button" class="btn btn-primary btn-block col-3"><i class="fa fa-plus"></i> Tambah Dosen</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Email</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dosens as $dosen) : ?>
                                        <tr>
                                            <td><?= $dosen['nidn']; ?></td>
                                            <td><?= $dosen['nm_dosen']; ?></td>
                                            <td><?= $dosen['email']; ?></td>
                                            <td><img src="img/dosen/<?= $dosen['foto_dosen']; ?>" alt="" width="100"></td>
                                            <td>
                                                <a href="/admin/edit_dosen/<?= $dosen['nidn']; ?>"> <button class="btn btn-primary"> Edit </button> </a>
                                                <a href="/admin/hapus_dosen/<?= $dosen['nidn']; ?>" data-toggle="modal" data-target="#hapus-dosen<?= $dosen['nidn']; ?>"> <button class="btn btn-danger"> Hapus </button> </a>
                                            </td>
                                        </tr>
                                        <!-- Modal Hapus Kuesioner -->
                                        <div class="modal fade" id="hapus-dosen<?= $dosen['nidn']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-light">
                                                        <p>Anda Yakin Menghapus Data Kuesioner dengan ID : <b> <?= $dosen['nidn']; ?></b>?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between bg-light">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url(''); ?>/admin/hapus_dosen/<?= $dosen['nidn'] ?>"><button type="submit" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- End Modal Hapus dosen -->
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