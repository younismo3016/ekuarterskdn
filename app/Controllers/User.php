<?php

namespace App\Controllers;
use CodeIgniter\Model;
use App\Models\Model_User;
//use App\Controllers\BaseController;



class User extends BaseController
{
	public function __construct()
	{
		helper('form');
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

	public function add_user()
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

	public function edit_user($id_user)
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