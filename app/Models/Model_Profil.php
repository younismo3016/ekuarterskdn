<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Profil extends Model
{
    // Nama jadual utama
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id_user';

    public function get_profil_user($id_user)
    {


    // Debug: Adakah id_user ini ada nilai?
    if (empty($id_user)) {
        return null;
    }
        // Menggunakan Query Builder CI4
        return $this->db->table('tbl_user')
            ->select('tbl_user.nama_penuh, tbl_user.email, tbl_user.no_tel, table_main_agency.nama_agensi_induk')
            ->join('table_main_agency', 'tbl_user.id_agensi_induk = table_main_agency.id_agensi_induk', 'left')
            ->where('tbl_user.id_user', $id_user)
            ->get()
            ->getRow(); // Bersamaan dengan row() dalam CI3
    }
}