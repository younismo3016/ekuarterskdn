<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Pengesah extends Model
{
    protected $table      = 'adm_pengesah';
    protected $primaryKey = 'id_pengesah';
    protected $allowedFields = [
        'name_pengesah',
        'id_pengesah',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('adm_pengesah')->get()->getResultArray();
    }

    public function add_pengesah($data)
    {
        $this->db->table('adm_pengesah')->insert($data);
    }

    public function update_pengesah($data, $id_pengesah)
    {
        $this->db->table('adm_pengesah')->update($data, array('id_pengesah' => $id_pengesah));
    }

    public function delete_pengesah($id_pengesah)
    {
        $this->db->table('adm_pengesah')->update($data, array('id_pengesah' => $id_pengesah));
    }

}