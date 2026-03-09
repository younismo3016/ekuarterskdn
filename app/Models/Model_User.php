<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_User extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id_user';
    
    protected $returnType = 'array';
    protected $useTimestamps = false; // Set true jika ada created_at/updated_at

    // SANGAT PENTING: Senaraikan SEMUA column yang boleh diupdate
    protected $allowedFields = [
        'name_user',    // Saya kekalkan jika table guna ini
        'nama_penuh',   // DITAMBAH (sebab ada guna dalam search)
        'email',
        'no_hp',
        'no_tel',       // DITAMBAH (sebab ada function get_phone_pemohon)
        'level',
        'photo_user',
        'password',     // WAJIB ADA untuk reset password
        'id_bahagian',  // DITAMBAH (untuk function pegawai)
        'id_seksyen',   // DITAMBAH (untuk function pegawai)
        'status_user'   // DITAMBAH (untuk set aktif/tak aktif)
    ];

    // --- FUNGSI SEDIA ADA ANDA (DIKEKALKAN) ---

    public function get_all_data()
    {
        return $this->db->table('tbl_user')->orderBy('id_user', 'DESC')->get()->getResultArray();
    }

    public function get_user($id_user)
    {
        // Guna $this->find() lebih ringkas jika nak return array satu row
        return $this->where('id_user', $id_user)->findAll();
    }

    public function get_email($id_user)
    {
        return $this->select('email')->where('id_user', $id_user)->first();
    }

    // ... (Fungsi get_email lain kekal sama) ...
    public function get_email_psu($id_psu) { return $this->select('email')->where('id_user', $id_psu)->first(); }
    public function get_email_pptm($id_pptm) { return $this->select('email')->where('id_user', $id_pptm)->first(); }
    public function get_email_pemohon($id_pemohon) { return $this->select('email')->where('id_user', $id_pemohon)->first(); }

    public function get_nama($id_pemohon)
    {
        return $this->select('nama_penuh')->where('id_user', $id_pemohon)->first();
    }

    public function get_phone_pemohon($phone)
    {
        return $this->select('no_tel')->where('id_user', $phone)->first();
    }

    public function get_pengesah($id_bahagian)
    {
        return $this->db->table('tbl_user')
            ->where('level', 7)
            ->where('id_bahagian', $id_bahagian)
            ->orderBy('id_user', 'DESC')
            ->get()->getResultArray();
    }

    public function get_pengesah_it()
    {
        return $this->db->table('tbl_user')
            ->where('level', 5) // Pastikan level betul
            ->where('id_bahagian', 8)
            ->orderBy('id_user', 'DESC')
            ->get()->getResultArray();
    }

    public function get_pegawai_data()
    {
        return $this->db->table('tbl_user')
            ->where('id_seksyen', 'OK')
            ->where('id_bahagian', 8)
            ->where('level', 5)
            ->where('status_user', 1)
            ->orderBy('id_user', 'DESC')
            ->get()->getResultArray();
    }
    
    public function get_pptm_ok()
    {
        return $this->db->table('tbl_user')
            ->where('id_seksyen', 'OK')
            ->where('id_bahagian', 8)
            ->where('level', 6)
            ->where('status_user', 1)
            ->orderBy('id_user', 'DESC')
            ->get()->getResultArray();
    }

    public function get_pptm_()
    {
        return $this->db->table('tbl_user')->orderBy('id_user', 'DESC')->get()->getResultArray();
    }

    public function get_psu($id_seksyen)
    {
       return $this->db->table('tbl_user')->where('id_seksyen', $id_seksyen)->where('level', 5)->get()->getResultArray();
    }

    public function get_pptm_list($id_seksyen)
    {
       return $this->db->table('tbl_user')->where('id_seksyen', $id_seksyen)->where('level', 6)->get()->getResultArray();
    }

    public function get_kpsu()
    {
        return $this->db->table('tbl_user')->orderBy('id_user', 'DESC')->get()->getResultArray();
    }

    // --- FUNGSI CUSTOM ---

    function carian_pengguna($nama_penuh, $email)
    {
        $builder = $this->db->table('tbl_user');
        $builder->orderBy('id_user', 'DESC'); 

        if ($nama_penuh || $email) {
            if ($nama_penuh) {
                $builder->like('nama_penuh', $nama_penuh, 'both'); 
            }
            if ($email) {
                $builder->like('email', $email, 'both'); 
            }
            $builder->limit(200); 
        } else {
            $builder->limit(200);
        }
        return $builder->get()->getResultArray();
    }

    public function check_email_exists($email)
    {
        return $this->where('email', $email)->first();
    }

    // NOTA: Fungsi add_user, update_user, delete_user di bawah ini
    // adalah 'Manual Query Builder'.
    // TETAPI, untuk Reset Password tadi, kita guna standard '$model->update()'
    // yang bergantung pada $allowedFields di atas.
    
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