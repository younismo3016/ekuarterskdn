<?php

namespace App\Models;

use CodeIgniter\Model;

class StatistikAgensiModel extends Model
{
    protected $table = 'table_quarters_profile';
    protected $table_report = 'table_report';
    protected $primaryKey = 'id_report';

  public function getStatistikByAgensi()
{
    $id_agensi = session()->get('id_agensi_induk');

    // Jika session kosong, kita akan tahu segera
    if (!$id_agensi) {
        log_message('error', 'Session id_agensi kosong!');
        return []; 
    }

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
            tr.status_hantar, 
            CASE 
                WHEN tr.status_hantar = 1 THEN 'SELESAI'
                ELSE 'BELUM HANTAR'
            END AS status_teks,
            COUNT(tqp.id_kuarters) AS total_reports, 
            SUM(IFNULL(tr.unit_dihuni, 0)) AS total_unit_dihuni, 
            SUM(IFNULL(tr.unit_tidak_dihuni, 0)) AS total_unit_tidak_dihuni
        FROM
            table_quarters_profile tqp
        INNER JOIN 
            table_report tr ON tqp.id_kuarters = tr.id_kuarters
        WHERE
            tqp.id_agensi_induk = ?
        GROUP BY
            tr.tahun, 
            tr.bulan,
            tr.status_hantar
        ORDER BY 
            tr.tahun ASC, 
            tr.bulan ASC
    ";

    $result = $this->db->query($sql, [$id_agensi])->getResultArray();
    
    // Debug: Lihat query terakhir yang dijalankan
    // echo $this->db->getLastQuery(); 
    
    return $result;
}


public function getDetailedReport($bulan, $tahun, $id_agensi)
{
    return $this->db->table('table_report tr')
        ->select('tr.*, tqp.kod_kuarters, tqp.nama_kuarters, tqp.jenis_kuarters') // Pastikan ada tqp.jenis_kuarters
        ->join('table_quarters_profile tqp', 'tqp.id_kuarters = tr.id_kuarters')
        ->where('tqp.id_agensi_induk', $id_agensi)
        ->where('tr.bulan', $bulan)
        ->where('tr.tahun', $tahun)
        ->get()
        ->getResultArray();
}
public function getDetailedReportView($bulan, $tahun, $id_agensi)
{
    return $this->db->table($this->table_report)
        ->select("
            {$this->table_report}.*, 
            tqp.kod_kuarters, 
            tqp.nama_kuarters, 
            tqp.jenis_kuarters, 
            ric.keterangan_kategori
        ")
        ->join("{$this->table} as tqp", "tqp.id_kuarters = {$this->table_report}.id_kuarters")
        ->join('ref_issue_category as ric', "ric.id_kategori_isu = {$this->table_report}.id_kategori_isu", 'left')
        
        // KEMASKINI: Menggunakan id_agensi_induk seperti dalam pangkalan data anda
        ->where('tqp.id_agensi_induk', $id_agensi) 
        
        ->where("{$this->table_report}.bulan", $bulan)
        ->where("{$this->table_report}.tahun", $tahun)
        ->get()
        ->getResultArray();
}


public function updateStatusHantar($bulan, $tahun, $id_agensi, $data)
{
    // 1. Dapatkan senarai id_kuarters dari jadual profil berdasarkan id_agensi_induk
    $list_kuarters = $this->db->table('table_quarters_profile') 
        ->select('id_kuarters')
        ->where('id_agensi_induk', $id_agensi)
        ->get()
        ->getResultArray();

    // 2. Ekstrak id_kuarters ke dalam array satu dimensi [101, 102, ...]
    $ids = array_column($list_kuarters, 'id_kuarters');

    // 3. Jika tiada kuarters di bawah agensi ini, pulangkan false
    if (empty($ids)) {
        return false;
    }

    // 4. Kemaskini status_hantar dalam jadual statistik (table_report)
    // untuk semua id_kuarters yang kita kumpul tadi
    return $this->db->table($this->table_report)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->whereIn('id_kuarters', $ids)
        ->update($data);
}

}//last