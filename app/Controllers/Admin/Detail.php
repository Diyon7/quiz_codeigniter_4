<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\SoalModel;
use Config\Services;

class Dashboard extends BaseController
{
    protected $SoalModel;

    public function __construct()
    {
        $this->SoalModel = new SoalModel();
    }

    public function index()
    {
        helper('security');
        $soal = $this->SoalModel->findAll();
        $data = [
            'title' => 'Admin 💻🙂📱 Dashboard',
            'letak' => 'Dashboard',
            'soal' => $soal,
        ];

        return view('admin/dashboard/index', $data);
    }

    public function add()
    {
        helper(['form']);

        $data = [
            'title' => 'Admin 💻🙂📱 Tambah Soal',
            'letak' => 'Tambah Soal',
            'validation' => \Config\Services::validation()
        ];
        if ($this->request->getMethod() == 'post') {


            $rules = [
                'question'        => 'required',
                'choice_1'        => 'required',
                'choice_2'        => 'required',
                'choice_3'        => 'required',
                'choice_4'        => 'required',
                'choice_5'        => 'required',
                'image'    => [
                    'uploaded[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png]',
                    'max_size[image,2096]'
                ],
                'answer'        => 'required'
            ];

            if ($this->validate($rules)) {

                // upload file
                $file = $this->request->getFile('image');

                $uploadFile = $this->upload_image($file);

                if ($uploadFile != false) {
                    $params = [
                        'question'             => htmlspecialchars($this->request->getPost('question')),
                        'image'        => $uploadFile,
                        'multiple_choice_1'            => htmlspecialchars($this->request->getPost('choice_1')),
                        'multiple_choice_2'            => htmlspecialchars($this->request->getPost('choice_2')),
                        'multiple_choice_3'            => htmlspecialchars($this->request->getPost('choice_3')),
                        'multiple_choice_4'            => htmlspecialchars($this->request->getPost('choice_4')),
                        'multiple_choice_5'            => htmlspecialchars($this->request->getPost('choice_5')),
                        'answer_key'            => htmlspecialchars($this->request->getPost('answer'))
                    ];

                    $insert = $this->SoalModel->insert($params);

                    if ($insert) {
                        session()->setFlashdata('success', 'Berhasil menambah data');
                        return redirect()->route('admin');
                    } else {
                        session()->setFlashdata('danger', 'Gagal menambah data');
                        return redirect()->route('admin/kandidat/add')->withInput();
                    }
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('Admin/dashboard/add', $data);
    }
}
