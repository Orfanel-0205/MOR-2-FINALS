<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table      = 'candidates';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'election_id'];
}
