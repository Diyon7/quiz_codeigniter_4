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

        // $db = \Config\Database::connect();
        // $peserta = $db->query("SELECT * FROM t_anggota");
        // dd($peserta);
        // dd($anggota);

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

    public function edit()
    {
        helper(['form']);
        $id = htmlspecialchars($this->request->uri->getSegment(4));
        $soal = $this->SoalModel->find($id);
        $data = [
            'title' => 'Admin 💻🙂📱 Tambah Soal',
            'letak' => 'Edit Soal',
            'soal' => $soal,
            'validation' => \Config\Services::validation()
        ];
        if ($this->request->getMethod() == 'post') {
            if ($_FILES['image']['name'] == "") {
                $rules = [
                    'question'        => 'required',
                    'choice_1'        => 'required',
                    'choice_2'        => 'required',
                    'choice_3'        => 'required',
                    'choice_4'        => 'required',
                    'choice_5'        => 'required',
                    'answer'        => 'required'
                ];
            } else {
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
            }
            if ($this->validate($rules)) {
                if ($_FILES['image']['name'] == '') {
                    $params = [
                        'question'             => htmlspecialchars($this->request->getPost('question')),
                        'multiple_choice_1'            => htmlspecialchars($this->request->getPost('choice_1')),
                        'multiple_choice_2'            => htmlspecialchars($this->request->getPost('choice_2')),
                        'multiple_choice_3'            => htmlspecialchars($this->request->getPost('choice_3')),
                        'multiple_choice_4'            => htmlspecialchars($this->request->getPost('choice_4')),
                        'multiple_choice_5'            => htmlspecialchars($this->request->getPost('choice_5')),
                        'answer_key'            => htmlspecialchars($this->request->getPost('answer'))
                    ];
                } else {
                    $getsoal = $this->SoalModel->find($id);
                    if ($getsoal) {
                        $deletefile = unlink('./assets/image/' . $getsoal['image']);
                        if ($deletefile) {
                            $file = $this->request->getFile('image');
                            $uploadFile = $this->upload_image($file);
                        }
                    }
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
                }
                $update = $this->SoalModel->update($id, $params);
                if ($update) {
                    session()->setFlashdata('success', 'Data berhasil diupdate');
                    return redirect()->route('admin');
                } else {
                    session()->setFlashdata('danger', 'Data gagal diupdate');
                    return redirect()->route('admin/soal/edit')->withInput();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('Admin/dashboard/edit', $data);
    }

    public function delete()
    {
        $id = htmlspecialchars($this->request->uri->getSegment(4));
        $getsoal = $this->SoalModel->find($id);

        if ($getsoal) {
            $deletefile = unlink('./assets/image/' . $getsoal['image']);
            if ($deletefile) {
                $delete = $this->SoalModel->delete($id);
                if ($delete) {
                    session()->setFlashdata('success', 'Data berhasil dihapus');
                    return redirect()->route('admin');
                } else {
                    session()->setFlashdata('danger', 'Data gagal dihapus');
                    return redirect()->route('admin');
                }
            } else {
                session()->setFlashdata('danger', 'Data gagal dihapus');
                return redirect()->route('admin');
            }
        } else {
            session()->setFlashdata('danger', 'Data gagal dihapus');
            return redirect()->route('admin');
        }
    }

    private function upload_image($file)
    {
        $newName = $file->getRandomName();
        $upload = $file->move(ROOTPATH . 'public/assets/image', $newName);
        if ($upload) {
            return $newName;
        } else {
            return false;
        }
    }
}
