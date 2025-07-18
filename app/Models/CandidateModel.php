<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table = 'candidates';
    protected $primaryKey = 'id';
    protected $allowedFields = ['election_id', 'name', 'photo', 'position'];
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'election_id' => 'required|numeric',
        'name' => 'required|max_length[100]',
        'photo' => 'permit_empty|max_length[255]',
        'position' => 'permit_empty|max_length[100]'
    ];

    /**
     * Get candidates by election ID
     */
    public function getByElection($electionId)
    {
        return $this->where('election_id', $electionId)->findAll();
    }

    /**
     * Count candidates in an election
     */
    public function countByElection($electionId)
    {
        return $this->where('election_id', $electionId)->countAllResults();
    }
}
