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
    // 1. Dapatkan tarikh semasa (Pastikan ia nombor/integer)
    $bulan_semak = (int)date('n'); 
    $tahun_semak = (int)date('Y'); 

    // 2. Dapatkan data dari Session
    $peranan   = session()->get('level'); 
    $id_agensi = (int)session()->get('id_agensi_induk'); // Pastikan integer untuk keselamatan

    // 3. Bina Asas SQL (Masukkan terus nilai bulan & tahun ke dalam string)
    $sql = "
        SELECT 
            ma.id_agensi_induk, ma.nama_agensi_induk AS nama_jabatan,
            
            -- --- BAHAGIAN 1: NOMBOR DATA (Sentiasa ambil yang TERKINI) ---
            SUM(COALESCE(latest.unit_dihuni, 0)) AS unit_dihuni,
            
            SUM(
                COALESCE(latest.baik_diduduki, 0) + 
                COALESCE(latest.baik_guna_sama, 0) + 
                COALESCE(latest.baik_tukar_fungsi, 0) + 
                COALESCE(latest.baik_sewaan, 0)
            ) AS unit_kosong_baik,
            
            SUM(
                COALESCE(latest.rosak_baik_pulih, 0) + 
                COALESCE(latest.rosak_guna_sama, 0) + 
                COALESCE(latest.rosak_tukar_fungsi, 0) + 
                COALESCE(latest.rosak_sewaan, 0) + 
                COALESCE(latest.rosak_roboh, 0)
            ) AS unit_kosong_rosak,

            SUM(COALESCE(latest.total_unit_kuarters, 0)) AS jumlah_unit,
            
            -- --- BAHAGIAN 2: STATUS ---
            (
                SELECT nama_status FROM adm_status 
                WHERE id_status = 
                CASE 
                    WHEN SUM(CASE WHEN current_month.status_hantar = 2 THEN 1 ELSE 0 END) > 0 THEN 2
                    WHEN SUM(CASE WHEN current_month.status_hantar = 1 THEN 1 ELSE 0 END) > 0 THEN 1
                    ELSE 0 
                END
            ) AS status_hantar

        FROM table_main_agency ma
        JOIN table_quarters_profile q ON ma.id_agensi_induk = q.id_agensi_induk

        -- JOIN A: Dapatkan Data TERKINI
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

        -- JOIN B: Suntikan Pembolehubah Terus (Direct Injection)
        LEFT JOIN table_report current_month ON q.id_kuarters = current_month.id_kuarters 
            AND current_month.bulan = $bulan_semak 
            AND current_month.tahun = $tahun_semak
    ";

    // 4. LOGIK PENAPISAN MENGIKUT PERANAN (Role = 3)
    if ($peranan == 3) {
        // Masukkan terus ID Agensi
        $sql .= " WHERE ma.id_agensi_induk = $id_agensi ";
    }

    // 5. Tutup SQL dengan GROUP BY & ORDER BY
    $sql .= "
        GROUP BY ma.id_agensi_induk, ma.nama_agensi_induk
        ORDER BY ma.nama_agensi_induk ASC
    ";

    // 6. Jalankan query biasa tanpa array bindings
    $query = $this->db->query($sql);
    
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

