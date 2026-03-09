<?php

namespace App\Controllers;

use App\Models\Model_Agensi_User;

class Agensi_User extends BaseController
{
    protected $userModel;

    public function __construct() {
        $this->userModel = new Model_Agensi_User();
    }

    public function agensi_user_list()
{
    $db = \Config\Database::connect();
    
    // 1. Ambil ID Agensi dari Session
    $idAgensiInduk = session()->get('id_agensi_induk');

    $search = $this->request->getVar('search') ?? '';
    $currentPage = $this->request->getVar('page') ?? 1;
    $perPage = 10;

    // 2. Filter berdasarkan Agensi Induk (WAJIB)
    $this->userModel->where('id_agensi_induk', $idAgensiInduk);

    // 3. Filter Search (Jika ada)
    if ($search) {
    $this->userModel->groupStart() // Guna groupStart supaya 'like' tidak kacau filter agensi tadi
                    ->like('nama_penuh', $search)
                    ->orLike('name_user', $search)
                    ->orLike('email', $search)      // Tambah filter email
                    ->orLike('no_tel', $search)     // Tambah filter no_tel
                    ->groupEnd();
}

    // Ambil data peranan (Hanya ID 2 dan 3)
    $list_peranan = $db->table('tbl_peranan')
        ->select('id_peranan, peranan')
        ->whereIn('id_peranan', [2, 3])
        ->get()
        ->getResultArray();

    $data = [
        'title'         => 'Senarai Pengguna Agensi',
        'list_peranan'  => $list_peranan,
        'senarai_user'  => $this->userModel->paginate($perPage, 'default', $currentPage),
        'pager'         => $this->userModel->pager,
        'isi'           => 'agensi/agensi_user_list',
        'currentPage'   => $currentPage,
        'totalPages'    => $this->userModel->pager->getPageCount(),
        'search'        => $search,
        'states'        => [], 
        'all_classes'   => []
    ];

    return view('layout/v_wrapper', $data);
}

