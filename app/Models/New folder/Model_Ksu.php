<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Ksu extends Model
{
    protected $table      = 'adm_ksu';
    protected $primaryKey = 'id_ksu';
    protected $allowedFields = [
        'name_ksu',
        'id_ksu',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('adm_ksu')->get()->getResultArray();
    }

    public function add_ksu($data)
    {
        $this->db->table('adm_ksu')->insert($data);
    }

    public function update_ksu($data, $id_ksu)
    {
        $this->db->table('adm_ksu')->update($data, array('id_ksu' => $id_ksu));
    }

    public function hapus_ksu($id_ksu)
    {
        $this->db->table('adm_ksu')->update($data, array('id_ksu' => $id_ksu));
    }

}