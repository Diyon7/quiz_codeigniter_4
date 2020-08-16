<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\SoalModel;
use Config\Services;

class Detail extends BaseController
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
}
