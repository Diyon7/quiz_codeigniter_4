<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\T_anggotaModel;
use App\Models\T_devisiModel;

class Peserta extends BaseController
{
    protected $anggotaModel;
    protected $devisiModel;

    public function __construct()
    {
        // $this->anggotaModel = new T_anggotaModel();
    }

    public function home()
    {
        $anggota = $this->anggotaModel->findAll();
        $devisi = $this->devisiModel->findAll();
        $data = [
            'title' => 'Admin | Result',
            'letak' => 'peserta',
            'navbar' => 'Anggota ISCOM',
            'anggota' => $anggota,
            'devisi' => $devisi
        ];

        // $db = \Config\Database::connect();
        // $peserta = $db->query("SELECT * FROM t_anggota");
        // dd($peserta);
        // dd($anggota);

        return view('admin/peserta/peserta', $data);
    }
}
