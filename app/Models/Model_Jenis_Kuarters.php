<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Jenis_Kuarters extends Model
{
    protected $table      = 'table_jenis_kuarters';
    protected $primaryKey = 'id_jenis_kuarters';
    protected $allowedFields = [
        'id_kuarters', 
        'id_kategori_kuarters', 
       
    ];

    public function get_all_data()
    {
        return $this->db->table('table_jenis_kuarters')->orderBy('id_jenis_kuarters', 'DESC')->get()->getResultArray();
    }
    public function get_jenis_kuarters($id_kuarters)
    {
        return $this->db->table('table_jenis_kuarters')
            ->where('id_kuarters', $id_kuarters)
            ->get()
            ->getResultArray();
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