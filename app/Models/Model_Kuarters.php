<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Kuarters extends Model
{
    protected $table      = 'table_quarters_profile';
    protected $primaryKey = 'id_kuarters';
    protected $allowedFields = [
        'id_agensi_induk',
        'nama_kuarters',
        'jenis_kuarters',
        'tahun_siap',
      
    ];

    public function get_all_data()
    {
        return $this->db->table('table_quarters_profile')->orderBy('id_kuarters', 'DESC')->get()->getResultArray();
    }



    function carian_kuarters($nama_kuarters, $kod_kuarters)
{
    $builder = $this->db->table('table_quarters_profile');

        $builder->select('table_quarters_profile.*, table_jenis_kuarters.nama_jenis');

        $builder->join(
            'table_jenis_kuarters',
            'table_jenis_kuarters.id_jenis_kuarters = table_quarters_profile.id_jenis_kuarters',
            'left'
        );

        $builder->orderBy('table_quarters_profile.id_kuarters', 'DESC');

    // Semak jika ada kriteria carian (sama ada nama ATAU email diisi)
    if ($nama_kuarters || $kod_kuarters) {
        // --- BLOK INI HANYA JALAN JIKA ADA CARIAN ---
        
        if ($nama_kuarters) {
            $builder->like('nama_kuarters', $nama_kuarters, 'both'); //'%match%' 
        }
        if ($kod_kuarters) {
            $builder->like('kod_kuarters', $kod_kuarters, 'both'); //'%match%' 
        }

        // Hadkan kepada 1000 keputusan untuk carian
        $builder->limit(100); 

    } else {
        // --- BLOK INI JALAN JIKA TIADA CARIAN (muat halaman biasa) ---
        
        // Papar 20 senarai yang terbaru sahaja
        $builder->limit(50);
    }

    // Jalankan query dan pulangkan hasil
    return $builder->get()->getResultArray();
}
   
}
