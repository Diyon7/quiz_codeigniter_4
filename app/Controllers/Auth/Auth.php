<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\TeamModel;

class Auth extends BaseController
{

    public function index()
    {
        helper(['form', 'url']);
        $teamModel = new TeamModel();

        $data = ['title' => 'Login'];

        if ($this->request->getMethod() == 'post') {
            // rules validation
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[3]'
            ];

            if ($this->validate($rules)) {
                $email = htmlspecialchars($this->request->getPost('email'));
                $password = htmlspecialchars($this->request->getPost('password'));
            }

            // Ambil Data dari DB
            $user = $teamModel->where('email', $teamModel->escapeString($email))->first();

            var_dump($user);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $userSession = [
                        'nama' => $user['nama'],
                        'email' => $user['email'],
                    ];

                    session()->set($userSession);
                } else {
                    session()->setFlashdata('danger', 'Email atau Password salah');

                    return redirect('login')->withInput();
                }
            } else {
                session()->setFlashdata('danger', 'Maaf Email dan Password yang kamu masukkan tidak terdaftar');

                return redirect('login')->withInput();
            }
        } else {
            $data['validation'] = $this->validator;
        }

        return view('auth/index', $data);
    }
    public function logout()
    {
        session()->destroy();

        return redirect()->route('login');
    }
}
