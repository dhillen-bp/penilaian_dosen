<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\PenilaianDosenModel;
use App\Models\AngkatanModel;
use App\Models\MataKuliahModel;

class Mahasiswa extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('logged_in') !== TRUE) {
            return redirect()->to(base_url('login'));
        }
        $dosenModel = new DosenModel();

        $data = [
            'title' => 'Beranda',
            'dosens' => $dosenModel->findAll(),

        ];
        echo view('mahasiswa/beranda', $data);
    }

    public function nilai_dosen()
    {
        $session = session();
        if ($session->get('logged_in') !== TRUE) {
            return redirect()->to(base_url('login'));
        }
        $dosenModel = new DosenModel();
        $angkatanModel = new AngkatanModel();
        $matkulModel = new MataKuliahModel();
        $sessionID = session()->get('nim');
        $kdMatkul = $this->request->getPost('kd_matkul');
        $idDosen = $this->request->getPost('id_dosen');
        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules(['id_dosen' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data valid, simpan ke database
        if ($isDataValid) {
            $penilaianModel = new PenilaianDosenModel();
            // $dosenDanMatkulFilter = $kuesionerModel->query("SELECT id_dosen, kd_matkul, id_mahasiswa, COUNT(*) duplikat FROM kuesioner WHERE id_mahasiswa = '$sessionID' GROUP BY id_dosen, kd_matkul, id_mahasiswa HAVING COUNT(duplikat) = 1");
            // $numRowsDuplikat = $dosenDanMatkulFilter->getNumRows();
            if ($dosenModel->getDuplikat($sessionID, $idDosen, $kdMatkul)) {
                $session->setFlashdata('msg', 'Anda Telah Melakukan Penilaian Dosen! Penilaian hanya bisa Sekali');
                return redirect()->to('mahasiswa/nilai_dosen');
            } else {
                $penilaianModel->insert([
                    "pedagogik" => $this->request->getPost('pedagogik'),
                    "profesional" => $this->request->getPost('profesional'),
                    "kepribadian" => $this->request->getPost('kepribadian'),
                    "sosial" => $this->request->getPost('sosial'),
                    "id_mahasiswa" => $this->request->getPost('id_mahasiswa'),
                    "id_dosen" => $this->request->getPost('id_dosen'),
                    "id_angkatan" => $this->request->getPost('id_angkatan'),
                    "id_semester" => $this->request->getPost('id_semester'),
                    "kd_matkul" => $this->request->getPost('kd_matkul'),
                    "pesan_kesan" => $this->request->getPost('pesan_kesan'),
                ]);
                return redirect()->to('mahasiswa/')->withInput();
            }
        }
        //$hasilDosenFilter = $dosenNumRows < 1 ? $dosenFilter : "Telah Melakukan Penilaian";

        $data = [
            'title'  => "Penilaian Dosen",
            'dosens' => $dosenModel->findAll(),
            'angkatans' => $angkatanModel->findAll(),
            'matkuls' => $matkulModel->findAll(),
        ];

        // tampilkan form create
        echo view('mahasiswa/nilai_dosen', $data);
    }

    public function detail_dosen($nidn)
    {
        $session = session();
        if ($session->get('logged_in') !== TRUE) {
            return redirect()->to(base_url('login'));
        }
        $dosenModel = new DosenModel();
        $kuesionerModel = new PenilaianDosenModel();
        // $sumPedagogik = $kuesionerModel->selectSum('pedagogik', 'p1')->where('id_dosen', $nidn);
        $query = $kuesionerModel->query("SELECT * FROM kuesioner WHERE id_dosen = '$nidn'");
        $numRows = $query->getNumRows();
        $sumPedagogik = $kuesionerModel->select('sum(pedagogik) as p1')->where('id_dosen', $nidn)->first();
        $sumProfesional = $kuesionerModel->select('sum(profesional) as p2')->where('id_dosen', $nidn)->first();
        $sumKepribadian = $kuesionerModel->select('sum(kepribadian) as p3')->where('id_dosen', $nidn)->first();
        $sumSosial = $kuesionerModel->select('sum(sosial) as p4')->where('id_dosen', $nidn)->first();
        if ($numRows < 1) {
            $totalRating = "Belum Ada Nilai";
        } else {
            $totalRating = (((float) $sumPedagogik['p1'] / $numRows) + ((float) $sumProfesional['p2'] / $numRows) + ((float) $sumKepribadian['p3'] / $numRows) + ((float) $sumSosial['p4'] / $numRows)) / 4;
            $totalRating = round($totalRating, 2);
        }

        $angkatanModel = new AngkatanModel();
        $label = $angkatanModel->findColumn('tahun_ajar');
        $dataChart = [$this->getAvg($label[0], $nidn), $this->getAvg($label[1], $nidn), $this->getAvg($label[2], $nidn), $this->getAvg($label[3], $nidn), $this->getAvg($label[4], $nidn), $this->getAvg($label[5], $nidn), $this->getAvg($label[6], $nidn), $this->getAvg($label[7], $nidn)];

        $data = [
            'title' => 'Detail Dosen',
            'dosens' => $dosenModel->where('nidn', $nidn)->first(),
            'rating' => $totalRating,
            'labelChart' => $label,
            'dataset' => $dataChart
        ];
        echo view('mahasiswa/detail_dosen', $data);
    }

    // public function dosen_terbaik()
    // {
    //     $session = session();
    //     $dosenModel = new DosenModel();
    //     $joinDosen = $dosenModel->joinDosenKuesioner()->getResultArray();

    //     foreach ($joinDosen as $dosen) {
    //         $nidn = $dosen['id_dosen'];
    //         $kuesionerModel = new PenilaianDosenModel();
    //         // $sumPedagogik = $kuesionerModel->selectSum('pedagogik', 'p1')->where('id_dosen', $nidn);
    //         $query = $kuesionerModel->query("SELECT * FROM kuesioner JOIN dosen ON dosen.nidn = kuesioner.id_dosen WHERE kuesioner.id_dosen = '001'");

    //         $numRows = $query->getNumRows();
    //         $sumPedagogik = $kuesionerModel->select('sum(pedagogik) as p1')->where('id_dosen', $nidn)->first();
    //         $sumProfesional = $kuesionerModel->select('sum(profesional) as p2')->where('id_dosen', $nidn)->first();
    //         $sumKepribadian = $kuesionerModel->select('sum(kepribadian) as p3')->where('id_dosen', $nidn)->first();
    //         $sumSosial = $kuesionerModel->select('sum(sosial) as p4')->where('id_dosen', $nidn)->first();

    //         if ($numRows < 1) {
    //             $rating = "Belum Ada Nilai";
    //         } else {
    //             $rating = (((float) $sumPedagogik['p1'] / $numRows) + ((float) $sumProfesional['p2'] / $numRows) + ((float) $sumKepribadian['p3'] / $numRows) + ((float) $sumSosial['p4'] / $numRows)) / 4;
    //             $rating = round($rating, 2);
    //         }
    //         $totalRating[3] = [$rating, $rating, $rating];
    //     }

    //     $data = [
    //         'title' => 'Daftar Dosen Terbaik',
    //         'dosens' => $dosenModel->findAll(),
    //         'rating' => $rating
    //     ];
    //     echo view('mahasiswa/dosen_terbaik', $data);
    // }

    public function getAvg($tahun, $nidn)
    {
        $kuesionerModel = new PenilaianDosenModel();
        $query = $kuesionerModel->query("SELECT * FROM kuesioner WHERE id_dosen = '$nidn' AND id_angkatan = '$tahun'");
        $numRows = $query->getNumRows();

        if ($numRows < 1) {
            return 0;
        } else {
            $sumPedagogik = $kuesionerModel->select("sum(pedagogik) as p1")->where('id_dosen', $nidn)->where('id_angkatan', $tahun)->first();
            $sumProfesional = $kuesionerModel->select("sum(profesional) as p2")->where('id_dosen', $nidn)->where('id_angkatan', $tahun)->first();
            $sumKepribadian = $kuesionerModel->select("sum(kepribadian) as p3")->where('id_dosen', $nidn)->where('id_angkatan', $tahun)->first();
            $sumSosial = $kuesionerModel->select("sum(sosial) as p4")->where('id_dosen', $nidn)->where('id_angkatan', $tahun)->first();
            return (((float) $sumPedagogik['p1'] / $numRows) + ((float) $sumProfesional['p2'] / $numRows) + ((float) $sumKepribadian['p3'] / $numRows) + ((float) $sumSosial['p4'] / $numRows)) / 4;
        }
    }
}
