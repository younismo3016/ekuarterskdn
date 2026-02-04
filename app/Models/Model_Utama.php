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



    public function get_laporan_agensi($bulan = 1, $tahun = 2026)
    {
        // Matikan ONLY_FULL_GROUP_BY jika server anda ketat, tetapi cuba baiki query dahulu
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        $sql = "SELECT
            table_main_agency.nama_agensi_induk AS nama_jabatan, 
            SUM(COALESCE(table_report.unit_dihuni, 0)) AS unit_dihuni, 
            SUM(COALESCE(table_report.unit_tidak_dihuni, 0)) AS unit_kosong, 
            SUM(COALESCE(table_report.unit_dihuni, 0) + COALESCE(table_report.unit_tidak_dihuni, 0)) AS jumlah_unit,
            CASE 
                WHEN MAX(table_report.status_hantar) = 2 THEN 'DITERIMA'
                WHEN MAX(table_report.status_hantar) IN (0, 1) THEN 'DRAF'
                ELSE 'BELUM MULA'
            END AS status_hantar 
        FROM
            table_main_agency
            INNER JOIN table_quarters_profile ON table_quarters_profile.id_agensi_induk = table_main_agency.id_agensi_induk
            LEFT JOIN table_report ON table_report.id_kuarters = table_quarters_profile.id_kuarters
            AND table_report.bulan = ? 
            AND table_report.tahun = ?
        GROUP BY 
            table_main_agency.nama_agensi_induk";

        $query = $this->db->query($sql, array($bulan, $tahun));
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
