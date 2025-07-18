<?php

namespace App\Models;

use CodeIgniter\Model;

class ElectionModel extends Model
{
    protected $table = 'elections';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'start_date', 'end_date', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    
    protected $validationRules = [
        'title' => 'required|max_length[100]',
        'description' => 'permit_empty',
        'start_date' => 'required|valid_date',
        'end_date' => 'required|valid_date',
        'status' => 'required|in_list[open,closed]'
    ];

    /**
     * Get all open elections
     */
    public function getOpenElections()
    {
        return $this->where('status', 'open')
                   ->where('start_date <=', date('Y-m-d H:i:s'))
                   ->where('end_date >=', date('Y-m-d H:i:s'))
                   ->findAll();
    }

    /**
     * Check if an election is currently active
     */
    public function isElectionActive($electionId)
    {
        $election = $this->find($electionId);
        if (!$election) return false;
        
        $now = date('Y-m-d H:i:s');
        return ($election['status'] === 'open' && 
                $election['start_date'] <= $now && 
                $election['end_date'] >= $now);
    }
}