// FUNGSI BARU: Kiraan tepat untuk 1 bulan spesifik beserta data bawaan (carry forward)
public function getStatistikBulan($bulan, $tahun)
{
    // Format period jadi 'YYYYMM' (Contoh: '202503' untuk Mac 2025)
    $period = sprintf('%04d%02d', $tahun, $bulan);
    
    $sql = "
        SELECT 
            ? AS bulan,
            ? AS tahun,
            
            -- Kira berapa agensi berdaftar vs berapa yang hantar bulan ini
            COUNT(q.id_kuarters) AS jumlah_kuarters_berdaftar,
            SUM(CASE WHEN r.bulan = ? AND r.tahun = ? THEN 1 ELSE 0 END) AS jumlah_hantar_semasa,
            
            -- Jumlahkan unit berdasarkan snapshot terbaharu
            SUM(IFNULL(r.unit_dihuni, 0)) AS total_unit_dihuni, 
            SUM(IFNULL(r.unit_tidak_dihuni, 0)) AS total_unit_tidak_dihuni
            
        FROM table_quarters_profile q
        
        -- SUBQUERY: Cari rekod Selesai (2) paling latest SEBELUM/PADA bulan ini
        LEFT JOIN (
            SELECT id_kuarters, MAX(CONCAT(tahun, LPAD(bulan, 2, '0'))) as latest_period
            FROM table_report
            WHERE status_hantar = 2
            AND CONCAT(tahun, LPAD(bulan, 2, '0')) <= ?
            GROUP BY id_kuarters
        ) latest ON q.id_kuarters = latest.id_kuarters
        
        -- JOIN untuk dapatkan data sebenar (Dihuni/Kosong) dari report latest itu
        LEFT JOIN table_report r ON r.id_kuarters = latest.id_kuarters 
            AND CONCAT(r.tahun, LPAD(r.bulan, 2, '0')) = latest.latest_period
    ";

    // Bind parameter untuk keselamatan SQL Injection
    return $this->db->query($sql, [$bulan, $tahun, $bulan, $tahun, $period])->getRowArray();
}

public function getStatistikByYear($tahun)
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
            tr.tahun = ? -- KITA TAMBAH INI SUPAYA FOKUS 1 TAHUN SAHAJA
        GROUP BY
            tr.tahun, 
            tr.bulan
        ORDER BY 
            tr.tahun ASC, 
            tr.bulan ASC;
    ";

    // Bind parameter tahun untuk keselamatan
    return $this->db->query($sql, [$tahun])->getResultArray();
}

