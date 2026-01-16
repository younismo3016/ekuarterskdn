<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Penyemak extends Model
{
    protected $table      = 'adm_penyemak';
    protected $primaryKey = 'id_penyemak';
    protected $allowedFields = [
        'name_penyemak',
        'id_penyemak',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('adm_penyemak')->get()->getResultArray();
    }

    public function add_penyemak($data)
    {
        $this->db->table('adm_penyemak')->insert($data);
    }

    public function update_penyemak($data, $id_penyemak)
    {
        $this->db->table('adm_penyemak')->update($data, array('id_penyemak' => $id_penyemak));
    }

    public function delete_penyemak($id_penyemak)
    {
        $this->db->table('adm_penyemak')->update($data, array('id_penyemak' => $id_penyemak));
    }

}