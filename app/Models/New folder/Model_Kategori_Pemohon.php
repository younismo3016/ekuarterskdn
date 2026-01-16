<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Kategori_Pemohon extends Model
{
    protected $table      = 'adm_kategori_pemohon';
    protected $primaryKey = 'id_kategori_pemohon';
    protected $allowedFields = [
        'kategori_pemohon', 
     
    ];

    function get_kategori_surat($id_bahagian){

        $builder=$this->table('adm_kategori_surat');
        $builder->where('id_kategori_surat', $id_kategori_surat);
        return $builder->get()->getRow();   
    }

    public function get_all_data()
    {
        return $this->db->table('adm_kategori_surat')->get()->getResultArray();
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