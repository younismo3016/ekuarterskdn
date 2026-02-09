<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Seksyen extends Model
{
    protected $table      = 'tbl_seksyen';
    protected $primaryKey = 'id_seksyen';
    protected $allowedFields = [
        'nama_seksyen',
        'singakatan_seksyen',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_seksyen')->get()->getResultArray();
    }

    public function add_seksyen($data)
    {
        $this->db->table('tbl_seksyen')->insert($data);
    }

    public function update_seksyen($data, $id_seksyen)
    {
        $this->db->table('tbl_seksyen')->update($data, array('id_seksyen' => $id_seksyen));
    }

    public function delete_seksyen($id_seksyen)
    {
        $this->db->table('tbl_seksyen')->update($data, array('id_seksyen' => $id_seksyen));
    }

}