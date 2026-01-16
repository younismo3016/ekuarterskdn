<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;
use App\Models\Model_User;
use App\Models\Model_Bahagian;
use App\Models\Model_Seksyen;
use App\Models\Model_Level;
use App\Models\Model_Rekod;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Rekod extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_User = new Model_User();
		$this->Model_Bahagian = new Model_Bahagian();
		$this->Model_Seksyen = new Model_Seksyen();
		$this->Model_Level = new Model_Level();
		$this->Model_Rekod = new Model_Rekod();

		
	}

	public function index()
	{
		$data = array(
			'title' => 'Halaman Admin',
			'isi' => 'v_halaman'
		);
		return view('layout/v_wrapper', $data);
	}

	public function senarai_rekod()
	{

		if ($this->request->getPost('perkara') !== "") {
			$perkara = $this->request->getPost('perkara');
		} else {
			$perkara = "";
		}

		if ($this->request->getPost('kotak') !== "") {
			$kotak = $this->request->getPost('kotak');
		} else {
			$kotak = "";
		}

		if ($this->request->getPost('lokasi') !== "") {
			$lokasi = $this->request->getPost('lokasi');
		} else {
			$lokasi = "";
		}

		if ($this->request->getPost('bil_lampiran') !== "") {
			$bil_lampiran = $this->request->getPost('bil_lampiran');
		} else {
			$bil_lampiran = "";
		}

		if ($this->request->getPost('no_fail') !== "") {
			$no_fail = $this->request->getPost('no_fail');
		} else {
			$no_fail = "";
		}




		$data = [

			'isi' => 'senarai_rekod/v_list_rekod',
			//'list_cr' => $this->Model_ChangeReq->get_all_data(),
			//'list_seksyen' => $this->Model_Seksyen->get_all_data(),

			'list_cr' => $this->Model_Rekod->carian_rekod($perkara, $kotak, $lokasi, $bil_lampiran, $no_fail),
			//'pengguna' => $this->Model_User->get_all_data(),

		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
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
			'list_bahagian' => $this->Model_Bahagian->get_all_data(),
			'list_seksyen' => $this->Model_Seksyen->get_all_data(),
			'list_level' => $this->Model_Level->get_all_data(),

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
			'id_seksyen' => $this->request->getPost('id_seksyen'),
			'password' =>md5($this->request->getPost('password')),
			'level' => $this->request->getPost('level'),

		];
		$this->Model_User->add_user($data);
		session()->setFlashdata('pesan', 'Data Berjaya Ditambahsssss');
		return redirect()->to(base_url('Admin/list_user'));
	}

	public function add_rekod()
	{
		$data = [
			'act'   => 'add',
			'title' => 'Tambah Rekod',
			'isi' => 'senarai_rekod/v_add_rekod',
			
			

			

		];
		
		return view('layout/v_wrapper', $data);
	}
	

	public function add_rekod_proses()
	{
		$data = [
			'perkara' => $this->request->getPost('perkara'),
			'no_fail' => $this->request->getPost('no_fail'),
			'kotak' => $this->request->getPost('kotak'),
			'lokasi' => $this->request->getPost('lokasi'),
			'bil_lampiran' => $this->request->getPost('bil_lampiran'),
			'tarikh_daripada' => $this->request->getPost('tarikh_daripada'),
			'tarikh_kepada' => $this->request->getPost('tarikh_kepada'),
			'cipta_oleh' => $this->request->getPost('id_user'),
			'cipta_pada' => date('Y-m-d H:i:s'),
			

		];
		$this->Model_Rekod->add_rekod($data);
		session()->setFlashdata('pesan', 'Data Berjaya Ditambah');
		return redirect()->to(base_url('admin/senarai_rekod'));
	}

	public function upload_rekod_proses()
{
    $fail = $this->request->getFile('fail_excel');

    if (!$fail->isValid()) {
        session()->setFlashdata('pesan', 'Fail tidak sah.');
        return redirect()->back();
    }

    $ext = $fail->getExtension();
    if (!in_array($ext, ['xls','xlsx'])) {
        session()->setFlashdata('pesan', 'Hanya fail Excel dibenarkan.');
        return redirect()->back();
    }

    // Load Excel
    $spreadsheet = IOFactory::load($fail->getTempName());
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    $insertCount = 0;
    $duplicateCount = 0;

    foreach ($rows as $index => $row) {

        // Skip header row
        if ($index == 0) continue;

        // Mapping column Excel → Database
       $data = [
                'no_fail'         => $row[0] ?? '',
				'perkara'         => $row[1] ?? '',
				'tarikh_daripada' => $row[2] ?? '',
                'tarikh_kepada'   => $row[3] ?? '',
				'bil_lampiran'    => $row[4] ?? '',
                'kotak'           => $row[5] ?? '',
                'lokasi'          => $row[6] ?? '',
                'cipta_oleh'      => session()->get('id_user'),
                
            ];

        // Check duplicate based on no_fail
        $exist = $this->Model_Rekod
                    ->where('no_fail', $row[0])
                    ->first();

        if ($exist) {
            $duplicateCount++;
            continue; // Skip insert
        }

        $this->Model_Rekod->add_rekod($data);
        $insertCount++;
    }

    session()->setFlashdata(
        'pesan',
        "Import selesai. Berjaya tambah: $insertCount | Duplikasi: $duplicateCount"
    );

    return redirect()->to(base_url('admin/senarai_rekod'));
}

	public function edit_rekod($id)
	{

			$data = [
			'act'   => 'edit',
			'title' => 'Kemaskini Rekod',
			'isi' => 'senarai_rekod/v_add_rekod',
			'rekod' => $this->Model_Rekod->get_rekod($id),
			//'list_kategori_surat' => $this->Model_Kategori_Surat->get_all_data(),


		];
		
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
	}

	public function edit_rekod_proses()
	{
		$id = $this->request->getPost('id');
		$data = [
			'perkara' => $this->request->getPost('perkara'),
			'no_fail' => $this->request->getPost('no_fail'),
			'kotak' => $this->request->getPost('kotak'),
			'lokasi' => $this->request->getPost('lokasi'),
			'bil_lampiran' => $this->request->getPost('bil_lampiran'),
			'tarikh_daripada' => $this->request->getPost('tarikh_daripada'),
			'tarikh_kepada' => $this->request->getPost('tarikh_kepada'),
			'kemaskini_oleh' => $this->request->getPost('id_user'),
			'kemaskini_pada' => date('Y-m-d H:i:s'),

		];
		$this->Model_Rekod->update_rekod($data, $id);
		session()->setFlashdata('pesan', 'Data Berjaya Diedit');
		return redirect()->to(route_to('senarai_rekod.rekod'));
	
		
	}

	

	

}
