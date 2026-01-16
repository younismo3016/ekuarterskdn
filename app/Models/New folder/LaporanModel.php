<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
   

    function laporan_keseluruhan($start_tahun)
	{
        // var_dump($start_tahun);
        // exit;

        $sql = "
        SELECT adm_kategori_surat.kategori_surat as kategori,
        COUNT(*) as mohon
        FROM tbl_surat_masuk 
        JOIN adm_kategori_surat on adm_kategori_surat.id_kategori_surat=tbl_surat_masuk.kategori_surat
        where YEAR(tbl_surat_masuk.cipta_pada) = " . $start_tahun. "
        group by kategori  
        ";

        $db = \Config\Database::connect();
        
        $query = $db->query($sql);

        // Get the results
        $results = $query->getResult();
        
        return $results;
	}

    function laporan_mengikut_bulan($start_tahun)
	{
		$sql = "
        SELECT
    MONTHNAME(tbl_surat_masuk.cipta_pada) AS bulan_sebenar,
    SUM(CASE WHEN YEAR(tbl_surat_masuk.cipta_pada) = " . $start_tahun. " AND kategori_surat = 2 THEN 1 ELSE 0 END) AS DalamTindakan,
		SUM(CASE WHEN YEAR(tbl_surat_masuk.cipta_pada) = " . $start_tahun. " AND kategori_surat = 1 THEN 1 ELSE 0 END) AS RayuanBaru,
		SUM(CASE WHEN YEAR(tbl_surat_masuk.cipta_pada) = " . $start_tahun. " AND kategori_surat = 3 THEN 1 ELSE 0 END) AS TidakLengkap,
		SUM(CASE WHEN YEAR(tbl_surat_masuk.cipta_pada) = " . $start_tahun. " AND kategori_surat = 4 THEN 1 ELSE 0 END) AS Sabah,
		SUM(CASE WHEN YEAR(tbl_surat_masuk.cipta_pada) = " . $start_tahun. " AND kategori_surat = 5 THEN 1 ELSE 0 END) AS Lain2,
    COUNT(*) AS jumlah_daftar
FROM
    tbl_surat_masuk
WHERE
    YEAR(tbl_surat_masuk.cipta_pada) = " . $start_tahun. "
GROUP BY
    bulan_sebenar";

        $db = \Config\Database::connect();
        
        $query = $db->query($sql);

        // Get the results
        $results = $query->getResult();
        
        return $results;
	}

    

}