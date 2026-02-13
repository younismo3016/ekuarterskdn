<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Kuarters extends Model
{
    protected $table      = 'table_quarters_profile';
    protected $primaryKey = 'id_kuarters';
    protected $allowedFields = [
        'id_agensi_induk',
        'kod_kuarters',
        'nama_kuarters',
        'jenis_kuarters',
        'tahun_siap',

    ];

    public function get_all_data()
    {
        return $this->db->table('table_quarters_profile')->orderBy('id_kuarters', 'DESC')->get()->getResultArray();
    }
    public function update_kuarters($data, $id_kuarters)
    {
        $this->db->table('table_quarters_profile')->update($data, array('id_kuarters' => $id_kuarters));
    }

    public function list_kuarters($nama_kuarters = null, $kod_kuarters = null, $id_negeri = null)
{
    // 1. Guna $this (Model) supaya boleh sambung dengan paginate() nanti
    // Kita set table secara spesifik jika perlu, atau guna default model table
    $this->table('table_quarters_profile'); 

    // 2. Pilih kolum (Sama macam kod asal anda)
    $this->select('
        table_quarters_profile.*, 
        GROUP_CONCAT(adm_quarters_category.kelas SEPARATOR ", ") as senarai_kelas
    ');

    // 3. Join (Sama macam asal)
    $this->join('table_jenis_kuarters', 'table_jenis_kuarters.id_kuarters = table_quarters_profile.id_kuarters', 'left');
    $this->join('adm_quarters_category', 'adm_quarters_category.id_kategori_kuarters = table_jenis_kuarters.id_kategori_kuarters', 'left');

    // 4. Group By & Order (Sama macam asal)
    $this->groupBy('table_quarters_profile.id_kuarters');
    $this->orderBy('table_quarters_profile.id_kuarters', 'DESC');

    // 5. Logik Carian
    if ($nama_kuarters) {
        $this->like('table_quarters_profile.nama_kuarters', $nama_kuarters, 'both');
    }
    if ($kod_kuarters) {
        $this->like('table_quarters_profile.kod_kuarters', $kod_kuarters, 'both');
    }
    if ($id_negeri) {
        $this->where('table_quarters_profile.id_negeri', $id_negeri);
    }

    // PENTING:
    // 1. Kita BUANG $builder->limit(100) -> Sebab pagination akan uruskan limit.
    // 2. Kita BUANG return $builder->get() -> Kita tak nak data lagi.
    
    // Kita tak perlu return apa-apa, sebab query dah disimpan dalam memory Model ($this)
}

    function kuarters($nama_kuarters, $kod_kuarters)
    {
        $builder = $this->db->table('table_quarters_profile');

        // 1. Tambah JOIN pertama
        $builder->join('table_jenis_kuarters', 'table_jenis_kuarters.id_kuarters = table_quarters_profile.id_kuarters');

        // 2. Tambah JOIN kedua (yang menyambung dari table_jenis_kuarters)
        $builder->join('adm_quarters_category', 'adm_quarters_category.id_kategori_kuarters = table_jenis_kuarters.id_kategori_kuarters');

        // Susun yang terbaru
        $builder->orderBy('table_quarters_profile.id_kuarters', 'DESC');

        // Logik carian
        if ($nama_kuarters || $kod_kuarters) {
            if ($nama_kuarters) {
                $builder->like('table_quarters_profile.nama_kuarters', $nama_kuarters, 'both');
            }
            if ($kod_kuarters) {
                $builder->like('table_quarters_profile.kod_kuarters', $kod_kuarters, 'both');
            }

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