// 1. Fungsi Paparan Utama
// 1. Fungsi Paparan Utama
public function getDetailedReportView($bulan, $tahun, $limit = null, $offset = 0, $search = null)
{
    // Dapatkan data dari Session
    $peranan   = session()->get('level'); 
    $id_agensi = (int)session()->get('id_agensi_induk');

    // Subquery untuk mencari report yang paling terkini (status_hantar = 2)
    $subquery = $this->db->table('table_report')
        ->select("id_kuarters, MAX(CONCAT(tahun, LPAD(bulan, 2, '0'))) as latest_period")
        ->where('status_hantar', 2)
        ->where("CONCAT(tahun, LPAD(bulan, 2, '0')) <=", sprintf('%04d%02d', $tahun, $bulan))
        ->groupBy('id_kuarters');

    // Compile subquery menjadi string SQL
    $subquerySql = $subquery->getCompiledSelect();

    $builder = $this->db->table("{$this->table} tr")
        ->select("
            tr.*, 
            tqp.kod_kuarters, 
            tqp.nama_kuarters, 
            
            -- Subquery untuk Isu
            (
                SELECT GROUP_CONCAT(CONCAT(aic.id_kategori_isu, '. ', aic.keterangan_kategori) ORDER BY aic.id_kategori_isu ASC SEPARATOR ', ')
                FROM table_issue ti
                JOIN adm_issue_category aic ON ti.id_kategori_isu = aic.id_kategori_isu
                WHERE ti.id_report = tr.id_report
            ) AS nama_kategori_isu,
            
            -- Subquery untuk Kelas Kuarters
            (
                SELECT CONCAT('KELAS ', GROUP_CONCAT(cat.kelas ORDER BY cat.kelas ASC SEPARATOR ', '))
                FROM table_jenis_kuarters tjk
                JOIN adm_quarters_category cat ON tjk.id_kategori_kuarters = cat.id_kategori_kuarters
                WHERE tjk.id_kuarters = tqp.id_kuarters
            ) AS nama_kategori_kuarters
        ")
        ->join("({$subquerySql}) latest", "tr.id_kuarters = latest.id_kuarters AND CONCAT(tr.tahun, LPAD(tr.bulan, 2, '0')) = latest.latest_period", "inner")
        ->join("{$this->table_qp} as tqp", "tqp.id_kuarters = tr.id_kuarters", "inner")
        ->where("tr.status_hantar", 2);

    // ==========================================
    // LOGIK PENAPISAN MENGIKUT PERANAN (Role = 3)
    // ==========================================
    if ($peranan == 3) {
        $builder->where('tqp.id_agensi_induk', $id_agensi);
    }

    // Filter Carian
    if ($search) {
        $builder->groupStart()
                ->like('tqp.kod_kuarters', $search)
                ->orLike('tqp.nama_kuarters', $search)
                ->groupEnd();
    }

    $builder->orderBy("tqp.id_kuarters", "ASC");

    if ($limit !== null) {
        return $builder->get($limit, $offset)->getResultArray();
    }

    return $builder->get()->getResultArray();
}


// 2. Fungsi Kiraan (Count) Untuk Pagination
public function countDetailedReport($bulan, $tahun, $search = null)
{
    // Dapatkan data dari Session
    $peranan   = session()->get('level'); 
    $id_agensi = (int)session()->get('id_agensi_induk');

    $subquery = $this->db->table('table_report')
        ->select("id_kuarters, MAX(CONCAT(tahun, LPAD(bulan, 2, '0'))) as latest_period")
        ->where('status_hantar', 2)
        ->where("CONCAT(tahun, LPAD(bulan, 2, '0')) <=", sprintf('%04d%02d', $tahun, $bulan))
        ->groupBy('id_kuarters');

    $subquerySql = $subquery->getCompiledSelect();

    $builder = $this->db->table("{$this->table} tr")
        ->join("({$subquerySql}) latest", "tr.id_kuarters = latest.id_kuarters AND CONCAT(tr.tahun, LPAD(tr.bulan, 2, '0')) = latest.latest_period", "inner")
        ->join("{$this->table_qp} as tqp", "tqp.id_kuarters = tr.id_kuarters", "inner")
        ->where("tr.status_hantar", 2);

    // ==========================================
    // LOGIK PENAPISAN MENGIKUT PERANAN (Role = 3)
    // ==========================================
    if ($peranan == 3) {
        $builder->where('tqp.id_agensi_induk', $id_agensi);
    }

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
    // 1. Dapatkan data dari Session
    $peranan   = session()->get('level'); 
    $id_agensi = (int)session()->get('id_agensi_induk'); // Pastikan integer untuk keselamatan

    // 2. Bina Asas SQL
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

        -- TAMBAHAN: JOIN dengan table_quarters_profile untuk kenal pasti Agensi
        JOIN table_quarters_profile q ON r.id_kuarters = q.id_kuarters

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

    // 3. LOGIK PENAPISAN MENGIKUT PERANAN (Role = 3)
    if ($peranan == 3) {
        // Tapis hanya data kuarters di bawah agensi yang sedang login
        $sql .= " AND q.id_agensi_induk = $id_agensi ";
    }

    // 4. Jalankan Query
    $query = $this->db->query($sql);
    
    // Bergantung kepada Controller Tuan, biasaya dashboard perlukan 1 baris (Row) sahaja. 
    // Tapi saya kekalkan getResultArray() ikut kod asal Tuan.
    return $query->getResultArray(); 
}

   public function getStatistikByAgensiExcel($bulan, $tahun)
{
    // Sanitasi input
    $bulan = (int)$this->db->escapeString($bulan);
    $tahun = (int)$this->db->escapeString($tahun);

    // SQL Query (Sama seperti yang anda berikan, cuma dengan variable PHP)
    $sql = "
        SELECT 
            -- 0. Bilangan
            ROW_NUMBER() OVER (ORDER BY q.id_kuarters ASC) + 6715 AS `BIL`,

            -- 1. Maklumat Asas
            q.kod_kuarters AS `KOD`,
            'KDN' AS `KEMENTERIAN`,
            ma.nama_agensi_induk AS `A. JABATAN/AGENSI PENGGUNA/PEMILIK`,
            q.nama_kuarters AS `B. NAMA KUARTERS`,
            
            -- 2. Lokasi
            s.state_description AS `C. NEGERI`, 
            d.district_name AS `DAERAH`, 
            
            -- 3. Jenis Kuarters
            (
                SELECT CONCAT('KELAS ', GROUP_CONCAT(cat.kelas ORDER BY cat.kelas ASC SEPARATOR ', '))
                FROM table_jenis_kuarters jk
                JOIN adm_quarters_category cat ON jk.id_kategori_kuarters = cat.id_kategori_kuarters
                WHERE jk.id_kuarters = q.id_kuarters
            ) AS `D. JENIS KUARTERS`,
            
            q.tahun_siap AS `E. TAHUN/ TARIKH SIAP`,
            
            -- 4. Statistik Huni
            r.jumlah_permohonan AS `F.JUMLAH PERMOHONAN KUARTERS`,
            r.unit_dihuni AS `G. JUMLAH UNIT DIHUNI`,
            r.dihuni_baik AS `H. DIHUNI (KEADAAN BAIK)`,
            r.dihuni_rosak AS `I. DIHUNI (ADA KEROSAKAN)`,
            
            -- Semakan 1
            (IFNULL(r.dihuni_baik, 0) + IFNULL(r.dihuni_rosak, 0)) AS `Jumlah Huni (Check)`,
            CASE 
                WHEN (IFNULL(r.dihuni_baik, 0) + IFNULL(r.dihuni_rosak, 0)) = IFNULL(r.unit_dihuni, 0) THEN 'TRUE' 
                ELSE 'FALSE' 
            END AS `Jumlah Huni (Validity)`,
            
            -- 5. Statistik Tidak Huni
            r.unit_tidak_dihuni AS `J. JUMLAH UNIT TIDAK DIHUNI`,
            
            -- Semakan 2
            (
                IFNULL(r.baik_diduduki, 0) + IFNULL(r.baik_guna_sama, 0) + IFNULL(r.baik_tukar_fungsi, 0) + IFNULL(r.baik_sewaan, 0) +
                IFNULL(r.rosak_baik_pulih, 0) + IFNULL(r.rosak_guna_sama, 0) + IFNULL(r.rosak_tukar_fungsi, 0) + IFNULL(r.rosak_sewaan, 0) + IFNULL(r.rosak_roboh, 0)
            ) AS `Jumlah Tidak Huni (Check)`,
            
            CASE 
                WHEN (
                    IFNULL(r.baik_diduduki, 0) + IFNULL(r.baik_guna_sama, 0) + IFNULL(r.baik_tukar_fungsi, 0) + IFNULL(r.baik_sewaan, 0) +
                    IFNULL(r.rosak_baik_pulih, 0) + IFNULL(r.rosak_guna_sama, 0) + IFNULL(r.rosak_tukar_fungsi, 0) + IFNULL(r.rosak_sewaan, 0) + IFNULL(r.rosak_roboh, 0)
                ) = IFNULL(r.unit_tidak_dihuni, 0) THEN 'TRUE' 
                ELSE 'FALSE' 
            END AS `Jumlah Tidak Huni (Validity)`,

            -- 6. Pecahan Unit Kosong (BAIK)
            r.baik_diduduki AS `K. BAIK - BOLEH DIDUDUKI (UNIT)`,
            r.baik_guna_sama AS `L. BAIK - CADANGAN GUNA SAMA (UNIT)`,
            r.ket_baik_guna_sama AS `KETERANGAN BAIK-GUNA SAMA`,
            r.baik_tukar_fungsi AS `M. BAIK - CADANGAN TUKAR FUNGSI (UNIT)`,
            r.ket_baik_tukar_fungsi AS `KETERANGAN BAIK-TUKAR FUNGSI`,
            r.baik_sewaan AS `N. BAIK - CADANGAN SEWAAN/PAJAKAN/ SEWA-BELI (UNIT)`,
            r.ket_baik_sewaan AS `KETERANGAN BAIK-SEWAAN/PAJAKAN`,
            
            -- 7. Pecahan Unit Kosong (ROSAK)
            r.rosak_baik_pulih AS `O. ROSAK - MEMERLUKAN KERJA BAIK PULIH DAN KERJA PEMBAIKAN (UNIT)`,
            r.ket_rosak_baik_pulih AS `KETERANGAN ROSAK-KERJA BAIK PULIH`,
            r.rosak_guna_sama AS `P. ROSAK - CADANGAN GUNA SAMA (UNIT)`,
            r.ket_rosak_guna_sama AS `KETERANGAN ROSAK-GUNA SAMA`,
            r.rosak_tukar_fungsi AS `Q. ROSAK - CADANGAN TUKAR FUNGSI (UNIT)`,
            r.ket_rosak_tukar_fungsi AS `KETERANGAN ROSAK-TUKAR FUNGSI`,
            r.rosak_sewaan AS `R. ROSAK - CADANGAN SEWAAN/PAJAKAN/ SEWA-BELI (UNIT)`,
            r.ket_rosak_sewaan AS `KETERANGAN ROSAK-SEWAAN/PAJAKAN`,
            r.rosak_roboh AS `S. ROSAK - CADANGAN ROBOH (UNIT)`,
            r.ket_rosak_roboh AS `KETERANGAN ROSAK-ROBOH`,
            
            -- 8. Total & Isu
            r.total_unit_kuarters AS `T. JUMLAH UNIT KUARTERS`,
            
            -- Semakan 3
            (IFNULL(r.unit_dihuni, 0) + IFNULL(r.unit_tidak_dihuni, 0)) AS `Jumlah Kuarters (Check)`,
            CASE 
                WHEN (IFNULL(r.unit_dihuni, 0) + IFNULL(r.unit_tidak_dihuni, 0)) = IFNULL(r.total_unit_kuarters, 0) THEN 'TRUE' 
                ELSE 'FALSE' 
            END AS `Jumlah Kuarters (Validity)`,

            -- 9. Kategori Isu
            (
                SELECT GROUP_CONCAT(CONCAT(aic.id_kategori_isu, '. ', aic.keterangan_kategori) ORDER BY aic.id_kategori_isu ASC SEPARATOR ', ')
                FROM table_issue ti
                JOIN adm_issue_category aic ON ti.id_kategori_isu = aic.id_kategori_isu
                WHERE ti.id_report = r.id_report
            ) AS `U. ISU PENGOPERASIAN`,
            
            r.keterangan_isu AS `V. KETERANGAN ISU`,
            r.status_tindakan AS `W. STATUS TINDAKAN TERKINI DAN CADANGAN PENYELESAIAN`,
            r.senarai_kerja AS `X. SENARAI KERJA PENYELENGGARAAN/ PEMBAIKAN`,
            r.kos_rm AS `Y. KOS PENYELENGGARAAN KUARTERS YANG DIPERLUKAN (RM)`,
            r.jangkaan_pelaksanaan AS `Z. JANGKAAN TAHUN PELAKSANAAN (2025 / 2026)`,
            r.catatan AS `CATATAN`

        FROM table_report r
        JOIN (
            SELECT id_kuarters, MAX(CONCAT(tahun, LPAD(bulan, 2, '0'))) as latest_period
            FROM table_report
            WHERE status_hantar = 2
            AND CONCAT(tahun, LPAD(bulan, 2, '0')) <= CONCAT($tahun, LPAD($bulan, 2, '0'))
            GROUP BY id_kuarters
        ) latest ON r.id_kuarters = latest.id_kuarters 
          AND CONCAT(r.tahun, LPAD(r.bulan, 2, '0')) = latest.latest_period

        JOIN table_quarters_profile q ON r.id_kuarters = q.id_kuarters
        LEFT JOIN table_main_agency ma ON q.id_agensi_induk = ma.id_agensi_induk
        LEFT JOIN adm_state s ON q.id_negeri = s.id_adm_state
        LEFT JOIN adm_district d ON q.id_daerah = d.id_adm_district

        WHERE r.status_hantar = 2
        ORDER BY q.id_kuarters ASC
    ";

    return $this->db->query($sql)->getResultArray();
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
