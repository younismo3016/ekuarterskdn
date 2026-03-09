<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Agensi_User extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'name_user';

    // Pastikan field 'level' juga ada jika anda gunakannya dalam Controller
    protected $allowedFields = [
        'nama_penuh', 
        'name_user', 
        'email', 
        'no_tel', 
        'level',            // Tambah ini jika dalam Controller guna 'level'
        'id_peranan', 
        'password',
        'id_agensi_induk'
    ];

    /* Komen atau Padam bahagian ini 
       Kerana kita sudah buat hashing di Controller simpan()
    */
    // protected $beforeInsert = ['hashPassword'];
    // protected $beforeUpdate = ['hashPassword'];

    /*
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) return $data;
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
    */
}