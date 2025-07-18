<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['election_id', 'candidate_id', 'user_id', 'voted_at'];
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'election_id' => 'required|numeric',
        'candidate_id' => 'required|numeric',
        'user_id' => 'required|numeric'
    ];
}
