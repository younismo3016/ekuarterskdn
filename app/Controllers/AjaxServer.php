<?php

namespace App\Controllers;

use App\Models\Model_Server;

class AjaxServer extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_Server = new Model_Server();
	}
	
	public function index()
	{
		$data = array(
			'title' => 'Halaman Admin', 
			'isi' => 'v_halaman'
		);
		return view('layout/v_wrapper',$data);
	}
	
	public function list_server()
	{
		$data = [
			'title' => 'Halaman Admin', 
			'isi' => 'admin/v_list_server',
			'server' => $this->Model_Server->get_all_data(),

		];
		return view('layout/v_wrapper',$data);
		//return view('admin/v_list_user',$data);
	}

	public function add_user()
	{
		$data = [
			'name_user' => $this->request->getPost('name_user'), 
			'email' => $this->request->getPost('email'),
			'no_hp' => $this->request->getPost('no_hp'),
			'password' => $this->request->getPost('password'),
			'level' => $this->request->getPost('level'),

		];
		$this->Model_User->add_user($data);
		session()->setFlashdata('pesan', 'Data Berjaya Ditambah');
		return redirect()->to(base_url('Admin/list_user'));

	}

	public function edit_user($id_user)
	{
		$data = [
			'name_user' => $this->request->getPost('name_user'), 
			'email' => $this->request->getPost('email'),
			'no_hp' => $this->request->getPost('no_hp'),
			'password' => $this->request->getPost('password'),
			'level' => $this->request->getPost('level'),

		];
		$this->Model_User->update_user($data, $id_user);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(base_url('Admin/list_user'));

	}

	public function hapus_user($id_user)
	{
		$this->Model_User->delete_user($id_user);
		session()->setFlashdata('hapus', 'Data Berjaya Hapus');
		return redirect()->to(base_url('Admin/list_user'));

	}

}