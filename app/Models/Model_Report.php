<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Report extends Model
{
    protected $table      = 'table_report';
    protected $primaryKey = 'id_report';
    protected $allowedFields = [
        'bulan',
        'tahun', 
        'tahun',  
       
    ];

    public function get_all_data()
    {
        return $this->db->table('table_report')->get()->getResultArray();
    }
    public function kemaskini_status($data, $id_agensi_induk, $id_bulan, $id_tahun)
{
    // 1. Dapatkan senarai ID Kuarters milik agensi tersebut (Subquery)
    $subquery = $this->db->table('table_quarters_profile')
        ->select('id_kuarters')
        ->where('id_agensi_induk', $id_agensi_induk)
        ->getCompiledSelect();

    // 2. Update table_report berdasarkan senarai ID tadi
    return $this->db->table('table_report')
        ->where('bulan', $id_bulan)
        ->where('tahun', $id_tahun)
        ->where("id_kuarters IN ($subquery)", null, false) // Masukkan subquery di sini
        ->update($data);
}

    public function hapus_level($id_report)
    {
        $this->db->table('table_report')->delete(array('id_report' => $id_report    ));
    }

}