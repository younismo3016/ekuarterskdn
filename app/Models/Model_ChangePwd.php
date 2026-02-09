<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_ChangePwd extends Model
{
    protected $table = 'tbl_user'; // Tukar kepada nama table user anda
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['password'];

    public function getUser($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }

    public function updatePassword($id_user, $data)
    {
        return $this->db->table($this->table)
            ->where('id_user', $id_user)
            ->update($data);
    }
}