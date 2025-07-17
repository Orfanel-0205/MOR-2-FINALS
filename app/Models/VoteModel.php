<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'election_id', 'candidate_id'];
    public $timestamps = false;
}