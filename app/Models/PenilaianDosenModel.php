<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianDosenModel extends Model
{
    protected $table      = 'kuesioner';
    protected $primaryKey = 'id_kuesioner';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_kuesioner', 'pedagogik', 'profesional', 'kepribadian', 'sosial', 'id_mahasiswa', 'id_dosen', 'id_angkatan', 'id_semester', 'kd_matkul', 'pesan_kesan'];
}
