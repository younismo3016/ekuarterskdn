<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_ChangePwd extends Model
{
    // 1. Konfigurasi Jadual
    protected $table            = 'tbl_user'; 
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'array';
    
    // 2. Benarkan ruangan 'password' untuk dikemaskini
    protected $allowedFields    = ['password'];

    /**
     * Mengambil data pengguna berdasarkan ID
     */
    public function getUser($id_user)
    {
        return $this->find($id_user);
    }

    /**
     * Mengemaskini katalaluan pengguna
     * $data mestilah mengandungi ['password' => 'hasil_password_hash']
     */
    public function updatePassword($id_user, $data)
    {
        return $this->update($id_user, $data);
    }

    /**
     * (Tambahan) Mencari pengguna berdasarkan username untuk proses Login
     */
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}