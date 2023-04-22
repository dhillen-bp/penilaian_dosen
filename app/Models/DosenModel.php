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

    public function getDuplikat($sessionID, $idDosen, $kdMatkul)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT id_dosen, kd_matkul, id_mahasiswa, COUNT(*) duplikat FROM kuesioner WHERE id_mahasiswa = '$sessionID' AND id_dosen = '$idDosen' AND kd_matkul = '$kdMatkul' GROUP BY id_dosen, kd_matkul, id_mahasiswa HAVING COUNT(duplikat) >= 1";
        return $db->query($sql)->getResultArray();
    }
}
