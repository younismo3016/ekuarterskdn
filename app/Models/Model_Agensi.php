<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Agensi extends Model
{
    protected $table      = 'table_main_agency';
    protected $primaryKey = 'id_agensi_induk';
    protected $allowedFields = [
        'nama_agensi_induk',
        'id_agensi_induk', 
      
    ];

    public function get_all_data()
    {
        return $this->db->table('table_main_agency')->orderBy('id_agensi_induk', 'DESC')->get()->getResultArray();
    }
    public function getAgensiInduk()
    {
        return $this->findAll(); // atau ubah ikut keperluan
    }

    // Fetch sub agensi berdasarkan id agensi induk
    public function getSubAgensiByInduk($id_agensi)
    {
        return $this->db->table('table_sub_agency')
                        ->where('id_sub_agensi', $id_agensi)
                        ->get()
                        ->getResultArray();
    }
    public function get_rekod($id)
    {
        return $this->db->table('table_main_agency')
            ->where('id_agensi_induk', $id)
            ->get()
            ->getRowArray();
    }
    public function get_cr($id_user)
    {
        
        $builder=$this->select('*');
        $builder->where('id_cr', $id_user);
        return $builder->get()->getResultArray(); 
        //return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }

    
    function carian_nnn($perkara,$kotak,$lokasi,$bil_lampiran,$no_fail)
    {

        
        $builder = $this->db->table('rekod'); // Initialize the query builder for the tbl_user table
        $builder->orderBy('id', 'DESC');

        if($perkara){
            $builder->like('perkara',$perkara,'both'); //'%match%' 
        }
        if($kotak){
            $builder->like('kotak',$kotak,'both'); //'%match%' 
        }
        if($lokasi){
            $builder->like('lokasi',$lokasi,'both'); //'%match%' 
        } 
        if($bil_lampiran){
            $builder->like('bil_lampiran',$bil_lampiran,'both'); //'%match%' 
        }
        if($no_fail){
            $builder->like('no_fail',$no_fail,'both'); //'%match%' 
        }

        $builder->limit(500); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

    function carian_rekod($perkara,$kotak,$lokasi,$bil_lampiran,$no_fail)
{
     $builder = $this->db->table('rekod'); // Initialize the query builder for the tbl_user table
    $builder->orderBy('id', 'DESC');

    // Semak jika ada kriteria carian (sama ada nama ATAU email diisi)
    if ($perkara || $kotak || $lokasi || $bil_lampiran || $no_fail) {
        // --- BLOK INI HANYA JALAN JIKA ADA CARIAN ---
        
        if ($perkara) {
            $builder->like('perkara', $perkara, 'both'); //'%match%' 
        }
        if ($kotak) {
            $builder->like('kotak', $kotak, 'both'); //'%match%' 
        }
        if ($lokasi) {
            $builder->like('lokasi', $lokasi, 'both'); //'%match%' 
        }
        if ($bil_lampiran) {
            $builder->like('bil_lampiran', $bil_lampiran, 'both'); //'%match%' 
        }
        if ($no_fail) {
            $builder->like('no_fail', $no_fail, 'both'); //'%match%' 
        }

        // Hadkan kepada 1000 keputusan untuk carian
        $builder->limit(2000); 

    } else {
        // --- BLOK INI JALAN JIKA TIADA CARIAN (muat halaman biasa) ---
        
        // Papar 20 senarai yang terbaru sahaja
        $builder->limit(30);
    }

    // Jalankan query dan pulangkan hasil
    return $builder->get()->getResultArray();
}
    
    public function add_rekod($data)
    {
        $this->db->table('rekod')->insert($data);
    }

    public function update_rekod($data, $id)
    {
        $this->db->table('rekod')->update($data, array('id' => $id));
    }

    public function delete_rekod($id_user)
    {
        $this->db->table('rekod')->delete(array('id' => $id));
    }

}