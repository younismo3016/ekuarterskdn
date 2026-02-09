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
        WHERE
            tqp.id_agensi_induk = ?
        GROUP BY
            tr.tahun, 
            tr.bulan
        ORDER BY 
            tr.tahun ASC, 
            tr.bulan ASC;
    ";

    return $this->db->query($sql, [$id_agensi])->getResultArray();
}

public function getDetailedReport($bulan, $tahun, $id_agensi, $limit = 10, $offset = 0, $keyword = null)
{
    $builder = $this->db->table('table_report tr');

    $builder->select("
        tr.*, 
        tqp.kod_kuarters, 
        tqp.nama_kuarters,

        (SELECT GROUP_CONCAT(ti.id_kategori_isu ORDER BY ti.id_kategori_isu ASC) 
         FROM table_issue ti 
         WHERE ti.id_report = tr.id_report) as id_kategori_isu,

        (SELECT CONCAT('KELAS ', GROUP_CONCAT(REPLACE(aqc.keterangan_kategori_kuarters, 'KELAS ', '') 
            ORDER BY aqc.keterangan_kategori_kuarters ASC SEPARATOR ', '))
         FROM table_jenis_kuarters tjk
         JOIN adm_quarters_category aqc 
           ON aqc.id_kategori_kuarters = tjk.id_kategori_kuarters
         WHERE tjk.id_kuarters = tqp.id_kuarters) as nama_kategori_kuarters
    ");

    $builder->join('table_quarters_profile tqp', 'tqp.id_kuarters = tr.id_kuarters');
    $builder->where('tqp.id_agensi_induk', $id_agensi);
    $builder->where('tr.bulan', $bulan);
    $builder->where('tr.tahun', $tahun);

    // 🔍 SEARCH (SERVER SIDE)
    if (!empty($keyword)) {
        $builder->groupStart()
            ->like('tqp.kod_kuarters', $keyword)
            ->orLike('tqp.nama_kuarters', $keyword)
        ->groupEnd();
    }

    $builder->orderBy('tqp.nama_kuarters', 'ASC');
    $builder->limit($limit, $offset);

    return $builder->get()->getResultArray();
}

public function countDetailedReport1($bulan, $tahun, $id_agensi, $keyword = null)
{
    $builder = $this->db->table('table_report tr');
    $builder->join('table_quarters_profile tqp', 'tqp.id_kuarters = tr.id_kuarters');
    $builder->where('tqp.id_agensi_induk', $id_agensi);
    $builder->where('tr.bulan', $bulan);
    $builder->where('tr.tahun', $tahun);

    if (!empty($keyword)) {
        $builder->groupStart()
            ->like('tqp.kod_kuarters', $keyword)
            ->orLike('tqp.nama_kuarters', $keyword)
        ->groupEnd();
    }

    return $builder->countAllResults();
}


public function getDetailedReportView($bulan, $tahun, $id_agensi, $limit = null, $offset = 0, $search = null)
{
    $builder = $this->db->table("{$this->table_report} tr")
        ->select("
            tr.*, 
            tqp.kod_kuarters, 
            tqp.nama_kuarters, 
            
            GROUP_CONCAT(DISTINCT aic.keterangan_kategori ORDER BY aic.keterangan_kategori ASC SEPARATOR ', ') as nama_kategori_isu,
            CONCAT('KELAS ', GROUP_CONCAT(DISTINCT REPLACE(aqc.keterangan_kategori_kuarters, 'KELAS ', '') ORDER BY aqc.keterangan_kategori_kuarters ASC SEPARATOR ', ')) as nama_kategori_kuarters
        ")
        ->join("{$this->table} as tqp", "tqp.id_kuarters = tr.id_kuarters")
        ->join("table_issue ti", "ti.id_report = tr.id_report", "left")
        ->join("adm_issue_category aic", "aic.id_kategori_isu = ti.id_kategori_isu", "left")
        ->join("table_jenis_kuarters tjk", "tjk.id_kuarters = tqp.id_kuarters", "left")
        ->join("adm_quarters_category aqc", "aqc.id_kategori_kuarters = tjk.id_kategori_kuarters", "left")
        ->where('tqp.id_agensi_induk', $id_agensi) 
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
public function countDetailedReport($bulan, $tahun, $id_agensi, $search = null)
{
    $builder = $this->db->table("{$this->table_report} tr")
        ->join("{$this->table} as tqp", "tqp.id_kuarters = tr.id_kuarters")
        ->where('tqp.id_agensi_induk', $id_agensi) 
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



public function getSenaraiTidakTally($bulan, $tahun, $id_agensi)
{
    $builder = $this->db->table($this->table_report);
    // Pastikan column nama_kuarters dan kod_kuarters diambil dari table profile
    $builder->select('table_quarters_profile.kod_kuarters, table_quarters_profile.nama_kuarters');
    $builder->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters');

    $builder->where('table_report.bulan', $bulan);
    $builder->where('table_report.tahun', $tahun);
    $builder->where('table_quarters_profile.id_agensi_induk', $id_agensi); 

    // Syarat ketidak-tally-an (Logik yang sama)
    $builder->where(" (
        (table_report.unit_dihuni != (table_report.dihuni_baik + table_report.dihuni_rosak)) 
        OR 
        (table_report.unit_tidak_dihuni != (
            table_report.baik_diduduki + table_report.baik_guna_sama + 
            table_report.baik_tukar_fungsi + table_report.baik_sewaan + 
            table_report.rosak_baik_pulih + table_report.rosak_guna_sama + 
            table_report.rosak_tukar_fungsi + table_report.rosak_sewaan + 
            table_report.rosak_roboh
        )) 
        OR 
        (table_report.total_unit_kuarters != (table_report.unit_dihuni + table_report.unit_tidak_dihuni))
    ) ");

    return $builder->get()->getResultArray();
}

public function getAdminKdnEmails()
{
    // Mengambil semua emel di mana level = 1
    $query = $this->db->table('tbl_user')
                      ->select('email')
                      ->where('level', 1)
                      ->get()
                      ->getResultArray();

    // Tukarkan hasil array multidimensi ke array satu dimensi
    // Contoh: ['admin1@moha.gov.my', 'admin2@moha.gov.my']
    return array_column($query, 'email');
}


public function getNamaAgensi($id_agensi)
{
    $query = $this->db->table('table_main_agency')
                      ->select('nama_agensi_induk')
                      ->where('id_agensi_induk', $id_agensi)
                      ->get();

    $row = $query->getRow(); // Ambil satu baris sahaja

    if ($row) {
        return $row->nama_agensi_induk; // Pulangkan string nama agensi
    }

    return "Agensi Tidak Ditemui"; // Nilai default jika tiada
}



public function getStatistikByAgensiExcel($id_agensi, $bulan, $tahun)
    {
        return $this->db->table($this->table_report . ' as tr')
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
            ->where('tqp.id_agensi_induk', $id_agensi) 
            ->where("tr.bulan", $bulan)
            ->where("tr.tahun", $tahun)
            ->groupBy("tr.id_report") // Penting kerana ada GROUP_CONCAT
            ->get()
            ->getResultArray();
    }



}//last