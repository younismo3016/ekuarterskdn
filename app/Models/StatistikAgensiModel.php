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
            -- Gunakan MAX untuk status_hantar
            MAX(tr.status_hantar) AS status_hantar,
            
            -- TAMBAH INI: Ambil nilai status_reset (MAX supaya 1 menang)
            MAX(tr.status_reset) AS status_reset,

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

public function getDetailedReport($bulan, $tahun, $id_agensi, $limit = 10, $offset = 0, $keyword = null, $status_tally = 'SEMUA')
{
    $builder = $this->db->table('table_report tr');

    // Formula SQL yang lebih "solid" (elak isu null)
    $sql_total_cadangan = "(
        COALESCE(tr.baik_diduduki, 0) + COALESCE(tr.baik_guna_sama, 0) + 
        COALESCE(tr.baik_tukar_fungsi, 0) + COALESCE(tr.baik_sewaan, 0) + 
        COALESCE(tr.rosak_baik_pulih, 0) + COALESCE(tr.rosak_guna_sama, 0) + 
        COALESCE(tr.rosak_tukar_fungsi, 0) + COALESCE(tr.rosak_sewaan, 0) + 
        COALESCE(tr.rosak_roboh, 0)
    )";
    
    $cond_huni     = "COALESCE(tr.unit_dihuni, 0) = (COALESCE(tr.dihuni_baik, 0) + COALESCE(tr.dihuni_rosak, 0))";
    $cond_cadangan = "COALESCE(tr.unit_tidak_dihuni, 0) = $sql_total_cadangan";
    $cond_total    = "COALESCE(tr.total_unit_kuarters, 0) = (COALESCE(tr.unit_dihuni, 0) + COALESCE(tr.unit_tidak_dihuni, 0))";
    
    // Gabungan 3 syarat utama
    $all_tally_sql = "($cond_huni AND $cond_cadangan AND $cond_total)";

    $builder->select("
        tr.*, 
        tqp.kod_kuarters, 
        tqp.nama_kuarters,
        $sql_total_cadangan AS total_cadangan_calc,
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

    // Filter Logic
    if ($status_tally === 'TALLY') {
        $builder->where($all_tally_sql, null, false);
    } elseif ($status_tally === 'TIDAK_TALLY') {
        // Guna HAVING atau WHERE yang merangkumi salah satu ralat
        $builder->where("NOT ($cond_huni AND $cond_cadangan AND $cond_total)", null, false);
    }

    if (!empty($keyword)) {
        $builder->groupStart()
            ->like('tqp.kod_kuarters', $keyword)
            ->orLike('tqp.nama_kuarters', $keyword)
        ->groupEnd();
    }

    return $builder->orderBy('tqp.id_kuarters', 'ASC')->limit($limit, $offset)->get()->getResultArray();
}

