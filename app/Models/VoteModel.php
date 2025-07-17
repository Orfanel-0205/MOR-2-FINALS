<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['election_id', 'candidate_id', 'user_id'];
    protected $useTimestamps = true;
}
