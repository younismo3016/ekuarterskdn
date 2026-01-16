<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;
use App\Models\Model_User;
use App\Models\Model_Bahagian;
use App\Models\Model_Seksyen;
use App\Models\Model_Level;

class Admin extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_User = new Model_User();
		$this->Model_Bahagian = new Model_Bahagian();
		$this->Model_Seksyen = new Model_Seksyen();
		$this->Model_Level = new Model_Level();

		
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
			///'list_bahagian' => $this->Model_Bahagian->get_all_data(),
			//'list_seksyen' => $this->Model_Seksyen->get_all_data(),
			//'list_level' => $this->Model_Level->get_all_data(),

			'pengguna' => $this->Model_User->carian_pengguna($nama_penuh, $email),
			//'pengguna' => $this->Model_User->get_all_data(),

		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
	}

	public function add_user()
	{
		$data = [
			'nama_penuh' => $this->request->getPost('nama_penuh'),
			'email' => $this->request->getPost('email'),
			'no_tel' => $this->request->getPost('no_tel'),
			'id_bahagian' => $this->request->getPost('id_bahagian'),
			//'id_seksyen' => $this->request->getPost('id_seksyen'),
			'password' =>md5($this->request->getPost('password')),
			'level' => $this->request->getPost('level'),

		];
		$this->Model_User->add_user($data);
		session()->setFlashdata('pesan', 'Data Berjaya Ditambahsssss');
		return redirect()->to(base_url('Admin/list_user'));
	}

	public function edit_user($id_user)
	{
		$data = [
			'nama_penuh' => $this->request->getPost('nama_penuh'),
			'email' => $this->request->getPost('email'),
			'no_tel' => $this->request->getPost('no_tel'),
			'id_bahagian' => $this->request->getPost('id_bahagian'),
			'id_seksyen' => $this->request->getPost('id_seksyen'),
			//'password' =>md5($this->request->getPost('password')),
			'level' => $this->request->getPost('level'),

		];
		$this->Model_User->update_user($data, $id_user);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(base_url('Admin/list_user'));
	}

	public function edit_password($id_user)
	{
		$data = [
			
			'password' =>md5($this->request->getPost('password')),
			

		];
		$this->Model_User->update_user($data, $id_user);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(base_url('Admin/list_user'));
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
		return redirect()->to(base_url('Admin/list_user'));
	}

	

}
