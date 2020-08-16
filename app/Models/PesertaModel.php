<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class PesertaModel extends Model
{
    protected $table        = 'teams';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['name', 'school_name', 'email', 'answer_cso_teams.team_id, answer_cso_teams.quiz_cso_id, (answer_cso_teams.answer_key) as cso, (quiz_csos.answer_key) as csos'];
    protected $useTimestamps = true;

    protected $primary = array('id');

    public function get_peserta()
    {
        // return $this->select('teams.id, teams.name, teams.school_name, teams.email')
        //     ->distinct()
        //     ->join('answer_cso_teams', 'answer_cso_teams.team_id = teams.id', 'inner')
        //     ->get()->getResultArray();

        return $this->select('teams.id, teams.name, teams.school_name, teams.email, answer_cso_teams.team_id, answer_cso_teams.quiz_cso_id, (answer_cso_teams.answer_key) as cso, (quiz_csos.answer_key) as csos')
            ->distinct()
            ->join('answer_cso_teams', 'answer_cso_teams.team_id = teams.id', 'inner')
            ->join('quiz_csos', 'quiz_csos.id = answer_cso_teams.quiz_cso_id and answer_cso_teams.team_id = teams.id ')
            ->groupby('teams.id')
            ->get()->getResultArray();
    }

    public function nilaipesertab()
    {
        foreach ($this->get_peserta() as $gpa) :
            $id_peserta = $gpa['id'];
            $table = $this->db->table('answer_cso_teams');
            $query = $table->select('answer_cso_teams.team_id, answer_cso_teams.quiz_cso_id, (answer_cso_teams.answer_key) as cso, (quiz_csos.answer_key) as csos');
            $table->join('quiz_csos', 'quiz_csos.id = answer_cso_teams.quiz_cso_id and answer_cso_teams.team_id = ' . $id_peserta . '');
            $query2 = $query->get();
            return $query2->getResultArray();
        // foreach ($query3 as $q3) :
        //     dd($q3['team_id']);
        //     return $q3;
        // endforeach;
        endforeach;
    }

    public function nilaipesertas()
    {
    }

    // public function nilaipesertab()
    // {
    //     $get_p = $this->get_peserta();
    //     foreach ($this->get_peserta() as $gpa) :
    //         $id_peserta = $gpa['id'];
    //     endforeach;
    //     foreach ($this->get_peserta() as $gpa) :
    //         $table = $this->db->table('answer_cso_teams');
    //         $query = $table->select('answer_cso_teams.team_id, answer_cso_teams.quiz_cso_id, (answer_cso_teams.answer_key) as cso, (quiz_csos.answer_key) as csos');
    //         $table->join('quiz_csos', 'quiz_csos.id = answer_cso_teams.quiz_cso_id and answer_cso_teams.team_id = ' . $id_peserta . '');
    //         $query2 = $query->get();
    //         return $query2->getResultArray();
    //     endforeach;

    //     return $this->db->table('answer_cso_teams')
    //         ->selectCount('answer_cso_teams.team_id')
    //         ->join('teams', 'teams.id=answer_cso_teams.team_id')
    //         ->join('quiz_csos', 'quiz_csos.id=answer_cso_teams.quiz_cso_id AND answer_cso_teams.team_id=teams.id AND answer_cso_teams.answer_key=quiz_csos.answer_key')
    //         ->orderBy('answer_cso_teams.quiz_cso_id', 'ASC')
    //         ->get()
    //         ->getResultArray();
    // }
    // public function nilaipesertas()
    // {

    //     return $this->db->table('answer_cso_teams')
    //         ->select('answer_cso_teams.team_id')
    //         ->join('teams', 'teams.id=answer_cso_teams.team_id')
    //         ->join('quiz_csos', 'quiz_csos.id=answer_cso_teams.quiz_cso_id AND answer_cso_teams.team_id=teams.id AND answer_cso_teams.answer_key!=quiz_csos.answer_key')
    //         ->orderBy('answer_cso_teams.quiz_cso_id', 'ASC')
    //         ->get()
    //         ->getResultArray();
    //     SELECT COUNT(*) FROM answer_cso_teams JOIN quiz_csos ON quiz_csos.id=answer_cso_teams.quiz_cso_id AND answer_cso_teams.team_id='$data_id' AND answer_cso_teams.answer_key=quiz_csos.answer_key ORDER BY answer_cso_teams.quiz_cso_id
    // }
}
