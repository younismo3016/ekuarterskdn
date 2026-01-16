<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Perakuan extends Model
{
    protected $table      = 'tbl_perakuan';
    protected $primaryKey = 'id_perakuan';
    protected $allowedFields = [
        'senarai_id_rayuan', 
     
    ];

    function get_kategori_surat($id_bahagian){

        $builder=$this->table('adm_kategori_surat');
        $builder->where('id_kategori_surat', $id_kategori_surat);
        return $builder->get()->getRow();   
    }

    // public function senarai_jenis_pas()
    // {
    //     return $this->db->table('adm_jenis_pas')->get()->getResultArray();
    // }

    // public function kategori_pemohon()
    // {
    //     return $this->db->table('adm_kategori_pemohon')->get()->getResultArray();
    // }

    public function add_perakuan($data)
    {
        $this->db->table('tbl_perakuan')->insert($data);
    }

    // public function update_user($data, $id_user)
    // {
    //     $this->db->table('tbl_user')->update($data, array('id_user' => $id_user));
    // }

    // public function delete_user($id_user)
    // {
    //     $this->db->table('tbl_user')->delete(array('id_user' => $id_user));
    // }

}