public function countDetailedReport1($bulan, $tahun, $id_agensi, $keyword = null, $status_tally = 'SEMUA')
{
    $builder = $this->db->table('table_report tr');

    // Formula SQL yang konsisten dengan getDetailedReport
    $sql_total_cadangan = "(
        COALESCE(tr.baik_diduduki, 0) + COALESCE(tr.baik_guna_sama, 0) + 
        COALESCE(tr.baik_tukar_fungsi, 0) + COALESCE(tr.baik_sewaan, 0) + 
        COALESCE(tr.rosak_baik_pulih, 0) + COALESCE(tr.rosak_guna_sama, 0) + 
        COALESCE(tr.rosak_tukar_fungsi, 0) + COALESCE(tr.rosak_sewaan, 0) + 
        COALESCE(tr.rosak_roboh, 0)
    )";
    
    $cond_huni     = "COALESCE(tr.unit_dihuni, 0) = (COALESCE(tr.dihuni_baik, 0) + COALESCE(tr.dihuni_rosak, 0))";
    $cond_cadangan = "COALESCE(tr.unit_tidak_dihuni, 0) = $sql_total_cadangan";
    $cond_total    = "COALESCE(tr.total_unit_kuarters, 0) = (COALESCE(tr.unit_dihuni, 0) + COALESCE(tr.unit_tidak_dihuni, 0))";
    
    $all_tally_sql = "($cond_huni AND $cond_cadangan AND $cond_total)";

    $builder->join('table_quarters_profile tqp', 'tqp.id_kuarters = tr.id_kuarters');
    $builder->where('tqp.id_agensi_induk', $id_agensi);
    $builder->where('tr.bulan', $bulan);
    $builder->where('tr.tahun', $tahun);

    // Filter Logic yang sama
    if ($status_tally === 'TALLY') {
        $builder->where($all_tally_sql, null, false);
    } elseif ($status_tally === 'TIDAK_TALLY') {
        $builder->where("NOT ($all_tally_sql)", null, false);
    }

    // Search Keyword
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
                ->orLike('tqp.id_kuarters', $search)
                ->groupEnd();
    }

    $builder->groupBy("tr.id_report")
            ->orderBy("tqp.id_kuarters", "ASC");

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
    $builder = $this->db->table('table_report tr');

    // 1. Definisikan formula yang sama dengan getDetailedReport
    $sql_total_cadangan = "(
        COALESCE(tr.baik_diduduki, 0) + COALESCE(tr.baik_guna_sama, 0) + 
        COALESCE(tr.baik_tukar_fungsi, 0) + COALESCE(tr.baik_sewaan, 0) + 
        COALESCE(tr.rosak_baik_pulih, 0) + COALESCE(tr.rosak_guna_sama, 0) + 
        COALESCE(tr.rosak_tukar_fungsi, 0) + COALESCE(tr.rosak_sewaan, 0) + 
        COALESCE(tr.rosak_roboh, 0)
    )";
    
    $cond_huni     = "COALESCE(tr.unit_dihuni, 0) = (COALESCE(tr.dihuni_baik, 0) + COALESCE(tr.dihuni_rosak, 0))";
    $cond_cadangan = "COALESCE(tr.unit_tidak_dihuni, 0) = $sql_total_cadangan";
    $cond_total    = "COALESCE(tr.total_unit_kuarters, 0) = (COALESCE(tr.unit_dihuni, 0) + COALESCE(tr.unit_tidak_dihuni, 0))";
    
    // Gabungan semua syarat (Tally jika ketiga-tiga benar)
    $all_tally_sql = "($cond_huni AND $cond_cadangan AND $cond_total)";

    // 2. Pilih column yang diperlukan
    $builder->select('tqp.kod_kuarters, tqp.nama_kuarters, tr.*');
    $builder->join('table_quarters_profile tqp', 'tqp.id_kuarters = tr.id_kuarters');

    // 3. Filter asas
    $builder->where('tr.bulan', $bulan);
    $builder->where('tr.tahun', $tahun);
    $builder->where('tqp.id_agensi_induk', $id_agensi); 

    // 4. Syarat TIDAK TALLY (Guna NOT pada logik tally asal)
    // Ini memastikan jika salah satu ralat, ia akan masuk dalam list ini
    $builder->where("NOT ($all_tally_sql)", null, false);

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

public function getKuartersBelumAda($id_agensi_induk, $bulan, $tahun)
{
    $db = \Config\Database::connect();
    
    // 1. Subquery: Ambil ID kuarters yang DAH ADA dalam laporan bulan/tahun tersebut
    $subQuery = $db->table('table_report')
                   ->select('id_kuarters')
                   ->where('bulan', $bulan)
                   ->where('tahun', $tahun);
                   // Kolum id_agensi tiada dalam table_report, jadi kita tak tapis kat sini

    // 2. Query Utama: Ambil profil kuarters milik agensi login, KECUALI yang dah ada di atas
    $builder = $db->table('table_quarters_profile');
    
    // Tapis kuarters milik agensi induk
    $builder->where('id_agensi_induk', $id_agensi_induk); 
    
    // Tapis supaya tidak keluar kuarters yang dah ada dalam table_report
    $builder->whereNotIn('id_kuarters', $subQuery);
    
    return $builder->get()->getResultArray();
}

}//last