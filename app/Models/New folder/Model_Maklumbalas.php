<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Maklumbalas extends Model
{
    protected $table      = 'tbl_surat_masuk';
    protected $primaryKey = 'id_surat_masuk';
    protected $allowedFields = [
        'perkara', 
        'diterima_drpd', 
        'nama_pemohon', 
        'perkara_rayuan',
        'no_fail_jim',
        'warganegara',
        'status',
        'minit_kpsu',
        'minit_psu',
        'kategori_surat',
        'catatan',
        'tarikh_surat_akuan',
        'tarikh_terima_unitE',
        'tarikh_surat',
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }

    public function add_maklumbalas($data)
    {
        $this->db->table('tbl_surat_masuk')->insert($data);
    }

    public function update_maklumbalas($data, $id_rayuan)
    {
        $this->db->table('tbl_rayuan')->update($data, array('id_rayuan' => $id_rayuan));
    }

    public function delete_surat($id_surat_masuk)
    {
        $this->db->table('tbl_surat_masuk')->delete(array('id_surat_masuk' => $id_surat_masuk));
    }
    public function surat($id_surat_masuk)
    {
        $builder = $this->table('tbl_surat_masuk'); 
        $builder = $this->where('id_surat_masuk',$id_surat_masuk);
        return $builder->get()->getResult();
    }
  

    function carian_dalam_tindakan($nama_pemohon,$no_fail_jim)
    {

        $builder = $this->table('tbl_surat_masuk'); 
        $builder->select ('nama_pemohon,
        id_rayuan,tbl_surat_masuk.id_surat_masuk,id_add,kategori_surat,no_fail_jim,
        tarikh_dlm_tindakan,cat_pas,keputusan,status_rayuan');
        $builder->join('tbl_rayuan', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
        $builder = $this->where('kategori_surat',2); 
        $builder->orderBy('id_surat_masuk desc');

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
    function carian_tidak_lengkap($nama_pemohon,$no_fail_jim)
    {

        $builder = $this->table('tbl_surat_masuk'); 
        $builder->select ('nama_pemohon,
        id_rayuan,tbl_surat_masuk.id_surat_masuk,id_add,kategori_surat,no_fail_jim,tarikh_tidaklengkap,status_rayuan');
        $builder->join('tbl_rayuan', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
        $builder = $this->where('kategori_surat',3); 
        $builder->orderBy('id_surat_masuk desc');

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
    function carian_sabah($nama_pemohon,$no_fail_jim)
    {

        $builder = $this->table('tbl_surat_masuk'); 
        $builder->select ('nama_pemohon,
        id_rayuan,tbl_surat_masuk.id_surat_masuk,id_add,kategori_surat,no_fail_jim,tarikh_sabah,status_rayuan');
        $builder->join('tbl_rayuan', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
        $builder = $this->where('kategori_surat',4); 
        $builder->orderBy('id_surat_masuk desc');

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

    function carian_jana_surat($nama_pemohon,$no_fail_jim)
    {

        $builder = $this->table('tbl_surat_masuk'); 
        $builder->select ('nama_pemohon, id_rayuan, tbl_surat_masuk.id_surat_masuk, 
        id_add, kategori_surat, no_fail_jim, tarikh_dlm_tindakan, status_rayuan, status_surat, keputusan, cat_pas');
        $builder->join('tbl_rayuan', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
        $builder->orderBy('id_surat_masuk desc');

        if ($no_fail_jim == "" && $nama_pemohon == "") {
            $builder->like('nama_pemohon', '-', 'both');
        }

        if ($nama_pemohon !== null && $nama_pemohon !== "") {
            $builder->like('nama_pemohon', $nama_pemohon, 'both');
        }

        if ($no_fail_jim !== null && $no_fail_jim !== "") {
            $builder->like('no_fail_jim', $no_fail_jim, 'both');
        }

        if (!empty($no_fail_jim) && !empty($nama_pemohon)) {
            $builder->like('no_fail_jim', $no_fail_jim, 'both');
            $builder->like('nama_pemohon', $nama_pemohon, 'both');
        }
        // $builder->orderBy('nama_pemohon', 'ASC');
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);

    }

}