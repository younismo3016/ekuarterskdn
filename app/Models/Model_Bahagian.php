<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Bahagian extends Model
{
    protected $table      = 'tbl_bahagian';
    protected $primaryKey = 'id_bahagian';
    protected $allowedFields = [
        'nama_bahagian',
        'singakatan_bahagian',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_bahagian')->get()->getResultArray();
    }

    public function add_bahagian($data)
    {
        $this->db->table('tbl_bahagian')->insert($data);
    }

    public function update_bahagian($data, $id_bahagian)
    {
        $this->db->table('tbl_bahagian')->update($data, array('id_bahagian' => $id_bahagian));
    }

    public function delete_bahagian($id_bahagian)
    {
        $this->db->table('tbl_bahagian')->update($data, array('id_bahagian' => $id_bahagian));
    }

    public function get_bahagian($id_bahagian)
{
    return $this->select('nama_bahagian')
                ->where('id_bahagian', $id_bahagian)
                ->first(); // Ganti get()->getResultArray() dengan first()
}

}