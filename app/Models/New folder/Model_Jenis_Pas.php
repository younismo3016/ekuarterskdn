<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Jenis_Pas extends Model
{
    protected $table      = 'adm_jenis_pas';
    protected $primaryKey = 'id_jenis_pas';
    protected $allowedFields = [
        'id_jenis_pas', 
     
    ];

    function get_kategori_surat($id_bahagian){

        $builder=$this->table('adm_kategori_surat');
        $builder->where('id_kategori_surat', $id_kategori_surat);
        return $builder->get()->getRow();   
    }

    public function senarai_jenis_pas()
    {
        return $this->db->table('adm_jenis_pas')->get()->getResultArray();
    }

    public function kategori_pemohon()
    {
        return $this->db->table('adm_kategori_pemohon')->get()->getResultArray();
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