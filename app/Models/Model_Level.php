<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Level extends Model
{
    protected $table      = 'tbl_peranan';
    protected $primaryKey = 'id_peranan';
    protected $allowedFields = [
        'peranan',
        'id_peranan',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_peranan')->get()->getResultArray();
    }

    public function add_level($data)
    {
        $this->db->table('tbl_peranan')->insert($data);
    }

    public function update_level($data, $id_peranan)
    {
        $this->db->table('tbl_peranan')->update($data, array('id_peranan' => $id_peranan));
    }

    public function hapus_level($id_ksu)
    {
        $this->db->table('tbl_peranan')->update($data, array('id_peranan' => $id_peranan));
    }

}