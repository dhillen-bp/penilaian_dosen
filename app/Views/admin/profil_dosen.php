<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/profil_dosen')  ?>">Home</a></li>
                        <li class="breadcrumb-item active">Profil Dosen</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- About Me Box -->
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Data Dosen</h3>
                        </div>
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle mt-4" src="<?= base_url('assets') ?>/img/dosen/<?= $dosens['foto_dosen']; ?>" alt="User profile picture">
                            <h3 class="profile-username text-center"><?= $dosens['nm_dosen']; ?></h3>
                            <p class="text-primary text-center"><?= $dosens['email']; ?></p>
                        </div>
                        <hr>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <strong><i class="fas fa-circle mr-1"></i> NIDN</strong>
                            <p class="text-muted"><?= $dosens['nidn']; ?></p>

                            <hr>

                            <strong><i class="fas fa-user mr-1"></i> Nama Dosen</strong>
                            <p class="text-muted"><?= $dosens['nm_dosen']; ?></p>
                            <hr>

                            <strong><i class="fas fa-star mr-1"></i> Total Rating</strong>

                            <p class="text-muted"><?= $rating ?></p>

                            <hr>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pesan" data-toggle="tab">Pesan dan Kesan</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pesan">
                                <!-- /.card-body -->
                                <!-- Post -->
                                <div class="card-body">
                                    <?php foreach ($kuesioners as $kuesioner) : ?>
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="<?= base_url('assets/img/book.png'); ?>" alt="user image">
                                                <span class="username">
                                                    <span class="text text-info">Mata Kuliah : <?= $kuesioner['kd_matkul']; ?></span>
                                                </span>
                                                <span class="description">Tahun Ajaran <?= $kuesioner['id_angkatan']; ?></span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                <?= $kuesioner['pesan_kesan']; ?>
                                            </p>


                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <!-- /.post -->
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection(); ?>