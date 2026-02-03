<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_State extends Model
{
    protected $table      = 'adm_state';
    protected $primaryKey = 'id_adm_state';
    protected $allowedFields = [
        'state_description', 
       
    ];

    public function get_all_data()
    {
        return $this->db->table('adm_state')->get()->getResultArray();
    }

    public function add_user($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    public function update_user($data, $id_user)
    {
        $this->db->table('tbl_user')->update($data, array('id_user' => $id_user));
    }

    public function delete_user($id_user)
    {
        $this->db->table('tbl_user')->delete(array('id_user' => $id_user));
    }

}