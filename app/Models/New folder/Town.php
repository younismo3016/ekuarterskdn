<?php

namespace App\Models;

use CodeIgniter\Model;

class Town extends Model
{
	protected $table = 'towns';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'state_id', 'created_at', 'updated_at'];
}
