<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_User extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'name_user',
        'email',
        'no_hp',
        'level',
        'photo_user',
    ];

    public function get_all_data()
    {
        return $this->db->table('tbl_user')->orderBy('id_user', 'DESC')->get()->getResultArray();
    }
    public function get_user($id_user)
    {

        $builder = $this->select('*');
        $builder->where('id_user', $id_user);
        return $builder->get()->getResultArray();
        //return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }

    public function get_email($id_user)
    {
        return $this->select('email')
            ->where('id_user', $id_user)
            ->first(); // Ganti get()->getResultArray() dengan first()
    }

    public function get_email_psu($id_psu)
    {
        return $this->select('email')
            ->where('id_user', $id_psu)
            ->first(); // Ganti get()->getResultArray() dengan first()
    }

    public function get_email_pptm($id_pptm)
    {
        return $this->select('email')
            ->where('id_user', $id_pptm)
            ->first(); // Ganti get()->getResultArray() dengan first()
    }
    public function get_email_pemohon($id_pemohon)
    {
        return $this->select('email')
            ->where('id_user', $id_pemohon)
            ->first(); // Ganti get()->getResultArray() dengan first()
    }

    public function get_nama($id_pemohon)
    {
        return $this->select('nama_penuh')
            ->where('id_user', $id_pemohon)
            ->first(); // Ganti get()->getResultArray() dengan first()
    }

    public function get_phone_pemohon($phone)
    {
        return $this->select('no_tel')
            ->where('id_user', $phone)
            ->first(); // Ganti get()->getResultArray() dengan first()
    }


    public function get_pengesah($id_bahagian)
    {
        return $this->db->table('tbl_user')
            ->where('level', 7)
            ->where('id_bahagian', $id_bahagian)
            ->orderBy('id_user', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function get_pengesah_it()
    {
        return $this->db->table('tbl_user')
            ->where('level', 5)
            ->where('id_bahagian', 8)
            ->orderBy('id_user', 'DESC')
            ->get()
            ->getResultArray();
    }
    public function get_pegawai_data()
    {
        return $this->db->table('tbl_user')
            ->where('id_seksyen', 'OK')
            ->where('id_bahagian', 8)
            ->where('level', 5)
            ->where('status_user', 1)
            ->orderBy('id_user', 'DESC')
            ->get()
            ->getResultArray();
    }
     public function get_pptm_ok()
    {
        return $this->db->table('tbl_user')
            ->where('id_seksyen', 'OK')
            ->where('id_bahagian', 8)
            ->where('level', 6)
            ->where('status_user', 1)
            ->orderBy('id_user', 'DESC')
            ->get()
            ->getResultArray();
    }
    

    public function get_pptm_()
    {
        return $this->db->table('tbl_user')
        ->orderBy('id_user', 'DESC')
        ->get()
        ->getResultArray();
    }

    public function get_psu($id_seksyen)
    {
       return $this->db->table('tbl_user')
            ->where('id_seksyen', $id_seksyen)
            ->where('level', 5)
            ->get()
            ->getResultArray();
    }
    public function get_pptm_list($id_seksyen)
    {
       return $this->db->table('tbl_user')
            ->where('id_seksyen', $id_seksyen)
            ->where('level', 6)
            ->get()
            ->getResultArray();
    }

    public function get_kpsu()
    {
        return $this->db->table('tbl_user')->orderBy('id_user', 'DESC')->get()->getResultArray();
    }





    function carian_pengguna($nama_penuh, $email)
{
    $builder = $this->db->table('tbl_user');
    // Sentiasa susun yang terbaru di atas, untuk kedua-dua kes
    $builder->orderBy('id_user', 'DESC'); 

    // Semak jika ada kriteria carian (sama ada nama ATAU email diisi)
    if ($nama_penuh || $email) {
        // --- BLOK INI HANYA JALAN JIKA ADA CARIAN ---
        
        if ($nama_penuh) {
            $builder->like('nama_penuh', $nama_penuh, 'both'); //'%match%' 
        }
        if ($email) {
            $builder->like('email', $email, 'both'); //'%match%' 
        }

        // Hadkan kepada 1000 keputusan untuk carian
        $builder->limit(200); 

    } else {
        // --- BLOK INI JALAN JIKA TIADA CARIAN (muat halaman biasa) ---
        
        // Papar 20 senarai yang terbaru sahaja
        $builder->limit(20);
    }

    // Jalankan query dan pulangkan hasil
    return $builder->get()->getResultArray();
}
    public function add_user($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    public function update_user($data, $id_user)
    {
        $this->db->table('tbl_user')->update($data, array('id_user' => $id_user));
    }

    public function delete_user($id_user)
    {
        $this->db->table('tbl_user')->delete(array('id_user' => $id_user));
    }
}
