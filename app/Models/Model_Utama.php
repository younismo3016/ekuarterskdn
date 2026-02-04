<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Utama extends Model
{
    protected $table      = 'table_report';
    protected $primaryKey = 'id_report';
    protected $allowedFields = [
        'id_kuarters',
        'bulan',
        'tahun',
        'jumlah_permohonan',
        'unit_dihuni',
    ];


    public function get_last_update_date()
{
    // Ambil tarikh paling maksimum (terkini)
    $query = $this->db->query("SELECT MAX(tarikh_kemaskini) as last_date FROM table_report");
    $result = $query->getRow();
    
    return $result->last_date; // Akan return string datetime atau NULL
}



    public function get_laporan_agensi()
{
    // Dapatkan bulan dan tahun semasa secara dinamik
    $bulan_semak = date('n'); // Bulan 1-12
    $tahun_semak = date('Y'); // Tahun cth: 2026

    $sql = "
        SELECT 
            ma.nama_agensi_induk AS nama_jabatan,
            
            -- --- BAHAGIAN 1: DATA TERKINI (Latest Snapshot) ---
            -- Mengambil data dari laporan terakhir yang pernah dihantar (status 2)
            SUM(COALESCE(latest.unit_dihuni, 0)) AS unit_dihuni,
            
            -- Kiraan Kosong (Baik) Terkini
            SUM(
                COALESCE(latest.baik_diduduki, 0) + 
                COALESCE(latest.baik_guna_sama, 0) + 
                COALESCE(latest.baik_tukar_fungsi, 0) + 
                COALESCE(latest.baik_sewaan, 0)
            ) AS unit_kosong_baik,
            
            -- Kiraan Kosong (Rosak) Terkini
            SUM(
                COALESCE(latest.rosak_baik_pulih, 0) + 
                COALESCE(latest.rosak_guna_sama, 0) + 
                COALESCE(latest.rosak_tukar_fungsi, 0) + 
                COALESCE(latest.rosak_sewaan, 0) + 
                COALESCE(latest.rosak_roboh, 0)
            ) AS unit_kosong_rosak,

            -- Jumlah Keseluruhan Terkini
            SUM(COALESCE(latest.total_unit_kuarters, 0)) AS jumlah_unit,
            
            -- --- BAHAGIAN 2: STATUS PENGHANTARAN (Bulan Semasa Sahaja) ---
            -- Jika 'current_month' join berjaya (ada rekod), kira > 0 = DITERIMA
            CASE 
                WHEN COUNT(current_month.id_report) > 0 THEN 'DITERIMA'
                ELSE 'BELUM MULA' 
            END AS status_hantar

        FROM table_main_agency ma
        JOIN table_quarters_profile q ON ma.id_agensi_induk = q.id_agensi_induk

        -- JOIN A: Logic untuk dapatkan data TERKINI (Latest) tanpa mengira bulan
        LEFT JOIN (
            SELECT r.*
            FROM table_report r
            JOIN (
                SELECT id_kuarters, MAX(CONCAT(tahun, LPAD(bulan, 2, '0'))) as max_period
                FROM table_report
                WHERE status_hantar = 2
                GROUP BY id_kuarters
            ) m ON r.id_kuarters = m.id_kuarters 
            AND CONCAT(r.tahun, LPAD(r.bulan, 2, '0')) = m.max_period
            WHERE r.status_hantar = 2
        ) latest ON q.id_kuarters = latest.id_kuarters

        -- JOIN B: Logic untuk semak status BULAN INI sahaja
        LEFT JOIN table_report current_month ON q.id_kuarters = current_month.id_kuarters 
            AND current_month.bulan = ? 
            AND current_month.tahun = ? 
            AND current_month.status_hantar = 2

        GROUP BY ma.id_agensi_induk, ma.nama_agensi_induk
        ORDER BY ma.nama_agensi_induk ASC
    ";

    // Jalankan query dengan parameter binding
    $query = $this->db->query($sql, [$bulan_semak, $tahun_semak]);
    
    return $query->getResultArray();
}

    public function get_dashboard()
    {        

        $sql = "
            SELECT 
                -- 1. Jumlah Keseluruhan
                SUM(r.total_unit_kuarters) AS total_kuarters,
                
                -- 2. Jumlah Huni
                SUM(r.unit_dihuni) AS total_huni,
                
                -- 3. Jumlah Kosong (Baik)
                SUM(
                    COALESCE(r.baik_diduduki, 0) + 
                    COALESCE(r.baik_guna_sama, 0) + 
                    COALESCE(r.baik_tukar_fungsi, 0) + 
                    COALESCE(r.baik_sewaan, 0)
                ) AS total_kosong_baik,
                
                -- 4. Jumlah Kosong (Rosak)
                SUM(
                    COALESCE(r.rosak_baik_pulih, 0) + 
                    COALESCE(r.rosak_guna_sama, 0) + 
                    COALESCE(r.rosak_tukar_fungsi, 0) + 
                    COALESCE(r.rosak_sewaan, 0) + 
                    COALESCE(r.rosak_roboh, 0)
                ) AS total_kosong_rosak

            FROM table_report r
            JOIN (
                -- Subquery: Cari tahun & bulan PALING TERKINI
                SELECT 
                    id_kuarters, 
                    MAX(CONCAT(tahun, LPAD(bulan, 2, '0'))) as latest_period
                FROM table_report
                WHERE status_hantar = 2
                GROUP BY id_kuarters
            ) latest ON r.id_kuarters = latest.id_kuarters 
              AND CONCAT(r.tahun, LPAD(r.bulan, 2, '0')) = latest.latest_period
            WHERE r.status_hantar = 2
        ";

        $query = $this->db->query($sql);
        return $query->getResultArray();
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
