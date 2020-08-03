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
        $nilaib =
            $this->PesertaModel->nilaipesertab();
        // $nilais = $this->PesertaModel->nilaipesertas();
        // dd($nilaib);
        $data = [
            'title' => 'Admin 💻🙂📱 Dashboard',
            'letak' => 'Dashboard',
            'hasil' => $hasil,
            'nilaib' => $nilaib,
            // 'nilais' => $nilais,
        ];

        return view('admin/hasil/index', $data);
    }
}
