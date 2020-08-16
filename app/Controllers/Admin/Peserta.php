<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\DetailPModel;
use Config\Services;

class Peserta extends BaseController
{
    protected $PesertaModel;

    public function __construct()
    {
        $this->PesertaModel = new PesertaModel();
        $this->DetailPModel = new DetailPModel();
    }

    public function index()
    {
        helper('security');
        $hasil = $this->PesertaModel->get_peserta();
        $nilaib = $this->PesertaModel->nilaipesertab();
        foreach ($nilaib as $nib) {
            $nib2 = $nib;
        }
        // $nilais = $this->PesertaModel->nilaipesertas();
        // dd($nilaib);
        $data = [
            'title' => 'Admin 💻🙂📱 Dashboard',
            'letak' => 'Dashboard',
            'hasil' => $hasil,
            'nilaib' => $nib2,
            // 'nilais' => $nilais,
        ];

        return view('admin/hasil/index', $data);
    }

    public function detail()
    {
        $id = htmlspecialchars($this->request->uri->getSegment(4));
        $team = $this->DetailPModel->teams($id);
        $anggota = $this->DetailPModel->anggota($id);
        $skorbenar = $this->DetailPModel->skorbenar($id);
        $skorsalah = $this->DetailPModel->skorsalah($id);
        $tid = $this->DetailPModel->tidakdijawab($id);
        foreach ($tid as $ti) {
        }
        $quiz = $this->DetailPModel->quiz();

        $data = [
            'title' => 'Admin 💻🙂📱 Peserta',
            'letak' => 'Detail Peserta',
            'team' => $team,
            'anggota' => $anggota,
            'benar' => $skorbenar,
            'salah' => $skorsalah,
            'tidakdijawab' => $ti,
            'quiz' => $quiz
        ];

        return view('admin/hasil/detail', $data);
    }
}
