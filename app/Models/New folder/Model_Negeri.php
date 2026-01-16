<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Negeri extends Model
{
    protected $table      = 'adm_negeri';
    protected $primaryKey = 'id_negeri';
    protected $allowedFields = [
        'name_negeri', 
       
    ];

    public function get_all_data()
    {
        return $this->db->table('adm_negeri')->get()->getResultArray();
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