<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class SoalModel extends Model
{
    protected $table        = 'quiz_csos';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['question', 'image', 'multiple_choice_1', 'multiple_choice_2', 'multiple_choice_3', 'multiple_choice_4', 'multiple_choice_5', 'answer_key'];
    protected $useTimestamps = true;

    // datatables config
    // protected $column_order = array('email', 'token');
    // protected $column_search = array('email', 'token');
    // protected $order = array('create_at' => 'desc');
    // protected $request;

    // function __construct($RequestInterface $request = null)
    // {
    //     parent:: __construct();
    //     $this->request = $request;
    // }

    // public function _get_datatables_query()
    // {
    //     $i = 0;
    //     foreach ($this->column_search as $item) {
    //         if ($this->request->getPost('search')['value']) {
    //             if ($i === 0) {
    //                 $this->groupStart();
    //                 $this->like($item, $this->request->getPost('search')['value']);
    //             } else {
    //                 $this->orLike($item, $this->request->getPost('search')['value']);
    //             }
    //             if (count($this->column_search) - 1 == $i)
    //                 $this->groupEnd();
    //         }
    //         $i++;
    //     }

    //     if ($this->request->getPost('order')) {
    //         $this->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
    //     } else if (isset($this->order)) {
    //         $order = $this->order;
    //         $this->orderBy(key($order), $order[key($order)]);
    //     }
    // }

    // public function get_datatables()
    // {
    //     $this->_get_datatables_query();
    //     if ($this->request->getPost('length') != -1)
    //         $this->limit($this->request->getPost('length'), $this->request->getPost('start'));
    //     $query = $this->get();
    //     return $query->getResult();
    // }

    // public function count_filtered()
    // {
    //     $this->_get_datatables_query();
    //     return $this->countAllResults();
    // }

    // public function count_all()
    // {
    //     $tbl_storage = $this->db->table($this->table);
    //     return $tbl_storage->countAllResults();
    // }
}
