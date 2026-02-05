<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Utama extends Model
{
    protected $table      = 'table_report';
    //protected $table_report = 'table_report';
    protected $table_qp = 'table_quarters_profile';
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

public function getStatistikByAll()
{
    

    $sql = "
        SELECT
            tr.bulan,
            CASE 
                WHEN tr.bulan = 1 THEN 'JANUARI'
                WHEN tr.bulan = 2 THEN 'FEBRUARI'
                WHEN tr.bulan = 3 THEN 'MAC'
                WHEN tr.bulan = 4 THEN 'APRIL'
                WHEN tr.bulan = 5 THEN 'MEI'
                WHEN tr.bulan = 6 THEN 'JUN'
                WHEN tr.bulan = 7 THEN 'JULAI'
                WHEN tr.bulan = 8 THEN 'OGOS'
                WHEN tr.bulan = 9 THEN 'SEPTEMBER'
                WHEN tr.bulan = 10 THEN 'OKTOBER'
                WHEN tr.bulan = 11 THEN 'NOVEMBER'
                WHEN tr.bulan = 12 THEN 'DISEMBER'
                ELSE 'TIADA DATA'
            END AS nama_bulan,
            tr.tahun,
            -- Gunakan MAX untuk pastikan nilai '2' menang berbanding '0/1'
            MAX(tr.status_hantar) AS status_hantar,
            CASE 
                WHEN MAX(tr.status_hantar) = 2 THEN 'SELESAI'
                ELSE 'BELUM HANTAR'
            END AS status_teks,
            COUNT(tqp.id_kuarters) AS total_reports, 
            SUM(IFNULL(tr.unit_dihuni, 0)) AS total_unit_dihuni, 
            SUM(IFNULL(tr.unit_tidak_dihuni, 0)) AS total_unit_tidak_dihuni
        FROM
            table_quarters_profile tqp
        INNER JOIN 
            table_report tr ON tqp.id_kuarters = tr.id_kuarters
        
        GROUP BY
            tr.tahun, 
            tr.bulan
        ORDER BY 
            tr.tahun ASC, 
            tr.bulan ASC;
    ";

    return $this->db->query($sql)->getResultArray();
}

public function getDetailedReportView($bulan, $tahun, $limit = null, $offset = 0, $search = null)
{
    $builder = $this->db->table("{$this->table} tr")
        ->select("
            tr.*, 
            tqp.kod_kuarters, 
            tqp.nama_kuarters, 
            
            GROUP_CONCAT(DISTINCT aic.keterangan_kategori ORDER BY aic.keterangan_kategori ASC SEPARATOR ', ') as nama_kategori_isu,
            CONCAT('KELAS ', GROUP_CONCAT(DISTINCT REPLACE(aqc.keterangan_kategori_kuarters, 'KELAS ', '') ORDER BY aqc.keterangan_kategori_kuarters ASC SEPARATOR ', ')) as nama_kategori_kuarters
        ")
        ->join("{$this->table_qp} as tqp", "tqp.id_kuarters = tr.id_kuarters")
        ->join("table_issue ti", "ti.id_report = tr.id_report", "left")
        ->join("adm_issue_category aic", "aic.id_kategori_isu = ti.id_kategori_isu", "left")
        ->join("table_jenis_kuarters tjk", "tjk.id_kuarters = tqp.id_kuarters", "left")
        ->join("adm_quarters_category aqc", "aqc.id_kategori_kuarters = tjk.id_kategori_kuarters", "left")
        // ->where('tqp.id_agensi_induk', $id_agensi) 
        ->where("tr.bulan", $bulan)
        ->where("tr.tahun", $tahun);

    // Filter Carian
    if ($search) {
        $builder->groupStart()
                ->like('tqp.kod_kuarters', $search)
                ->orLike('tqp.nama_kuarters', $search)
                ->groupEnd();
    }

    $builder->groupBy("tr.id_report")
            ->orderBy("tqp.nama_kuarters", "ASC");

    if ($limit !== null) {
        return $builder->get($limit, $offset)->getResultArray();
    }

    return $builder->get()->getResultArray();
}

// Fungsi tambahan untuk kira total rekod (untuk pagination)
public function countDetailedReport($bulan, $tahun, $search = null)
{
    $builder = $this->db->table("{$this->table} tr")
        ->join("{$this->table_qp} as tqp", "tqp.id_kuarters = tr.id_kuarters")
        //->where('tqp.id_agensi_induk', $id_agensi) 
        ->where("tr.bulan", $bulan)
        ->where("tr.tahun", $tahun);

    if ($search) {
        $builder->groupStart()
                ->like('tqp.kod_kuarters', $search)
                ->orLike('tqp.nama_kuarters', $search)
                ->groupEnd();
    }

    return $builder->countAllResults();
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

    public function getStatistikByAgensiExcel( $bulan, $tahun)
    {
        return $this->db->table($this->table . ' as tr')
            ->select("
                tr.*, 
                tqp.kod_kuarters, 
                tqp.nama_kuarters, 
                GROUP_CONCAT(DISTINCT aic.keterangan_kategori ORDER BY aic.keterangan_kategori ASC SEPARATOR ', ') as nama_kategori_isu,
                CONCAT('KELAS ', GROUP_CONCAT(DISTINCT REPLACE(aqc.keterangan_kategori_kuarters, 'KELAS ', '') ORDER BY aqc.keterangan_kategori_kuarters ASC SEPARATOR ', ')) as nama_kategori_kuarters
            ")
            ->join("table_quarters_profile as tqp", "tqp.id_kuarters = tr.id_kuarters")
            ->join("table_issue ti", "ti.id_report = tr.id_report", "left")
            ->join("adm_issue_category aic", "aic.id_kategori_isu = ti.id_kategori_isu", "left")
            ->join("table_jenis_kuarters tjk", "tjk.id_kuarters = tqp.id_kuarters", "left")
            ->join("adm_quarters_category aqc", "aqc.id_kategori_kuarters = tjk.id_kategori_kuarters", "left")
            //->where('tqp.id_agensi_induk', $id_agensi) 
            ->where("tr.bulan", $bulan)
            ->where("tr.tahun", $tahun)
            ->groupBy("tr.id_report") // Penting kerana ada GROUP_CONCAT
            ->get()
            ->getResultArray();
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
