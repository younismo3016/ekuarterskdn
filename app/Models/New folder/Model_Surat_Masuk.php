<?php

namespace App\Models;

use CodeIgniter\Model;
 
class Model_Surat_Masuk extends Model
{
    protected $table      = 'tbl_surat_masuk';
    protected $primaryKey = 'id_surat_masuk';
    protected $allowedFields = [
        'perkara', 
        'diterima_drpd', 
        'nama_pemohon', 
        'jantina', 
        'agama', 
        'perkara_rayuan',
        'no_ruj_jim',
        'warganegara',
        'status',
        'minit_kpsu',
        'minit_psu',
        'catatan',
        'tarikh_surat_akuan',
        'tarikh_terima_unitE',
        'tarikh_surat',
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }
    public function get_daftar_surat($id_surat_masuk)
    {
        $builder=$this->select('*');
        $builder->where('id_surat_masuk', $id_surat_masuk);
        return $builder->get()->getResultArray(); 
        //return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }

    

    public function get_all_data_negeri()
    {
        return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }

    public function add_surat($data)
    {
        $this->db->table('tbl_surat_masuk')->insert($data);
    }

    public function update_surat($data, $id_surat_masuk)
    {
        $this->db->table('tbl_surat_masuk')->update($data, array('id_surat_masuk' => $id_surat_masuk));
    }
	

    public function delete_user($id_surat_masuk)
    {
        $this->db->table('tbl_surat_masuk')->delete(array('id_surat_masuk' => $id_surat_masuk));
    }

    public function check_surat_rayuan($id_surat_masuk)
    {
        return  $this->db->table('tbl_rayuan')->where([

            'id_surat_masuk'=>$id_surat_masuk,

        ])->get()->getRowArray();
    }

    public function check_surat_masuk($no_fail_jim)
    {
        return  $this->db->table('tbl_surat_masuk')->where([

            'no_fail_jim'=>$no_fail_jim,

        ])->get()->getRowArray();
    }

    function carian_surat_masuk($nama_pemohon,$no_fail_jim)
    {

        $builder = $this->table('tbl_surat_masuk');
        $builder->select ('tbl_surat_masuk.id_surat_masuk,DATE(tbl_surat_masuk.cipta_pada)
        ,no_fail_jim,nama_pemohon,cat_pas,status_rayuan,keputusan,status_surat');
        $builder->join('tbl_rayuan', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
        $builder->limit(50);
        $builder->orderBy('tbl_surat_masuk.id_surat_masuk desc');

        if($nama_pemohon){
            $builder->like('nama_pemohon',$nama_pemohon,'both'); //'%match%' 
        }
        if($no_fail_jim){
            $builder->like('no_fail_jim',$no_fail_jim,'both'); //'%match%' 
        }
        // $builder->orderBy('nama_pemohon', 'ASC');
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);

    }

    function carian_surat_rayuan($nama_pemohon,$no_ruj_jim)
    {

        $builder = $this->table('tbl_surat_masuk');
        $builder->select ('nama_pemohon,
        id_rayuan,tbl_surat_masuk.id_surat_masuk,id_add,tbl_surat_masuk.cipta_pada,no_fail_jim');
        $builder->join('tbl_rayuan', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
        $builder->limit(100);
        $builder->orderBy('id_surat_masuk desc');

        if($nama_pemohon){
            $builder->like('nama_pemohon',$nama_pemohon,'both'); //'%match%' 
        }
        if($no_ruj_jim){
            $builder->like('no_fail_jim',$no_fail_jim,'both'); //'%match%' 
        }
        // $builder->orderBy('nama_pemohon', 'ASC');
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);

    }


}