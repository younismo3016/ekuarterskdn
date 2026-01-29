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



    public function list_kuarters($nama_kuarters, $kod_kuarters)
{
    $builder = $this->db->table('table_quarters_profile');

    // 1. Pilih kolum dan gunakan GROUP_CONCAT untuk menggabungkan kategori
    $builder->select('
        table_quarters_profile.*, 
        GROUP_CONCAT(adm_quarters_category.keterangan_kategori_kuarters SEPARATOR ", ") as senarai_kelas
    ');

    // 2. Tambah JOIN pertama (ke table perantaraan)
    $builder->join('table_jenis_kuarters', 'table_jenis_kuarters.id_kuarters = table_quarters_profile.id_kuarters', 'left');

    // 3. Tambah JOIN kedua (ke table kategori)
    $builder->join('adm_quarters_category', 'adm_quarters_category.id_kategori_kuarters = table_jenis_kuarters.id_kategori_kuarters', 'left');

    // 4. GROUP BY sangat penting apabila menggunakan GROUP_CONCAT
    $builder->groupBy('table_quarters_profile.id_kuarters');

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

        $builder->limit(1000);
    } else {
        // Papar 50 senarai yang terbaru sahaja
        $builder->limit(1000);
    }

    // Jalankan query dan pulangkan hasil
    return $builder->get()->getResultArray();
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
