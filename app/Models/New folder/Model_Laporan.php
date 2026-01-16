<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Laporan extends Model
{
    protected $table      = 'tbl_rayuan';
    protected $primaryKey = 'id_rayuan';
    protected $allowedFields = [
        'id_surat_masuk', 
        'no_ruj_kdn', 
        'jenis_pas', 
        'kategori_pemohon',
        
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }
    public function get_syor_penilai($id_surat_masuk)
    {
        $builder = $this->table('tbl_rayuan');
        $builder->select ('*');
        $builder->join('tbl_surat_masuk', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
        $builder->where('tbl_surat_masuk.id_surat_masuk',$id_surat_masuk);
        return $builder->get()->getResult();
    }

    public function add_rayuan($data)
    {
        $this->db->table('tbl_rayuan')->insert($data);
    }

    public function update_rayuan($data, $id_rayuan)
    {
        $this->db->table('tbl_rayuan')->update($data, array('id_rayuan' => $id_rayuan));
    }
    public function update_syor_penilai($data, $id_surat_masuk)
    {
        $this->db->table('tbl_rayuan')->update($data, array('id_surat_masuk' => $id_surat_masuk));
    }

    public function delete_surat($id_surat_masuk)
    {
        $this->db->table('tbl_surat_masuk')->delete(array('id_surat_masuk' => $id_surat_masuk));
    }

    // public function get_perakuan($max_id)
    // {
    //     $builder = $this->table('tbl_rayuan');
    //     $builder->select ('*');
    //     // $builder->join('tbl_surat_masuk', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
    //     $builder->where('id_rayuan',$max_id);
    //     return $builder->get()->getResult();
    // }

    function carian_surat_perakuan ($nama_pemohon=null,$no_ruj_jim=null,$rayuan_baru_ids=[])
    {

        $builder = $this->table('tbl_rayuan');
        $builder->select ('id_rayuan,tbl_surat_masuk.id_surat_masuk,no_ruj_kdn,jim_cantum,id_jenis_pas,
        id_kategori_pemohon,umur,kel_akademik,catatan_akademik,kem_bahasa,tem_menetap,cttn_tem_menetap,
        tem_kahwin,hub_keluarga1,hub_keluarga2,hub_keluarga3,hub_keluarga4,hub_keluarga5
        hub_keluarga6,hub_keluarga7,hub_keluarga8,hub_keluarga9,cttn_hub_keluarga,
        tem_pengalaman,cttn_tem_pengalaman,nilai_pelaburan1,nilai_pelaburan2,nilai_pelaburan3,
        nilai_pelaburan4,kepakaran1,kepakaran2,kepakaran3,kepakaran4,cttn_kepakaran1,cttn_kepakaran2,
        cttn_kepakaran3,cttn_kepakaran4,pembatalan,catatan_batal,id_add,nama_pemohon,status_rayuan,
        status_perakuan,no_fail_jim,no_kertas_perakuan,disemak_oleh');
        $builder->join('tbl_surat_masuk', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'right');
        $builder->where('status_rayuan','2');
        $builder->orWhere('status_rayuan','3');
        $builder->orderBy('id_surat_masuk desc');

        if($nama_pemohon){
            $builder->like('nama_pemohon',$nama_pemohon,'both'); //'%match%' 
        }
        if($no_ruj_jim){
            $builder->like('no_fail_jim',$no_fail_jim,'both'); //'%match%' 
        }
        if (!empty($rayuan_baru_ids)){

            $builder->whereIn('id_rayuan',$rayuan_baru_ids);
        }
        // $builder->orderBy('nama_pemohon', 'ASC');
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);
        

    }
    function carian_selesai_perakuan ($no_kertas_perakuan,$nama_pemohon)
    {

        $builder = $this->table('tbl_rayuan');
        $builder->select ('id_rayuan,umur,tbl_surat_masuk.id_surat_masuk,no_ruj_kdn,jim_cantum,id_jenis_pas,
        id_kategori_pemohon,umur,kel_akademik,catatan_akademik,kem_bahasa,tem_menetap,cttn_tem_menetap,
        tem_kahwin,hub_keluarga1,hub_keluarga2,hub_keluarga3,hub_keluarga4,hub_keluarga5
        hub_keluarga6,hub_keluarga7,hub_keluarga8,hub_keluarga9,cttn_hub_keluarga,
        tem_pengalaman,cttn_tem_pengalaman,nilai_pelaburan1,nilai_pelaburan2,nilai_pelaburan3,
        nilai_pelaburan4,kepakaran1,kepakaran2,kepakaran3,kepakaran4,cttn_kepakaran1,cttn_kepakaran2,
        cttn_kepakaran3,cttn_kepakaran4,pembatalan,catatan_batal,id_add,nama_pemohon,jantina,status_rayuan,
        status_perakuan,no_fail_jim,no_ruj_kdn,agama,warganegara,umur_real,tem_menetap_real,tem_kahwin_real,nama_penaja,
        no_kp_penaja,jumlah_markah,disemak_oleh,disahkan_oleh,ksu,yb_menteri,no_kertas_perakuan');
        $builder->join('tbl_surat_masuk', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'left');
     
        $builder->orderBy('id_surat_masuk desc');

        
        if ($no_kertas_perakuan == "" && $nama_pemohon == "") {
            $builder->like('nama_pemohon', '-', 'both');
        }

        if ($nama_pemohon !== null && $nama_pemohon !== "") {
            $builder->like('nama_pemohon', $nama_pemohon, 'both');
        }

        if ($no_kertas_perakuan !== null && $no_kertas_perakuan !== "") {
            $builder->like('no_kertas_perakuan', $no_kertas_perakuan, 'both');
        }

        if (!empty($no_kertas_perakuan) && !empty($nama_pemohon)) {
            $builder->like('no_kertas_perakuan', $no_kertas_perakuan, 'both');
            $builder->like('nama_pemohon', $nama_pemohon, 'both');
        }
     
		
    
        // $builder->orderBy('nama_pemohon', 'ASC');
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);
        

    }

    function carian_surat_rayuan ($nama_pemohon=null,$id_kategori_pemohon=null,$rayuan_baru_ids=[])
    {

        $builder = $this->table('tbl_rayuan');
        $builder->select ('id_rayuan,umur,tbl_surat_masuk.id_surat_masuk,no_ruj_kdn,jim_cantum,id_jenis_pas,
        id_kategori_pemohon,umur,kel_akademik,catatan_akademik,kem_bahasa,tem_menetap,cttn_tem_menetap,
        tem_kahwin,hub_keluarga1,hub_keluarga2,hub_keluarga3,hub_keluarga4,hub_keluarga5
        hub_keluarga6,hub_keluarga7,hub_keluarga8,hub_keluarga9,cttn_hub_keluarga,
        tem_pengalaman,cttn_tem_pengalaman,nilai_pelaburan1,nilai_pelaburan2,nilai_pelaburan3,
        nilai_pelaburan4,kepakaran1,kepakaran2,kepakaran3,kepakaran4,cttn_kepakaran1,cttn_kepakaran2,
        cttn_kepakaran3,cttn_kepakaran4,pembatalan,catatan_batal,id_add,nama_pemohon,jantina,status_rayuan,
        status_perakuan,no_fail_jim,no_ruj_kdn,agama,warganegara,umur_real,tem_menetap_real,tem_kahwin_real,nama_penaja,
        no_kp_penaja,jumlah_markah,disemak_oleh,disahkan_oleh,ksu,yb_menteri,no_kertas_perakuan');
        $builder->join('tbl_surat_masuk', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'right');
        $builder->where('status_rayuan','2');
        $builder->orWhere('status_rayuan','3');
        $builder->orderBy('id_surat_masuk desc');

        if($nama_pemohon){
            $builder->like('nama_pemohon',$nama_pemohon,'both'); //'%match%' 
        }
        if($id_kategori_pemohon){
            $builder->like('id_kategori_pemohon',$id_kategori_pemohon,'both'); //'%match%' 
        }
        if (!empty($rayuan_baru_ids)){

            $builder->whereIn('id_rayuan',$rayuan_baru_ids);
        }
        // $builder->orderBy('nama_pemohon', 'ASC');
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);
        

    }


    function carian_kiraan_mata ($nama_pemohon=null,$no_ruj_jim=null,$rayuan_baru_ids=[])
    {

        $builder = $this->table('tbl_rayuan');
        $builder->select ('id_rayuan,tbl_surat_masuk.id_surat_masuk,no_ruj_kdn,jim_cantum,id_jenis_pas,
        id_kategori_pemohon,umur,kel_akademik,catatan_akademik,kem_bahasa,tem_menetap,cttn_tem_menetap,
        tem_kahwin,hub_keluarga1,hub_keluarga2,hub_keluarga3,hub_keluarga4,hub_keluarga5
        hub_keluarga6,hub_keluarga7,hub_keluarga8,hub_keluarga9,cttn_hub_keluarga,
        tem_pengalaman,cttn_tem_pengalaman,nilai_pelaburan1,nilai_pelaburan2,nilai_pelaburan3,
        nilai_pelaburan4,kepakaran1,kepakaran2,kepakaran3,kepakaran4,cttn_kepakaran1,cttn_kepakaran2,
        cttn_kepakaran3,cttn_kepakaran4,pembatalan,catatan_batal,id_add,nama_pemohon,status_rayuan,
        status_perakuan,no_fail_jim');
        $builder->join('tbl_surat_masuk', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'right');
        $builder->orderBy('id_surat_masuk desc');

        if($nama_pemohon){
            $builder->like('nama_pemohon',$nama_pemohon,'both'); //'%match%' 
        }
        if($no_ruj_jim){
            $builder->like('no_fail_jim',$no_fail_jim,'both'); //'%match%' 
        }
        if (!empty($rayuan_baru_ids)){

            $builder->whereIn('id_rayuan',$rayuan_baru_ids);
        }
        // $builder->orderBy('nama_pemohon', 'ASC');
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
        //return $builder->paginate($page);
        

    }

    function carian_laporan ($nama_pemohon,$no_fail_jim)
    {

        $builder = $this->table('tbl_rayuan');
        $builder->select ('id_rayuan,tbl_surat_masuk.id_surat_masuk,no_ruj_kdn,jim_cantum,id_jenis_pas,
        id_kategori_pemohon,umur,kel_akademik,catatan_akademik,kem_bahasa,tem_menetap,cttn_tem_menetap,
        tem_kahwin,tem_kahwin_real,hub_keluarga1,hub_keluarga2,hub_keluarga3,hub_keluarga4,hub_keluarga5
        hub_keluarga6,hub_keluarga7,hub_keluarga8,hub_keluarga9,cttn_hub_keluarga,
        tem_pengalaman,cttn_tem_pengalaman,nilai_pelaburan1,nilai_pelaburan2,nilai_pelaburan3,
        nilai_pelaburan4,kepakaran1,kepakaran2,kepakaran3,kepakaran4,cttn_kepakaran1,cttn_kepakaran2,
        cttn_kepakaran3,cttn_kepakaran4,pembatalan,catatan_batal,id_add,nama_pemohon,status_rayuan,
        no_fail_jim');
        $builder->join('tbl_surat_masuk', 'tbl_rayuan.id_surat_masuk = tbl_surat_masuk.id_surat_masuk', 'right');
        //$builder->where('status_rayuan','1');
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


    

    
//penutup
}