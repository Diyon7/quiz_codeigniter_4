<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class PesertaModel extends Model
{
    protected $table        = 'teams';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['name', 'school_name', 'email'];
    protected $useTimestamps = true;

    protected $primary = array('id');

    public function get_peserta()
    {
        return $this->select('teams.id, teams.name, teams.school_name, teams.email')
            ->distinct()
            ->join('answer_cso_teams', 'answer_cso_teams.team_id = teams.id', 'inner')
            ->get()->getResultArray();
    }

    public function nilaipeserta()
    {
        $get_p = $this->get_peserta();
        // dd($get_p);
        // foreach ($this->get_peserta() as $gpa) :
        $id_peserta = $get_p['id'];
        $table = $this->db->table('answer_cso_teams');
        $query = $table->select('answer_cso_teams.team_id, answer_cso_teams.quiz_cso_id, (answer_cso_teams.answer_key) as cso, (quiz_csos.answer_key) as csos');
        $table->join('quiz_csos', 'quiz_csos.id = answer_cso_teams.quiz_cso_id and answer_cso_teams.team_id = ' . $id_peserta . '');
        $query2 = $query->get();
        return $query2->getResult();
        // endforeach;
    }
}
