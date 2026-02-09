<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;
use App\Models\Model_User;
use App\Models\Model_Bahagian;
// use App\Models\Model_Seksyen;
use App\Models\Model_Level;
use App\Models\Model_Agensi;
use App\Models\Model_Sub_Agensi;
use App\Models\SubAgensiModel;

class Admin extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_User = new Model_User();
		$this->Model_Bahagian = new Model_Bahagian();
		//$this->Model_Seksyen = new Model_Seksyen();
		$this->Model_Level = new Model_Level();
		$this->Model_Agensi = new Model_Agensi();
		$this->Model_Sub_Agensi = new Model_Sub_Agensi();
		$this->SubAgensiModel = new SubAgensiModel();

		
	}

	public function index()
	{
		$data = array(
			'title' => 'Halaman Admin',
			'isi' => 'v_halaman'
		);
		return view('layout/v_wrapper', $data);
	}

	public function landing()
	{
		$data = array(
			'title' => 'Halaman Admin',
			'isi' => 'landing'
		);
		return view('layout/v_landing', $data);
	}


	//Admin List User===============================================================================


	public function list_user()
	{

		if ($this->request->getPost('nama_penuh') !== "") {
			$nama_penuh = $this->request->getPost('nama_penuh');
		} else {
			$nama_penuh = "";
		}

		if ($this->request->getPost('email') !== "") {
			$email = $this->request->getPost('email');
		} else {
			$email = "";
		}


		
		$data = [
			'title' => 'Halaman Admin Pengguna',
			'isi' => 'admin/v_list_user',
			'list_agensi' => $this->Model_Agensi->get_all_data(),
			'list_sub_agensi' => $this->Model_Sub_Agensi->get_all_data(),
			'list_level' => $this->Model_Level->get_all_data(),

			'pengguna' => $this->Model_User->carian_pengguna($nama_penuh, $email),
			//'pengguna' => $this->Model_User->get_all_data(),

		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
	}

		public function get_sub_agensi()
	{
		$id_agensi = $this->request->getPost('id_agensi_induk');
		$subAgensiModel = new \App\Models\SubAgensiModel();
		$subAgensi = $subAgensiModel->where('id_agensi_induk', $id_agensi)->findAll();

		return $this->response->setJSON($subAgensi);
	}

	public function add_user()
{
    $email_user = $this->request->getPost('email');
    $nama_user  = $this->request->getPost('nama_penuh');

    // 1. CHECK EMAIL WUJUD ATAU TIDAK
    $check = $this->Model_User->check_email_exists($email_user);

    if ($check) {
        session()->setFlashdata('pesan', 'Email telah wujud dalam sistem. Sila guna email lain.');
        return redirect()->back()->withInput();
    }

    // 2. Generate password rawak
    $plain_password = substr(str_shuffle(
    'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%&*'
), 0, 12);

    $data = [
        'nama_penuh'      => $nama_user,
        'email'           => $email_user,
        'no_tel'          => $this->request->getPost('no_tel'),
        'id_agensi_induk' => $this->request->getPost('id_agensi_induk'),
        'id_sub_agensi'   => $this->request->getPost('id_sub_agensi'),
        'password'        => password_hash($plain_password, PASSWORD_DEFAULT),
        'level'           => $this->request->getPost('level'),
    ];

    // 3. Simpan Database
    $this->Model_User->add_user($data);

    // 4. Hantar Email Password
    $this->send_email_password($email_user, $plain_password);

    session()->setFlashdata('pesan', 'Data berjaya ditambah. Kata laluan telah dihantar ke emel.');
    return redirect()->to(site_url('Admin/list_user'));
}

	private function send_email_password($to, $password)
{
    $email = \Config\Services::email();

    $email->setTo($to);
    $email->setFrom('noreply@moha.gov.my', 'Pentadbir Sistem');
    
    $email->setSubject('Sistem eKuarters KDN: Pendaftaran Akaun Pengguna');
    $message = "
    <html>
    <body style='font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; color: #333;'>
        <p><strong>Sistem eKuarters KDN: Pendaftaran Akaun Pengguna</strong></p>
        <br>
        <p>Tuan/Puan,</p>
        
        <p>Adalah dimaklumkan bahawa akaun tuan/puan bagi Sistem eKuarters KDN telah berjaya didaftarkan. Tuan/Puan kini boleh mengakses sistem tersebut dengan maklumat log masuk berikut:</p>
        
        <table border='0' cellpadding='5' style='margin-left: 20px;'>
            <tr>
                <td width='100'><strong>URL</strong></td>
                <td>: <a href='https://ekuarters.moha.gov.my' target='_blank'>ekuarters.moha.gov.my</a></td>
            </tr>
            <tr>
                <td><strong>E-mel</strong></td>
                <td>: $to</td>
            </tr>
            <tr>
                <td><strong>Kata Laluan</strong></td>
                <td>: <strong>$password</strong></td>
            </tr>
        </table>

        <p>Tuan/Puan dimohon untuk menukar kata laluan selepas log masuk buat kali pertama.</p>
        
        <br>
        <p>Sekian, terima kasih.</p>
        
        <p><strong>Sistem eKuarters KDN</strong></p>
    </body>
    </html>
";

    $email->setMessage($message);

    if ($email->send()) {
        return true;
    } else {
        // Log ralat jika perlu
        return false;
    }
	}

	public function reset_password($id_user)
{
    // 1. Panggil Model User
    $model = new \App\Models\Model_User();
    
    // Cari pengguna berdasarkan id_user
    $user = $model->find($id_user);

    if ($user) {
        // 2. Jana Kata Laluan Baru (12 Aksara: Huruf + Nombor + Simbol)
        $plain_password = substr(str_shuffle(
    'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%&*'
), 0, 12);

        // 3. Update Database
        // PENTING: Pastikan 'allowedFields' di Model anda membenarkan update 'password'
        
        // Pilihan A: Jika sistem guna password_hash (Disyorkan)
        $password_encrypted = password_hash($plain_password, PASSWORD_DEFAULT);
        
        // Pilihan B: Jika sistem lama guna MD5 (Sila komen atas, guna bawah jika perlu)
        // $password_encrypted = md5($plain_password);

        $data_update = [
            'password' => $password_encrypted
        ];
        
        // Kita guna update() supaya lebih spesifik update row berdasarkan ID
        $model->update($id_user, $data_update);

        // 4. Panggil Fungsi Hantar Emel (Private Function)
        // Hantar password yang belum encrypt ($plain_password) ke emel pengguna
        $status_email = $this->send_email_reset_password($user['email'], $plain_password);

        if ($status_email) {
            session()->setFlashdata('pesan', 'Kata laluan berjaya direset dan dihantar ke e-mel pengguna.');
        } else {
            session()->setFlashdata('error', 'Kata laluan direset tetapi GAGAL menghantar e-mel.');
        }

    } else {
        session()->setFlashdata('error', 'Pengguna tidak dijumpai.');
    }

    // 5. Redirect ke List User
    return redirect()->to(base_url('admin/list_user')); 
}

private function send_email_reset_password($to, $password)
{
    // 1. Panggil Servis Emel CodeIgniter
    $email = \Config\Services::email();

    // 2. Tetapan Pengirim dan Penerima
    $email->setTo($to);
    // Pastikan emel 'from' ini valid atau guna no-reply domain anda
    $email->setFrom('noreply@moha.gov.my', 'Pentadbir Sistem eKuarters'); 
    
    // 3. Subjek Emel
    $email->setSubject('Sistem eKuarters KDN: Reset Kata Laluan');

    // 4. Isi Kandungan (HTML)
    $message = "
    <html>
    <body style='font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; color: #333;'>
        <p><strong>Sistem eKuarters KDN: Reset Kata Laluan</strong></p>
        <br>
        <p>Tuan/Puan,</p>
        
        <p>Adalah dimaklumkan bahawa kata laluan tuan/puan bagi Sistem eKuarters KDN telah berjaya direset. Tuan/Puan kini boleh mengakses sistem tersebut dengan maklumat log masuk berikut:</p>
        
        <table border='0' cellpadding='5' style='margin-left: 20px;'>
            <tr>
                <td width='100'><strong>URL</strong></td>
                <td>: <a href='https://ekuarters.moha.gov.my' target='_blank' style='color: #0d6efd; text-decoration: none;'>ekuarters.moha.gov.my</a></td>
            </tr>
            <tr>
                <td><strong>E-mel</strong></td>
                <td>: $to</td>
            </tr>
            <tr>
                <td><strong>Kata Laluan</strong></td>
                <td>: <strong style='color: #dc3545; font-size: 16px;'>$password</strong></td>
            </tr>
        </table>

        <p>Tuan/Puan dimohon untuk menukar kata laluan segera selepas log masuk.</p>
        
        <br>
        <p>Sekian, terima kasih.</p>
        
        <p><strong>Sistem eKuarters KDN</strong></p>
        <hr>
        <p style='font-size: 11px; color: #777;'>Emel ini dijana secara automatik oleh sistem. Sila jangan balas emel ini.</p>
    </body>
    </html>
    ";

    $email->setMessage($message);

    // 5. Hantar Emel
    if ($email->send()) {
        return true;
    } else {
        // Debug: Uncomment baris di bawah jika emel gagal dihantar untuk lihat punca
        // log_message('error', $email->printDebugger(['headers']));
        return false;
    }
}




	public function edit_user($id_user)
	{
		$data = [
			'nama_penuh' => $this->request->getPost('nama_penuh'),
			'email' => $this->request->getPost('email'),
			'no_tel' => $this->request->getPost('no_tel'),
			'level' => $this->request->getPost('level'),
			'id_agensi_induk' => $this->request->getPost('id_agensi_induk'),

		];
		$this->Model_User->update_user($data, $id_user);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(site_url('Admin/list_user'));
	}

	public function edit_password($id_user)
	{
		$data = [
			
			'password' =>md5($this->request->getPost('password')),
			

		];
		$this->Model_User->update_user($data, $id_user);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(site_url('Admin/list_user'));
		
	}

	public function edit_pengguna($id_user)
	{

			$data = [
			'title' => 'Kemaskini Pengguna',
			'isi' => 'admin/v_edit_user',
			'pengguna' => $this->Model_User->get_user($id_user),
			//'list_kategori_surat' => $this->Model_Kategori_Surat->get_all_data(),


		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
	}

	public function hapus_user($id_user)
	{
		$this->Model_User->delete_user($id_user);
		session()->setFlashdata('hapus', 'Data Berjaya Hapus');
		return redirect()->to(site_url('Admin/list_user'));
	}

	

}
