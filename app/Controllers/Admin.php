<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\PenilaianDosenModel;
use App\Models\AngkatanModel;
use App\Models\MataKuliahModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Admin extends BaseController
{

    public function index()
    {
        if (session()->get('logged_in_admin') == true) {
            return redirect()->to(base_url('admin/data_mahasiswa'));
        }
        helper(['form']);
        echo view('admin/login');
    }

    public function login()
    {
        $session = session();
        $model = new AdminModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $level = $this->request->getVar('level');
        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_admin'       => $data['id_admin'],
                    'username'  => $data['username'],
                    'level'      => $data['level'],
                    'logged_in_admin' => TRUE
                ];
                $session->set($ses_data);
                if ($ses_data['level'] == 'admin') {
                    return redirect()->to(base_url('admin/data_mahasiswa'));
                } elseif ($ses_data['level'] == 'dosen') {
                    return redirect()->to(base_url('admin/profil_dosen'));
                } else {
                    $session->setFlashdata('msg', 'Anda Bukan Admin!');
                    return redirect()->to(base_url('admin/index'));
                }
            } else {
                $session->setFlashdata('msg', 'Password Salah!');
                return redirect()->to(base_url('admin/index'));
            }
        } else {
            $session->setFlashdata('msg', 'Username Tidak Ditemukan!');
            return redirect()->to(base_url('admin/index'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('admin/index'));
    }

    public function data_mahasiswa()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $mhsModel = new MahasiswaModel();
        $data = [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $mhsModel->findAll()
        ];
        echo view('admin/data_mahasiswa', $data);
    }

    public function tambah_mahasiswa()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules(['nim' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $mhsModel = new MahasiswaModel();
            $mhsModel->save([
                "nim" => $this->request->getVar('nim'),
                "nama" => $this->request->getVar('nama'),
                "tahun_masuk" => $this->request->getVar('tahun_masuk'),
                "username" => $this->request->getVar('username'),
                "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            return redirect()->to('admin/data_mahasiswa');
        }

        $data = [
            'title'  => "Tambah Mahasiswa",
        ];
        // tampilkan form create
        echo view('admin/tambah_mahasiswa', $data);
    }

    public function edit_mahasiswa($id)
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $mhsModel = new MahasiswaModel();
        $data = [
            'title' => 'Edit Mahasiswa',
            'mhs' => $mhsModel->where('nim', $id)->first()
        ];

        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules(['nim' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $mhsModel = new MahasiswaModel();
            $mhs = $mhsModel->save([
                "nim" => $this->request->getVar('nim'),
                "nama" => $this->request->getVar('nama'),
                "tahun_masuk" => $this->request->getVar('tahun_masuk'),
                "username" => $this->request->getVar('username'),
                "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            return redirect()->to('admin/data_mahasiswa');
        }

        return view('admin/edit_mahasiswa', $data);
    }

    public function hapus_mahasiswa($id)
    {
        $mhsModel = new MahasiswaModel();
        // cari gambar berdasarkan id
        $mhs = $mhsModel->find($id);

        $mhsModel->delete($id);
        $getNim = $mhs['nim'];
        session()->setFlashdata('msg', "Data $getNim  berhasil dihapus.");
        return redirect()->to('admin/data_mahasiswa');
    }

    public function data_dosen()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $session = session();
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Data Dosen',
            'dosens' => $dosenModel->findAll()
        ];
        echo view('admin/data_dosen', $data);
    }

    public function tambah_dosen()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $data = [
            'title'  => "Tambah Dosen",
            'validation' => \Config\Services::validation()
        ];
        // tampilkan form create
        echo view('admin/tambah_dosen', $data);

        if (isset($_POST['submit'])) {
            $dosenModel = new DosenModel();
            // validasi input
            if (!$this->validate([
                'nidn' => [
                    'rules' => 'is_unique[dosen.nidn]',
                    'errors' => [
                        'is_unique' => '{field} nidn sudah ada!'
                    ]
                ],
                'foto_dosen' => [
                    'rules' => 'max_size[foto_dosen,2048]|is_image[foto_dosen]|mime_in[foto_dosen,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar melebihi 2mb!',
                        'is_image' => 'File yang anda pilih bukan gambar!',
                        'mime_in' => 'File yang anda pilih bukan gambar!'
                    ]
                ]
            ])) {
                // $validation = \Config\Services::validation();
                // return redirect()->to(base_url('admin/tambah_dosen'))->withInput()->with('validation', $validation);
                return redirect()->to(base_url('admin/tambah_dosen'))->withInput();
            }

            // ambil gambar
            $fileFoto = $this->request->getFile('foto_dosen');
            // apakah tidak ada gambar yg di upload
            if ($fileFoto->getError() == 4) {
                $namaFoto = 'default.jpg';
            } else {
                // generate nama foto random jika gamau pake nama ori
                $namaFoto = $fileFoto->getRandomName();
                // pindahkan file ke folder img
                $fileFoto->move('assets/img/dosen/', $namaFoto);
            }

            // ambil nama file ori
            // $namaFoto = $fileFoto->getName();
            $dosenModel->save([
                'nidn' => $this->request->getVar('nidn'),
                'nm_dosen' => $this->request->getVar('nm_dosen'),
                'email' => $this->request->getVar('email'),
                'foto_dosen' => $namaFoto,
            ]);

            session()->setFlashdata('msg', 'Data berhasil ditambahkan.');

            return redirect()->to(base_url('admin/data_dosen'));
        }
    }

    public function edit_dosen($id)
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Edit Dosen',
            'validation' => \Config\Services::validation(),
            'dosen' => $dosenModel->where('nidn', $id)->first()
        ];
        echo view('admin/edit_dosen', $data);

        if (isset($_POST['submit'])) {
            $dosenModel = new DosenModel();
            // validasi input
            if (!$this->validate([
                'foto_dosen' => [
                    'rules' => 'max_size[foto_dosen,2048]|is_image[foto_dosen]|mime_in[foto_dosen,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar melebihi 2mb!',
                        'is_image' => 'File yang anda pilih bukan gambar!',
                        'mime_in' => 'File yang anda pilih bukan gambar!'
                    ]
                ]
            ])) {
                // $validation = \Config\Services::validation();
                // return redirect()->to(base_url('admin/tambah_dosen'))->withInput()->with('validation', $validation);
                return redirect()->to(base_url('admin/edit_dosen/' . $this->request->getVar('nidn')))->withInput();
            }

            // ambil gambar
            $fileFoto = $this->request->getFile('foto_dosen');
            // cek gambar apakah gambar lama
            $namaFotoLama = $this->request->getVar('namaFotoLama');

            if ($fileFoto->getError() == 4) {
                $namaFoto = $namaFotoLama;
            } else {
                // generate nama file random
                $namaFoto = $fileFoto->getRandomName();
                // pindahkan gambar
                $fileFoto->move('assets/img/dosen/', $namaFoto);
                if ($namaFotoLama != 'default.jpg') {
                    // hapus file yang lama
                    unlink('assets/img/dosen/' . $namaFotoLama);
                }
            }

            // $namaFoto = $fileFoto->getName();
            $dosenModel->save([
                'nidn' => $this->request->getVar('nidn'),
                'nm_dosen' => $this->request->getVar('nm_dosen'),
                'email' => $this->request->getVar('email'),
                'foto_dosen' => $namaFoto,

            ]);

            session()->setFlashdata('msg', 'Data berhasil diubah.');

            return redirect()->to(base_url('admin/data_dosen'));
        }
    }

    public function hapus_dosen($id)
    {
        $dosenModel = new DosenModel();
        // cari gambar berdasarkan id
        $dosen = $dosenModel->find($id);

        $dosenModel->delete($id);
        $getID = $dosen['nidn'];
        session()->setFlashdata('msg', "Data $getID  berhasil dihapus.");
        return redirect()->to('admin/data_dosen');
    }

    public function data_kuesioner()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $kuesionerModel = new PenilaianDosenModel();
        $data = [
            'title' => 'Data Kuesioner',
            'kuesioners' => $kuesionerModel->findAll()
        ];
        echo view('admin/data_kuesioner', $data);
    }

    public function hapus_kuesioner($id)
    {
        $kuesionerModel = new PenilaianDosenModel();
        // cari gambar berdasarkan id
        $kues = $kuesionerModel->find($id);

        $kuesionerModel->delete($id);
        $getID = $kues['id_kuesioner'];
        session()->setFlashdata('msg', "Data $getID  berhasil dihapus.");
        return redirect()->to('admin/data_kuesioner');
    }

    public function data_admin()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $session = session();
        $adminModel = new AdminModel();
        $data = [
            'title' => 'Data Admin',
            'admins' => $adminModel->findAll()
        ];
        echo view('admin/data_admin', $data);
    }

    public function tambah_admin()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules(['id_admin' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $adminModel = new AdminModel();
            $adminModel->save([
                "id_admin" => $this->request->getVar('id_admin'),
                "username" => $this->request->getVar('username'),
                "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                "level" => $this->request->getVar('level'),
            ]);

            return redirect()->to('admin/data_admin');
        }

        $data = [
            'title'  => "Tambah Admin",
        ];
        // tampilkan form create
        echo view('admin/tambah_admin', $data);
    }

    public function edit_admin($id)
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $adminModel = new AdminModel();
        $data = [
            'title' => 'Edit Admin',
            'admin' => $adminModel->where('id_admin', $id)->first()
        ];

        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules(['id_admin' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $adminModel = new AdminModel();
            $adminModel->save([
                "id_admin" => $this->request->getVar('id_admin'),
                "username" => $this->request->getVar('username'),
                "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                "level" => $this->request->getVar('level'),
            ]);
            return redirect()->to('admin/data_admin');
        }

        return view('admin/edit_admin', $data);
    }

    public function hapus_admin($id)
    {
        $adminModel = new AdminModel();
        // cari gambar berdasarkan id
        $admin = $adminModel->find($id);

        $adminModel->delete($id);
        $getID = $admin['id_admin'];
        session()->setFlashdata('msg', "Data $getID  berhasil dihapus.");
        return redirect()->to('admin/data_admin');
    }

    public function data_matkul()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $matkulModel = new MataKuliahModel();
        $data = [
            'title' => 'Data Matkul',
            'matkuls' => $matkulModel->findAll()
        ];
        echo view('admin/data_matkul', $data);
    }

    public function tambah_matkul()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules(['id_matkul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $matkulModel = new MataKuliahModel();
            $matkulModel->save([
                "kd_matkul" => $this->request->getVar('kd_matkul'),
                "nm_matkul" => $this->request->getVar('nm_matkul'),
                "id_angkatan" => $this->request->getVar('id_angkatan'),
                "semester" => $this->request->getVar('semester'),
                "id_dosen" => $this->request->getVar('id_dosen'),
            ]);

            return redirect()->to('admin/data_matkul');
        }
        $dosenModel = new DosenModel();
        $angkatanModel = new AngkatanModel();
        $data = [
            'title'  => "Tambah Mata Kuliah",
            'dosens' => $dosenModel->findAll(),
            'angkatans' => $angkatanModel->findAll(),
        ];
        // tampilkan form create
        echo view('admin/tambah_matkul', $data);
    }

    public function edit_matkul($id)
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'admin') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $matkulModel = new MataKuliahModel();
        $dosenModel = new DosenModel();
        $angkatanModel = new AngkatanModel();
        $data = [
            'title' => 'Edit Matkul',
            'matkul' => $matkulModel->where('kd_matkul', $id)->first(),
            'dosens' => $dosenModel->findAll(),
            'angkatans' => $angkatanModel->findAll(),
        ];

        // lakukan validasi
        $validation =  \Config\Services::validation();
        $validation->setRules(['id_matkul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        // jika data valid, simpan ke database
        if ($isDataValid) {
            $matkulModel = new MataKuliahModel();
            $matkulModel->save([
                "kd_matkul" => $this->request->getVar('kd_matkul'),
                "nm_matkul" => $this->request->getVar('nm_matkul'),
                "id_angkatan" => $this->request->getVar('id_angkatan'),
                "semester" => $this->request->getVar('semester'),
                "id_dosen" => $this->request->getVar('id_dosen'),
            ]);
            return redirect()->to('admin/data_matkul');
        }

        return view('admin/edit_matkul', $data);
    }

    public function hapus_matkul($id)
    {
        $matkulModel = new MataKuliahModel();
        // cari gambar berdasarkan id
        $matkul = $matkulModel->find($id);

        $matkulModel->delete($id);
        $getID = $matkul['kd_matkul'];
        session()->setFlashdata('msg', "Data $getID  berhasil dihapus.");
        return redirect()->to('admin/data_matkul');
    }

    public function profil_dosen()
    {
        $session = session();
        if ($session->get('logged_in_admin') !== TRUE && $session->get('level') !== 'dosen') {
            return redirect()->to(base_url('admin/index'));
        } else if ($session->get('logged_in_admin') == TRUE && $session->get('level') !== 'dosen') {
            return redirect()->to(base_url('admin/profil_dosen'));
        }
        $dosenModel = new DosenModel();
        $kuesionerModel = new PenilaianDosenModel();
        $nidn = $session->get('id_admin');
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
        }

        $angkatanModel = new AngkatanModel();
        $label = $angkatanModel->findColumn('tahun_ajar');

        $dataChart = [$this->getAvg($label[0], $nidn), $this->getAvg($label[1], $nidn), $this->getAvg($label[2], $nidn), $this->getAvg($label[3], $nidn), $this->getAvg($label[4], $nidn), $this->getAvg($label[5], $nidn), $this->getAvg($label[6], $nidn)];

        $data = [
            'title' => 'Profil Dosen',
            'dosens' => $dosenModel->where('nidn', $nidn)->first(),
            'kuesioners' =>  $kuesionerModel->where('id_dosen', $nidn)->find(),
            'rating' => round($totalRating, 2),
            'labelChart' => $label,
            'dataset' => $dataChart
        ];
        echo view('admin/profil_dosen', $data);
    }

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

    public function import_excel()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $nim = $row[0];
            $nama = $row[1];
            $tahunMasuk = $row[2];
            $username = $row[3];
            $password = $row[4];

            $db = \Config\Database::connect();

            $cekNim = $db->table('mahasiswa')->getWhere(['nim' => $nim])->getResult();

            if (count($cekNim) > 0) {
                session()->setFlashdata('msg', '<b style="color:red">Data Gagal di Import NIM ada yang sama</b>');
            } else {

                $simpandata = [
                    'nim' => $nim, 'nama' => $nama, 'tahun_masuk' => $tahunMasuk, 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT),
                ];

                $db->table('mahasiswa')->insert($simpandata);
                session()->setFlashdata('message', 'Berhasil import excel');
            }
        }

        return redirect()->to(base_url('admin/data_mahasiswa'));
    }
}
