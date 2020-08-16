<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class DetailPModel extends Model
{
    protected $table        = 'answer_cso_teams';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['quiz_cso_id', 'team_id', 'answer_key', 'token'];
    protected $useTimestamps = false;

    public function teams($id)
    {
        return $this->db->table('teams')
            ->where('id', $id)
            ->get()
            ->getResultArray();
    }

    public function anggota($id)
    {
        return $this->db->table('members')
            ->where('team_id', $id)
            ->get()
            ->getResultArray();
    }

    public function skorbenar($id)
    {
        return $this->selectCount('answer_cso_teams.id')
            ->join('quiz_csos', 'quiz_csos.id=answer_cso_teams.quiz_cso_id AND answer_cso_teams.team_id=' . $id . ' AND answer_cso_teams.answer_key=quiz_csos.answer_key')
            ->orderBy('answer_cso_teams.quiz_cso_id')
            ->get()
            ->getResultArray();
    }

    public function skorsalah($id)
    {
        return $this->selectCount('answer_cso_teams.id')
            ->join('quiz_csos', 'quiz_csos.id=answer_cso_teams.quiz_cso_id AND answer_cso_teams.team_id=' . $id . ' AND answer_cso_teams.answer_key!=quiz_csos.answer_key')
            ->orderBy('answer_cso_teams.quiz_cso_id')
            ->get()
            ->getResultArray();
    }

    public function tidakdijawab($id)
    {
        return $this->selectCount('answer_cso_teams.id')
            ->join('quiz_csos', 'quiz_csos.id=answer_cso_teams.quiz_cso_id AND answer_cso_teams.team_id=' . $id . '')
            ->orderBy('answer_cso_teams.quiz_cso_id')
            ->get()
            ->getResultArray();
    }

    public function quiz()
    {
        return $this->db->table('quiz_csos')
            ->selectCount('id')
            ->get()
            ->getResultArray();
    }
}
