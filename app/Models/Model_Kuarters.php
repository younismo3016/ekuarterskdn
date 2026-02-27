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

    public function list_kuarters($nama_kuarters = null, $kod_kuarters = null, $id_negeri = null, $id_agensi_induk = null)
{
    $this->table('table_quarters_profile'); 

    $this->select('
        table_quarters_profile.*, 
        GROUP_CONCAT(DISTINCT adm_quarters_category.kelas SEPARATOR ", ") as senarai_kelas,
        GROUP_CONCAT(DISTINCT adm_quarters_category.id_kategori_kuarters) as selected_ids
    '); // <--- PENTING: Tambah selected_ids di sini

    $this->join('table_jenis_kuarters', 'table_jenis_kuarters.id_kuarters = table_quarters_profile.id_kuarters', 'left');
    $this->join('adm_quarters_category', 'adm_quarters_category.id_kategori_kuarters = table_jenis_kuarters.id_kategori_kuarters', 'left');

    $this->groupBy('table_quarters_profile.id_kuarters');
    $this->orderBy('table_quarters_profile.id_kuarters', 'DESC');

    if ($nama_kuarters) {
        $this->like('table_quarters_profile.nama_kuarters', $nama_kuarters, 'both');
    }
    if ($kod_kuarters) {
        $this->like('table_quarters_profile.kod_kuarters', $kod_kuarters, 'both');
    }
    if ($id_negeri) {
        $this->where('table_quarters_profile.id_negeri', $id_negeri);
    }
    if ($id_agensi_induk) {
        $this->where('table_quarters_profile.id_agensi_induk', $id_agensi_induk);
    }
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


public function get_kuarters_with_kelas()
{
    return $this->select('table_kuarters.*, 
                 GROUP_CONCAT(DISTINCT table_jenis_kuarters.id_kategori_kuarters) as selected_ids')
                ->join('table_jenis_kuarters', 'table_jenis_kuarters.id_kuarters = table_kuarters.id_kuarters', 'left')
                ->groupBy('table_kuarters.id_kuarters');
}

// Fail: app/Models/Model_Kuarters.php

public function get_senarai_kelas() 
{
    // Kita gunakan REPLACE terus dalam SQL query
    return $this->db->table('adm_quarters_category')
                    ->select('id_kategori_kuarters, REPLACE(kelas, "KELAS ", "") as kelas, keterangan_kategori_kuarters')
                    ->get()
                    ->getResultArray(); 
}

}
