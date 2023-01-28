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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Kuesioner</th>
                                        <th>Pedagogik</th>
                                        <th>Profesional</th>
                                        <th>Kepribadian</th>
                                        <th>Sosial</th>
                                        <th>ID Mahasiswa</th>
                                        <th>ID Dosen</th>
                                        <th>ID Angkatan</th>
                                        <th>Semester</th>
                                        <th>Kode Matkul</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kuesioners as $kuesioner) : ?>
                                        <tr>
                                            <td><?= $kuesioner['id_kuesioner']; ?></td>
                                            <td><?= $kuesioner['pedagogik']; ?></td>
                                            <td><?= $kuesioner['profesional']; ?></td>
                                            <td><?= $kuesioner['kepribadian']; ?></td>
                                            <td><?= $kuesioner['sosial']; ?></td>
                                            <td><?= $kuesioner['id_mahasiswa']; ?></td>
                                            <td><?= $kuesioner['id_dosen']; ?></td>
                                            <td><?= $kuesioner['id_angkatan']; ?></td>
                                            <td><?= $kuesioner['id_semester']; ?></td>
                                            <td><?= $kuesioner['kd_matkul']; ?></td>
                                            <td>
                                                <a href="/admin/hapus_kuesioner/<?= $kuesioner['id_kuesioner']; ?>" data-toggle="modal" data-target="#hapus-kuesioner<?= $kuesioner['id_kuesioner']; ?>"> <button class="btn btn-danger"> Hapus </button> </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Hapus Kuesioner -->
                                        <div class="modal fade" id="hapus-kuesioner<?= $kuesioner['id_kuesioner']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-light">
                                                        <p>Anda Yakin Menghapus Data Kuesioner dengan ID : <b> <?= $kuesioner['id_kuesioner']; ?></b>?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between bg-light">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url(''); ?>/admin/hapus_kuesioner/<?= $kuesioner['id_kuesioner'] ?>"><button type="submit" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- End Modal Hapus kuesioner -->
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