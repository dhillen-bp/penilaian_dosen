<?= $this->extend('mahasiswa/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/mahasiswa')  ?>">Home</a></li>
                        <li class="breadcrumb-item active">Penilaian Dosen</li>
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
                            <h3 class="card-title">Penilaian Dosen</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" action="" method="post">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="id_kuesioner">ID Kuesioner</label>
                                    <input type="text" name="id_kuesioner" class="form-control" id="id_kuesioner" placeholder="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="pedagogik">Nilai Pedagogik = <b id="rangeval">1</b></label>
                                    <small class="text-muted ml-2">(Kemampuan dosen mengelola pembelajaran peserta didik)</small>
                                    <input type="range" class="custom-range" name="pedagogik" id="pedagogik" value="1" min="1" max="10" step="1" onInput="$('#rangeval').html($(this).val())" required />
                                    <!-- <label for="pedagogik">Nilai Pedagogik</label>
                                    <input type="number" name="pedagogik" class="form-control" id="pedagogik" placeholder=""> -->
                                </div>
                                <div class="form-group">
                                    <label for="profesional">Nilai Profesional = <b id="rangeval2">1</b></label>
                                    <small class="text-muted ml-2">(Kemampuan penguasaan materi pembelajaran secara luas dan mendalam yang dimiliki dosen) </small>
                                    <input type="range" class="custom-range" name="profesional" id="profesional" value="1" min="1" max="10" step="1" onInput="$('#rangeval2').html($(this).val())" required />
                                </div>
                                <div class="form-group">
                                    <label for="kepribadian">Nilai Kepribadian = <b id="rangeval3">1</b></label>
                                    <small class="text-muted ml-2">(Kemampuan kepribadian yang mantap, berakhklak mulia, arif dan berwibawa serta menjadi teladan yang baik yang dimiliki dosen) </small>
                                    <input type="range" class="custom-range" name="kepribadian" id="kepribadian" value="1" min="1" max="10" step="1" onInput="$('#rangeval3').html($(this).val())" required />
                                </div>
                                <div class="form-group">
                                    <label for="sosial">Nilai Sosial = <b id="rangeval4">1</b></label>
                                    <small class="text-muted ml-2">(Kemampuan dosen untuk berkomunikasi dan berinteraksi secara efektif dan efisien dengan peserta didik) </small>
                                    <input type="range" class="custom-range" name="sosial" id="sosial" value="1" min="1" max="10" step="1" onInput="$('#rangeval4').html($(this).val())" required />
                                </div>
                                <div class="form-group">
                                    <label for="id_mahasiswa">ID Mahasiswa</label>
                                    <input type="text" name="id_mahasiswa" class="form-control" id="id_mahasiswa" readonly value="<?= session()->get('nim'); ?>">
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
                                <div class="form-group">
                                    <label for="status">Mata Kuliah</label>
                                    <select class="custom-select" name="kd_matkul" id="kd_matkul">
                                        <?php
                                        foreach ($matkuls as $matkul) : ?>
                                            <option value="<?= $matkul['kd_matkul']; ?>"><?= $matkul['nm_matkul']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pesan_kesan">Pesan dan Kesan</label>
                                    <textarea name="pesan_kesan" class="form-control" id="pesan_kesan" required rows="3"></textarea>
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