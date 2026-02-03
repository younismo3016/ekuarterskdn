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


		$data = [

			'isi' => 'utama/v_utama',
            'list_agensi' => $this->Model_Utama->get_laporan_agensi(), // Gunakan nama 'list_agensi' supaya sepadan dengan View anda

		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
	}


	



	

	

}
