<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminAuth extends BaseController
{

    public function index()
    {
        helper(['form', 'url']);
        $AdminModel = new AdminModel();

        $data = [
            'title' => 'Admin :) Login',
            'email' => [
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'Email',
                'class' => 'form-control',
                'autocomplete' => 'off'
            ],
            'password' => [
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Password',
                'class' => 'form-control'
            ]
        ];

        if ($this->request->getMethod() == 'post') {
            // rules validation
            $rules = [
                // 'email' => 'required|valid_email',
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => 'masukkan input email dengan benar'
                    ]
                ],
                'password' => 'required|min_length[3]'
            ];

            if ($this->validate($rules)) {
                $email = htmlspecialchars($this->request->getPost('email'));
                $password = htmlspecialchars($this->request->getPost('password'));

                // Ambil Data dari DB
                $user = $AdminModel->where('email', $AdminModel->escapeString($email))->first();

                if ($user) {
                    if (md5($password, $user['password'])) {
                        $userSession = [
                            'emaila' => $user['email'],
                        ];

                        session()->set($userSession);

                        return redirect('admin');
                    } else {
                        session()->setFlashdata('danger', 'Email atau Password salah');

                        return redirect('admin/login')->withInput();
                    }
                } else {
                    session()->setFlashdata('danger', 'Maaf Email dan Password yang kamu masukkan tidak terdaftar');

                    return redirect('admin/login')->withInput();
                }
            } else {
                // $validation = \Config\Services::validation();
                // $data['validation'] = $validation;
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/auth/index', $data);
    }
    public function logout()
    {
        session()->destroy();

        return redirect()->route('admin/login');
    }
}
