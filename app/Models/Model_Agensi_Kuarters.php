<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Agensi_Kuarters extends Model
{
    protected $table = 'table_quarters_profile';

    // TAMBAH: Fungsi untuk kira jumlah data (untuk pagination)
    public function countAllFiltered($idAgensiInduk, $search = null)
    {
        $builder = $this->db->table('table_quarters_profile');
        $builder->where('id_agensi_induk', $idAgensiInduk);

        if ($search) {
            $builder->groupStart()
                    ->like('kod_kuarters', $search)
                    ->orLike('nama_kuarters', $search)
                    ->groupEnd();
        }

        return $builder->countAllResults();
    }

    // UBAH: Kemaskini fungsi untuk sokong search, limit dan offset
    public function getSenaraiKuarters($idAgensiInduk, $limit = null, $offset = null, $search = null)
    {
        $builder = $this->db->table('table_quarters_profile');
        $builder->select('
            table_quarters_profile.id_kuarters,
            table_quarters_profile.kod_kuarters,
            table_quarters_profile.nama_kuarters,
            table_quarters_profile.tahun_siap,
            table_quarters_profile.id_negeri,  
             table_quarters_profile.id_daerah,  
            adm_state.state_description,
            adm_district.district_name,
            GROUP_CONCAT(DISTINCT adm_quarters_category.kelas ORDER BY adm_quarters_category.kelas SEPARATOR ", ") AS senarai_kelas
        ');
        $builder->join('table_jenis_kuarters', 'table_quarters_profile.id_kuarters = table_jenis_kuarters.id_kuarters', 'left');
        $builder->join('adm_quarters_category', 'table_jenis_kuarters.id_kategori_kuarters = adm_quarters_category.id_kategori_kuarters', 'left');
        $builder->join('adm_state', 'table_quarters_profile.id_negeri = adm_state.id_adm_state', 'left');
        $builder->join('adm_district', 'table_quarters_profile.id_daerah = adm_district.id_adm_district', 'left');
        $builder->where('table_quarters_profile.id_agensi_induk', $idAgensiInduk);

        // --- Logik Carian ---
        if ($search) {
            $builder->groupStart()
                    ->like('table_quarters_profile.kod_kuarters', $search)
                    ->orLike('table_quarters_profile.nama_kuarters', $search)
                    ->orLike('adm_state.state_description', $search)
                    ->groupEnd();
        }

        $builder->groupBy([
            'table_quarters_profile.id_kuarters',
            'table_quarters_profile.kod_kuarters',
            'table_quarters_profile.nama_kuarters',
            'table_quarters_profile.tahun_siap',
            'table_quarters_profile.id_negeri', // Tambah ini
            'table_quarters_profile.id_daerah', // Tambah ini
            'adm_state.state_description',      // Tambah ini
            'adm_district.district_name'
        ]);

        // --- Logik Pagination ---
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }

        return $builder->get()->getResultArray();
    }

    public function getKuartersById($idKuarters, $idAgensiInduk)
    {
        return $this->db->table('table_quarters_profile')
            ->where('id_kuarters', $idKuarters)
            ->where('id_agensi_induk', $idAgensiInduk)
            ->get()
            ->getRowArray();
    }

// Dalam Model_Agensi_Kuarters.php -> function updateKuarters()
public function updateKuarters($idKuarters, $dataProfile, $classesIds)
{
    $db = \Config\Database::connect();
    $db->transStart();

    // 1. Update table_quarters_profile secara manual
    $builder = $db->table('table_quarters_profile');
    $builder->where('id_kuarters', $idKuarters);                
    
    // Pastikan id_daerah ada dalam $dataProfile
    $builder->set($dataProfile); 
    $builder->update();

    // 2. Update table_jenis_kuarters (Mapping Kelas)
    $db->table('table_jenis_kuarters')
       ->where('id_kuarters', $idKuarters)
       ->delete();

    if (!empty($classesIds)) {
        $insertBatch = [];
        foreach ($classesIds as $idKategori) {
            $insertBatch[] = [
                'id_kuarters' => $idKuarters,
                'id_kategori_kuarters' => $idKategori
            ];
        }
        $db->table('table_jenis_kuarters')->insertBatch($insertBatch);
    }

    $db->transComplete();

    // Debug akhir jika transaksi gagal
    if ($db->transStatus() === FALSE) {
        die(print_r($db->error(), true));
    }

    return $db->transStatus();
}


public function getLatestQuarterCode()
{
    // Mengambil kod terakhir, susun mengikut abjad terbalik (desc) dan ambil satu yang teratas
    return $this->db->table('table_quarters_profile')
                    ->select('kod_kuarters')
                    ->orderBy('kod_kuarters', 'DESC')
                    ->get()
                    ->getRowArray();
}

public function insertKuarters($dataProfile, $classesIds)
{
    $this->db->transStart();

    // 1. Insert ke jadual utama (table_quarters_profile)
    $this->db->table('table_quarters_profile')->insert($dataProfile);
    
    // Ambil ID kuarters yang baru sahaja di-insert
    $idKuartersBaru = $this->db->insertID();

    // 2. Insert ke jadual mapping kelas (table_jenis_kuarters)
    if (!empty($classesIds)) {
        foreach ($classesIds as $classId) {
            $this->db->table('table_jenis_kuarters')->insert([
                'id_kuarters'          => $idKuartersBaru, // Menggunakan id_kuarters
                'id_kategori_kuarters' => $classId          // Menggunakan id_kategori_kuarters
                // kolum id_jenis_kuarters akan auto-increment
            ]);
        }
    }

    $this->db->transComplete();

    return $this->db->transStatus();
}

}