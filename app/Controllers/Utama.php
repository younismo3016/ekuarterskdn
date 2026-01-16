<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;

use App\Models\Model_Utama;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Utama extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_Utama = new Model_Utama();

		
	}

	public function index()
	{
		$data = array(
			'title' => 'Halaman Admin',
			'isi' => 'v_halaman'
		);
		return view('layout/v_wrapper', $data);
	}

	public function utama()
	{

		// if ($this->request->getPost('perkara') !== "") {
		// 	$perkara = $this->request->getPost('perkara');
		// } else {
		// 	$perkara = "";
		// }

		// if ($this->request->getPost('kotak') !== "") {
		// 	$kotak = $this->request->getPost('kotak');
		// } else {
		// 	$kotak = "";
		// }

		// if ($this->request->getPost('lokasi') !== "") {
		// 	$lokasi = $this->request->getPost('lokasi');
		// } else {
		// 	$lokasi = "";
		// }

		// if ($this->request->getPost('bil_lampiran') !== "") {
		// 	$bil_lampiran = $this->request->getPost('bil_lampiran');
		// } else {
		// 	$bil_lampiran = "";
		// }

		// if ($this->request->getPost('no_fail') !== "") {
		// 	$no_fail = $this->request->getPost('no_fail');
		// } else {
		// 	$no_fail = "";
		// }




		$data = [

			'isi' => 'utama/v_utama',
			//'list_cr' => $this->Model_ChangeReq->get_all_data(),
			//'list_seksyen' => $this->Model_Seksyen->get_all_data(),

			'list_cr' => $this->Model_Utama->dashboard(),
			//'pengguna' => $this->Model_User->get_all_data(),

		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
	}


	



	

	

}
