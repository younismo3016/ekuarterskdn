<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Menteri extends Model
{
    protected $table      = 'adm_menteri';
    protected $primaryKey = 'id_menteri';
    protected $allowedFields = [
        'name_menteri',
        'id_menteri',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('adm_menteri')->get()->getResultArray();
    }

    public function add_menteri($data)
    {
        $this->db->table('adm_menteri')->insert($data);
    }

    public function update_menteri($data, $id_menteri) 
    {
        $this->db->table('adm_menteri')->update($data, array('id_menteri' => $id_menteri));
    }

    public function delete_menteri($id_menteri)
    {
        $this->db->table('adm_menteri')->update($data, array('id_menteri' => $id_menteri));
    }

}