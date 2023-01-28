<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 'dosen';
    protected $primaryKey = 'nidn';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['nidn', 'nm_dosen', 'email', 'foto_dosen'];

    public function joinDosenKuesioner()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('dosen');
        $builder->select('kuesioner.id_dosen, dosen.nm_dosen');
        $builder->join('kuesioner', 'dosen.nidn = kuesioner.id_dosen');
        return $builder->get();
    }
}
