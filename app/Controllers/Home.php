<?php

namespace App\Controllers;

use App\Models\LaporanModel;
use App\Models\Model_ChangeReq;

class Home extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_ChangeReq = new Model_ChangeReq();
		

		
	}
	
	public function index()
	{
		// Instantiate model
		$Model_ChangeReq = new Model_ChangeReq();
		

		// Contoh pengambilan data dari session atau set secara manual
		$level = session()->get('level');
		$id_user = session()->get('id_user');
		$id_bahagian = session()->get('id_bahagian');
		$id_seksyen = session()->get('id_seksyen');
		
		$data = [
			'title' => 'Dashboard',
			'isi' => 'v_halaman',
			'list1' => $Model_ChangeReq->getSummaryByLevel($level, $id_user, $id_bahagian, $id_seksyen),
			//'list1' => $this->Model_ChangeReq->getSummaryByLevel($level, $id, $id_bahagian, $id_syeksen),
		
			
		];
		
		

		return view('layout/v_wrapper', $data);
	}

	function laporan_keseluruhan($tahun_keseluruhan)
	{

		$laporan_model = new LaporanModel();

		$laporan_data = $laporan_model->laporan_keseluruhan($tahun_keseluruhan);

		return $laporan_data;
	}

	function laporan_mengikut_bulan($tahun_bulanan)
	{

		$laporan_model = new LaporanModel();

		$laporan_data = $laporan_model->laporan_mengikut_bulan($tahun_bulanan);

		$default_months = [
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July',
			'August',
			'September',
			'October',
			'November',
			'December',
		];

		$data_by_month = [];

		foreach ($default_months as $month) {
			$data_by_month[$month] = [
				'bulan_sebenar' => $month,
				'DalamTindakan' => 0,
				'RayuanBaru' => 0,
				'TidakLengkap' => 0,
				'Sabah' => 0,
				'jumlah_daftar' => 0,
			];
		}

		foreach ($laporan_data as $row) {
			$month = $row->bulan_sebenar;
			$DalamTindakan = $row->DalamTindakan;
			$RayuanBaru = $row->RayuanBaru;
			$TidakLengkap = $row->TidakLengkap;
			$Sabah = $row->Sabah;
			$jumlah_daftar = $row->jumlah_daftar;

			$data_by_month[$month] = [
				'bulan_sebenar' => $month,
				'DalamTindakan' => $DalamTindakan,
				'RayuanBaru' => $RayuanBaru,
				'TidakLengkap' => $TidakLengkap,
				'Sabah' => $Sabah,
				'jumlah_daftar' => $jumlah_daftar,
			];
		}

		$DalamTindakan_array = [];
		$RayuanBaru_array = [];
		$TidakLengkap_array = [];
		$Sabah_array = [];
		$jumlah_daftar_array = [];

		foreach ($data_by_month as $row) {
			$DalamTindakan_array[] = $row['DalamTindakan'];
			$RayuanBaru_array[] = $row['RayuanBaru'];
			$TidakLengkap_array[] = $row['TidakLengkap'];
			$Sabah_array[] = $row['Sabah'];
			$jumlah_daftar_array[] = $row['jumlah_daftar'];
		}



		// var_dump($data_by_month);
		// var_dump($DalamTindakan_array);
		// var_dump($jumlah_daftar_array);
		// exit;

		$result = [
			'labels' => $default_months,
			'DalamTindakan_array' => $DalamTindakan_array,
			'RayuanBaru_array' => $RayuanBaru_array,
			'TidakLengkap_array' => $TidakLengkap_array,
			'Sabah_array' => $Sabah_array,
			'jumlah_daftar_array' => $jumlah_daftar_array,
		];

		return $result;
	}
}
