<?php

namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    protected $table      = 'mata_kuliah';
    protected $primaryKey = 'kd_matkul';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['kd_matkul', 'nm_matkul', 'id_angkatan', 'semester', 'id_dosen'];
}
