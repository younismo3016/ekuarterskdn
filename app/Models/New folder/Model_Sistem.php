<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Sistem extends Model
{
    protected $table      = 'tbl_nama_sistem';
    protected $primaryKey = 'id_nama_sistem';
    protected $allowedFields = [
        'nama_sistem', 
        'sinkatan_sistem', 
        'id_seksyen', 
        'id_bahagian',
       
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_nama_sistem')->orderBy('id_nama_sistem', 'DESC')->get()->getResultArray();
    }
    public function get_email_pegawai($id_nama_sistem)
    {
        return $this->db
            ->table('tbl_nama_sistem ns')
            ->join('tbl_user u', 'u.id_seksyen = ns.id_seksyen')
            ->select('u.email')
            ->where('ns.id_nama_sistem', $id_nama_sistem)
            ->where('u.level', 3) // ambil hanya level 3
            ->get()
            ->getResultArray();
    }
    function carian_sistem($nama_sistem)
    {

        
        $builder = $this->db->table('tbl_nama_sistem'); // Initialize the query builder for the tbl_user table
        $builder->orderBy('id_nama_sistem', 'DESC');
        $builder->limit(15); // hadkan kepada 15 keputusan

        if($nama_sistem){
            $builder->like('nama_sistem',$nama_sistem,'both'); //'%match%' 
        }
        
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);

    }


    public function add_sistem($data)
    {
        $this->db->table('tbl_nama_sistem')->insert($data);
    }

    public function update_sistem($data, $id_nama_sistem)
    {
        $this->db->table('tbl_nama_sistem')->update($data, array('id_nama_sistem' => $id_nama_sistem));
    }

    public function delete_sistem($id_nama_sistem)
    {
        $this->db->table('tbl_nama_sistem')->delete(array('id_nama_sistem' => $id_nama_sistem));
    }

}