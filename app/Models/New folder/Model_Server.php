<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Server extends Model
{
    protected $table      = 'tbl_server';
    protected $primaryKey = 'id_server';
    protected $allowedFields = [
        'name_server', 
        'ip_server', 
        'type_server', 
        'ope_system',
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_server')->get()->getResultArray();
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