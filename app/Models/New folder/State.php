<?php

namespace App\Models;

use CodeIgniter\Model;

class State extends Model
{
	protected $table = 'states';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'created_at', 'updated_at'];
}
