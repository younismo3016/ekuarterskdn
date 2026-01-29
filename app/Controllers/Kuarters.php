<?php

namespace App\Controllers;
use CodeIgniter\Model;
use App\Models\Model_User;
use App\Models\Model_Kuarters;
use App\Models\Model_Agensi;
use App\Models\Model_Sub_Agensi;
use App\Models\Model_Level;


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

		if ($this->request->getPost('nama_kuarters') !== "") {
			$nama_kuarters = $this->request->getPost('nama_kuarters');
		} else {
			$nama_kuarters = "";
		}

		if ($this->request->getPost('kod_kuarters') !== "") {
			$kod_kuarters = $this->request->getPost('kod_kuarters');
		} else {
			$kod_kuarters = "";
		}
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
			'title' => 'Kuarters Pengguna',
			'isi' => 'kuarters/v_list_kuarters',
			'list_agensi' => $this->Model_Agensi->get_all_data(),
			'list_sub_agensi' => $this->Model_Sub_Agensi->get_all_data(),
			'list_kuarters' => $this->Model_Kuarters->list_kuarters($nama_kuarters, $kod_kuarters),
			'kuarters' => $this->Model_Kuarters->kuarters($nama_kuarters, $kod_kuarters),
			//'pengguna' => $this->Model_User->get_all_data(),

		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
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