   public function simpan()
{
    // 1. Tetapkan Peraturan Validasi (Validation Rules)
    $rules = [
        'email' => [
            'rules'  => 'required|valid_email|is_unique[tbl_user.email]',
            'errors' => [
                'required'    => 'Alamat emel wajib diisi.',
                'valid_email' => 'Sila masukkan format emel yang sah.',
                'is_unique'   => 'Emel ini telah pun didaftarkan dalam sistem.'
            ]
        ],
        'nama_penuh' => 'required|min_length[3]',
        'id_peranan' => 'required'
    ];

    // 2. Jalankan Semakan Validasi
    if (!$this->validate($rules)) {
        $errorMsg = $this->validator->getError('email') ?: 'Sila semak maklumat yang dimasukkan.';
        return redirect()->back()->withInput()->with('error', $errorMsg);
    }

    // 3. Jana Kata Laluan Plain (Teks Biasa) untuk Emel
    $plain_password = substr(str_shuffle(
        'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%&*'
    ), 0, 12);

    // 4. Sediakan Data untuk Simpan
    $idAgensiInduk = session()->get('id_agensi_induk');

    $data = [
      
        'nama_penuh'      => $this->request->getPost('nama_penuh'),
        'email'           => $this->request->getPost('email'),
        'no_tel'          => $this->request->getPost('no_tel'),
        'level'           => $this->request->getPost('id_peranan'),
        'id_agensi_induk' => $idAgensiInduk,
        // HASH dilakukan di sini. Pastikan column DB adalah VARCHAR(255)
        'password'        => password_hash($plain_password, PASSWORD_DEFAULT),
    ];

    // 5. Proses Simpan dan Hantar Emel
    if ($this->userModel->insert($data)) {
        
        // PENTING: Hantar $plain_password ke emel, BUKAN yang sudah di-hash
        if ($this->_sendEmail($data['email'], $data['nama_penuh'], $plain_password)) {
            return redirect()->back()->with('success', 'Pengguna didaftarkan dan emel maklumat akaun telah dihantar.');
        } else {
            // Jika emel gagal, admin masih boleh tahu password yang dijana untuk diberikan secara manual
            return redirect()->back()->with('error', 'Rekod disimpan, tetapi EMEL GAGAL DIHANTAR. Sila semak konfigurasi SMTP anda.');
        }

    } else {
        return redirect()->back()->with('error', 'Gagal menyimpan maklumat ke dalam pangkalan data.');
    }
}



private function _sendEmail($to, $name, $password)
{
    $email = \Config\Services::email();
    
    // Gunakan konfigurasi pengirim yang sah
    $email->setFrom('noreply@moha.gov.my', 'Sistem eKuarters KDN');
    $email->setTo($to);
    $email->setSubject('Sistem eKuarters KDN: Pendaftaran Akaun Pengguna');
    
    // Template ayat rasmi seperti yang diminta
    $message = "
        <html>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <p>Tuan/Puan,</p>
            <p>Adalah dimaklumkan bahawa kata laluan tuan/puan bagi <b>Sistem eKuarters KDN</b> telah berjaya didaftarkan. Tuan/Puan kini boleh mengakses sistem tersebut dengan maklumat log masuk berikut:</p>
            
            <table style='margin-left: 20px; border-collapse: collapse;'>
                <tr>
                    <td style='padding: 5px 0;'><b>URL</b></td>
                    <td style='padding: 5px 10px;'>: <a href='https://ekuarters.moha.gov.my' target='_blank'>ekuarters.moha.gov.my</a></td>
                </tr>
                <tr>
                    <td style='padding: 5px 0;'><b>E-mel</b></td>
                    <td style='padding: 5px 10px;'>: $to</td>
                </tr>
                <tr>
                    <td style='padding: 5px 0;'><b>Kata Laluan</b></td>
                    <td style='padding: 5px 10px;'>: <code style='background: #f4f4f4; padding: 2px 5px; border: 1px solid #ddd; font-size: 1.1em;'>$password</code></td>
                </tr>
            </table>
            
            <p>Tuan/Puan dimohon untuk menukar kata laluan segera selepas log masuk.</p>
            
            <p>Sekian, terima kasih.<br><br>
            <b>Sistem eKuarters KDN</b></p>
            
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <small style='color: #888;'>Ini adalah emel janaan sistem secara automatik. Sila jangan balas emel ini.</small>
        </body>
        </html>
    ";
    
    $email->setMessage($message);
    $email->setMailType('html');

    if ($email->send()) {
        return true;
    } else {
        // Simpan log ralat jika penghantaran gagal
        log_message('error', 'Gagal hantar emel reset ke ' . $to . ': ' . $email->printDebugger(['headers']));
        return false;
    }
}

public function hantar_reset($id)
{
    $db = \Config\Database::connect();
    
    // 1. Guna table 'tbl_user'
    $builder = $db->table('tbl_user'); 

    // 2. Cari data user
    $user = $builder->where('id_user', $id)->get()->getRowArray();

    if ($user) {
        // Jana password rawak
        $plain_password = substr(str_shuffle('abcdefghijkmnopqrstuvwxyz23456789'), 0, 12);
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // 3. Update password dalam 'tbl_user'
        $update = $db->table('tbl_user')
                     ->where('id_user', $id)
                     ->update(['password' => $hashed_password]);

        if ($update) {
            // --- KEMASKINI DI SINI ---
            // Kita panggil fungsi _sendEmail yang anda sudah buat sebelum ini
            $hantar = $this->_sendEmailReset($user['email'], $user['nama_penuh'], $plain_password);

            if ($hantar) {
                return redirect()->to(base_url('index.php/agensi/agensi_user_list'))
                                 ->with('success', 'Password berjaya di-reset & emel dihantar!');
            } else {
                // Jika emel gagal, kita masih beri password kepada admin untuk rujukan manual
                return redirect()->to(base_url('index.php/agensi/agensi_user_list'))
                                 ->with('success', "Data dikemaskini, tapi EMEL GAGAL. Password baru: <b>$plain_password</b>");
            }
            // --- TAMAT KEMASKINI ---
            
        } else {
            return redirect()->to(base_url('index.php/agensi/agensi_user_list'))
                             ->with('error', 'Gagal update tbl_user.');
        }
    } else {
        return redirect()->to(base_url('index.php/agensi/agensi_user_list'))
                         ->with('error', 'User ID tidak wujud dalam tbl_user.');
    }
}


private function _sendEmailReset($to, $name, $password)
{
    $email = \Config\Services::email();
    
    // Gunakan konfigurasi pengirim yang sah
    $email->setFrom('noreply@moha.gov.my', 'Sistem eKuarters KDN');
    $email->setTo($to);
    $email->setSubject('Sistem eKuarters KDN: Reset Kata Laluan');
    
    // Template ayat rasmi seperti yang diminta
    $message = "
        <html>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <p>Tuan/Puan,</p>
            <p>Adalah dimaklumkan bahawa kata laluan tuan/puan bagi <b>Sistem eKuarters KDN</b> telah berjaya direset. Tuan/Puan kini boleh mengakses sistem tersebut dengan maklumat log masuk berikut:</p>
            
            <table style='margin-left: 20px; border-collapse: collapse;'>
                <tr>
                    <td style='padding: 5px 0;'><b>URL</b></td>
                    <td style='padding: 5px 10px;'>: <a href='https://ekuarters.moha.gov.my' target='_blank'>ekuarters.moha.gov.my</a></td>
                </tr>
                <tr>
                    <td style='padding: 5px 0;'><b>E-mel</b></td>
                    <td style='padding: 5px 10px;'>: $to</td>
                </tr>
                <tr>
                    <td style='padding: 5px 0;'><b>Kata Laluan</b></td>
                    <td style='padding: 5px 10px;'>: <code style='background: #f4f4f4; padding: 2px 5px; border: 1px solid #ddd; font-size: 1.1em;'>$password</code></td>
                </tr>
            </table>
            
            <p>Tuan/Puan dimohon untuk menukar kata laluan segera selepas log masuk.</p>
            
            <p>Sekian, terima kasih.<br><br>
            <b>Sistem eKuarters KDN</b></p>
            
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <small style='color: #888;'>Ini adalah emel janaan sistem secara automatik. Sila jangan balas emel ini.</small>
        </body>
        </html>
    ";
    
    $email->setMessage($message);
    $email->setMailType('html');

    if ($email->send()) {
        return true;
    } else {
        // Simpan log ralat jika penghantaran gagal
        log_message('error', 'Gagal hantar emel reset ke ' . $to . ': ' . $email->printDebugger(['headers']));
        return false;
    }
}



public function kemaskini($id_user)
{
    $db = \Config\Database::connect();
    $builder = $db->table('tbl_user');

    $email_baru = $this->request->getPost('email');

    // 1. SEMAKAN REDUNDANT (Duplicate Email)
    // Cari user LAIN yang guna email ini, tapi bukan user yang tengah di-edit sekarang
    $existingUser = $builder->where('email', $email_baru)
                            ->where('id_user !=', $id_user)
                            ->get()
                            ->getRow();

    if ($existingUser) {
        // Jika emel sudah wujud di akaun orang lain
        return redirect()->back()->with('error', "Ralat: Emel <b>$email_baru</b> telah digunakan oleh pengguna lain!");
    }

    // 2. JIKA TIADA DUPLICATE, TERUSKAN UPDATE
    $data = [
        'nama_penuh' => $this->request->getPost('nama_penuh'),
        'email'      => $email_baru,
        'no_tel'     => $this->request->getPost('no_tel'),
        'level' => $this->request->getPost('id_peranan'),
    ];

    $update = $builder->where('id_user', $id_user)->update($data);

    if ($update) {
        return redirect()->to(base_url('index.php/agensi/agensi_user_list'))
                         ->with('success', 'Maklumat pengguna berjaya dikemaskini!');
    } else {
        return redirect()->back()->with('error', 'Gagal mengemaskini maklumat.');
    }
}

}//LAST