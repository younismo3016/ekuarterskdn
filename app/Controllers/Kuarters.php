<?php

namespace App\Controllers;
use CodeIgniter\Model;
use App\Models\Model_User;
use App\Models\Model_Kuarters;
use App\Models\Model_Agensi;
use App\Models\Model_Sub_Agensi;
use App\Models\Model_Level;
use App\Models\Model_State;
use App\Models\Model_District;


//use App\Controllers\BaseController;



class Kuarters extends BaseController
{
	public function __construct() 
	{
		helper('form');
		$this->Model_User = new Model_User();
		$this->Model_Kuarters = new Model_Kuarters();
		$this->Model_Agensi = new Model_Agensi();
		$this->Model_Sub_Agensi = new Model_Sub_Agensi();
		$this->Model_Level = new Model_Level();
		$this->Model_User = new Model_User();
		$this->Model_State = new Model_State();
		$this->Model_District = new Model_District();
	}
	public function index()
	{
		$data = array(
			'title' => 'Halaman User', 
			'isi' => 'admin/v_edit_user'
			
			
		);
		return view('layout/v_wrapper',$data);
	}

	public function list_kuarters()
{
    // 1. Ambil data carian (Lebih kemas guna getVar)
    $nama_kuarters = $this->request->getVar('nama_kuarters');
    $kod_kuarters  = $this->request->getVar('kod_kuarters');
	$id_negeri     = $this->request->getVar('id_negeri');
    // 2. Panggil Model untuk siapkan query (tapi belum execute)
    $this->Model_Kuarters->list_kuarters($nama_kuarters, $kod_kuarters, $id_negeri);

    $data = [
        'title'           => 'Kuarters Pengguna',
        'isi'             => 'kuarters/v_list_kuarters',
        
        // --- INI BAHAGIAN PENTING ---
        // paginate(10) akan auto set Limit 10 dan Offset ikut page
        'list_kuarters'   => $this->Model_Kuarters->paginate(10), 
        
        // 'pager' menyimpan link navigasi (1, 2, Next, Prev)
        'pager'           => $this->Model_Kuarters->pager,
        
        // Data sokongan lain (Dropdown filter dll)
        'list_agensi'     => $this->Model_Agensi->get_all_data(),
        'list_sub_agensi' => $this->Model_Sub_Agensi->get_all_data(),
        'list_state'      => $this->Model_State->get_all_data(),
        'list_district'   => $this->Model_District->get_all_data(),
        
        // Hantar balik input carian supaya tak hilang lepas search
        'carian_nama'     => $nama_kuarters,
        'carian_kod'      => $kod_kuarters,
    ];

    return view('layout/v_wrapper', $data);
}

	public function add_kuarters()
	{
		$data = [
			'nama_penuh' => $this->request->getPost('nama_penuh'),
			'email' => $this->request->getPost('email'),
			'no_tel' => $this->request->getPost('no_tel'),
			'password' =>md5($this->request->getPost('password')),
			'level' => $this->request->getPost('level'),
			'id_bahagian' => $this->request->getPost('id_bahagian'),

		];
		$this->Model_User->add_user($data);
		session()->setFlashdata('pesan', 'Data Berjaya Ditambah');
		return redirect()->to(base_url('Admin/list_user'));
	} 

	public function edit_kuarters($id_user)
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

	public function edit_kuarters_proses($id_kuarters)
	{
		$data = [
			'id_agensi_induk' => $this->request->getPost('id_agensi_induk'),
			'kod_kuarters' => $this->request->getPost('kod_kuarters'),
			'nama_kuarters' => $this->request->getPost('nama_kuarters'),
			'jenis_kuarters' => $this->request->getPost('jenis_kuarters'),
			'tahun_siap' => $this->request->getPost('tahun_siap'),
			'id_sub_agensi' => $this->request->getPost('id_sub_agensi'),
			'id_negeri' => $this->request->getPost('id_negeri'),
			'id_daerah' => $this->request->getPost('id_daerah'),
		];
		$this->Model_Kuarters->update_kuarters($data, $id_kuarters);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(site_url('kuarters/list_kuarters'));
	}

	public function edit_user_proses($id_user)
	{
		$data = [
			'nama_penuh' => $this->request->getPost('nama_penuh'),
			'email' => $this->request->getPost('email'),
			'no_tel' => $this->request->getPost('no_tel'),
			'password' =>md5($this->request->getPost('password')),
			'level' => $this->request->getPost('level'),
			'id_bahagian' => $this->request->getPost('id_bahagian'),

		];
		$this->Model_User->update_user($data, $id_user);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(base_url('Admin/list_user'));
	}
}