<?php

namespace App\Models;

use CodeIgniter\Model;

class SubAgensiModel extends Model
{
    protected $table = 'table_sub_agency';
    protected $primaryKey = 'id_sub_agensi';
    protected $allowedFields = ['id_agensi_induk', 'nama_sub_agensi'];
}