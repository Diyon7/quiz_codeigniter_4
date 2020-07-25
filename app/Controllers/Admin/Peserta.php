<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use Config\Services;

class Peserta extends BaseController
{
    protected $PesertaModel;

    public function __construct()
    {
        $this->PesertaModel = new PesertaModel();
    }

    public function index()
    {
        helper('security');
        $hasil = $this->PesertaModel->get_peserta();
        $nilai = $this->PesertaModel->nilaipeserta();
        // var_dump($nilai);
        $data = [
            'title' => 'Admin 💻🙂📱 Dashboard',
            'letak' => 'Dashboard',
            'hasil' => $hasil,
            'nilai' => $nilai,
        ];

        return view('admin/hasil/index', $data);
    }
}
