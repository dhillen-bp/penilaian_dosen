<?php

namespace App\Models;

use CodeIgniter\Model;

class AngkatanModel extends Model
{
    protected $table      = 'angkatan';
    protected $primaryKey = 'tahun_ajar';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['tahun_ajar', 'semester'];
}
