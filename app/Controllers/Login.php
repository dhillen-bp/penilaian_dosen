<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new MahasiswaModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('nama');
        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'nim'       => $data['nim'],
                    'username'  => $data['username'],
                    'nama'      => $data['nama'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('mahasiswa'));
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to(base_url('login'));
            }
        } else {
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }
}
