<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;

use App\Models\Model_Utama;
use App\Models\StatistikAgensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Utama extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_Utama = new Model_Utama();
		$this->StatistikAgensiModel = new StatistikAgensiModel();
		

		
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
            'list_agensi' => $this->Model_Utama->get_laporan_agensi(),
			'list_dashboard' => $this->Model_Utama->get_dashboard(),
			'tarikh_terkini' => $this->Model_Utama->get_last_update_date(), // Gunakan nama 'list_agensi' supaya sepadan dengan View anda

		];
		return view('layout/v_wrapper', $data);
		//return view('admin/v_list_user',$data);
	}

	// Pastikan ini berada dalam Class Controller anda
public function report_bulanan()
{
    // 1. Buang kurungan '{' berlebihan di sini
    //$model = new \App\Models\StatistikAgensiModel(); // Cadangan: Gunakan full namespace jika perlu

    $data = [
        'title'               => 'Statistik Agensi Induk',
        // 'list_statistik'      => $model->getStatistikByAll(1),
		'list_statistik' => $this->Model_Utama->getStatistikByAll(),
        'isi'                 => 'utama/v_report_bulanan',
        'bulan_sekarang'      => (int)date('m'),
        'tahun_sekarang'      => (int)date('Y'),
        // Panggil function helper
        'nama_bulan_sekarang' => $this->getNamaBulan(date('m')) 
    ];

    return view('layout/v_wrapper', $data);
} // 2. Pastikan kurungan penutup ini wujud sebelum function seterusnya bermula

// 3. Function ini mesti berada di luar 'report_bulanan'
private function getNamaBulan($m) 
{
    $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April', 
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos', 
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];
    
    // Pastikan $m ditukar jadi integer supaya "02" menjadi 2
    return $bulan[(int)$m] ?? 'Bulan Tidak Sah'; 
}

public function report_bulanan_papar($bulan, $tahun)
{
    $model = new \App\Models\Model_Utama();
    $id_agensi = session()->get('id_agensi_induk');
    
    // Ambil input dari query string
    $search = $this->request->getVar('q') ?? '';
    $page = $this->request->getVar('page') ?? 1;
    $perPage = 10;
    $offset = ($page - 1) * $perPage;

    $totalRecords = $model->countDetailedReport($bulan, $tahun, $search);
    $reports = $model->getDetailedReportView($bulan, $tahun, $perPage, $offset, $search);

    $senarai_bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];

    $data = [
        'title'        => 'Paparan Statistik Kuarters',
        'isi'          => 'utama/v_report_papar', 
        //'id_agensi'    => $id_agensi,
        'reports'      => $reports,
        'bulan'        => $bulan,
        'tahun'        => $tahun,
        'nama_bulan'   => $senarai_bulan[(int)$bulan] ?? 'Statistik',
        'search'       => $search,
        'currentPage'  => $page,
        'totalPages'   => ceil($totalRecords / $perPage),
        'totalRecords' => $totalRecords,
        'perPage'      => $perPage
    ];

    return view('layout/v_wrapper', $data);
}

public function admin_statistik_papar_excel( $bulan, $tahun)
    {
        $model = new \App\Models\Model_Utama();
        $data = $model->getStatistikByAgensiExcel($bulan, $tahun);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Statistik Kuarters');

        // 1. PENYEDIAAN HEADER
        $headers = [
            'Kod Kuarters', 'Nama Kuarters', 'Kategori Kuarters', 'Jlh Permohonan', 
            'Unit Dihuni', 'Dihuni Baik', 'Dihuni Rosak', 'Jlh Dihuni (Check)', 'Status Dihuni',
            'Jlh Cadangan', 'Status Cadangan', 'Unit Tidak Dihuni', 
            'Baik: Diduduki', 'Baik: Guna Sama', 'Ket: Guna Sama', 'Baik: Tukar Fungsi', 'Ket: Tukar Fungsi', 'Baik: Sewaan', 'Ket: Sewaan',
            'Rosak: Baik Pulih', 'Ket: Baik Pulih', 'Rosak: Guna Sama', 'Ket: Guna Sama', 'Rosak: Tukar Fungsi', 'Ket: Tukar Fungsi', 'Rosak: Sewaan', 'Ket: Sewaan', 'Rosak: Roboh', 'Ket: Roboh',
            'Total Unit', 'Total Check', 'Status Total', 'Kategori Isu', 'Keterangan Isu', 'Status Tindakan', 'Senarai Kerja', 'Kos (RM)', 'Jangkaan', 'Catatan'
        ];

        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            
            // Styling Header
            $sheet->getStyle($column . '1')->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ]);
            $column++;
        }

        // 2. PENGISIAN DATA
        $rowNum = 2;
        foreach ($data as $row) {
            // Logik Pengiraan (Sama seperti di View)
            $jlh_dihuni_check = (int)$row['dihuni_baik'] + (int)$row['dihuni_rosak'];
            $status_dihuni = ($row['unit_dihuni'] == $jlh_dihuni_check) ? 'TRUE' : 'FALSE';

            $jumlah_cadangan = (int)$row['baik_diduduki'] + (int)$row['baik_guna_sama'] + 
                               (int)$row['baik_tukar_fungsi'] + (int)$row['baik_sewaan'] + 
                               (int)$row['rosak_baik_pulih'] + (int)$row['rosak_guna_sama'] + 
                               (int)$row['rosak_tukar_fungsi'] + (int)$row['rosak_sewaan'] + 
                               (int)$row['rosak_roboh'];
            
            $status_cadangan = ((int)$row['unit_tidak_dihuni'] == $jumlah_cadangan) ? 'TRUE' : 'FALSE';
            
            $total_check = (int)$row['unit_dihuni'] + (int)$row['unit_tidak_dihuni'];
            $status_total = ((int)$row['total_unit_kuarters'] == $total_check) ? 'TRUE' : 'FALSE';

            // Set Nilai Sel
            $sheet->setCellValue('A' . $rowNum, $row['kod_kuarters']);
            $sheet->setCellValue('B' . $rowNum, $row['nama_kuarters']);
            $sheet->setCellValue('C' . $rowNum, $row['nama_kategori_kuarters'] ?: 'Tiada Maklumat');
            $sheet->setCellValue('D' . $rowNum, $row['jumlah_permohonan']);
            $sheet->setCellValue('E' . $rowNum, $row['unit_dihuni']);
            $sheet->setCellValue('F' . $rowNum, $row['dihuni_baik']);
            $sheet->setCellValue('G' . $rowNum, $row['dihuni_rosak']);
            $sheet->setCellValue('H' . $rowNum, $jlh_dihuni_check);
            $sheet->setCellValue('I' . $rowNum, $status_dihuni);
            $sheet->setCellValue('J' . $rowNum, $jumlah_cadangan);
            $sheet->setCellValue('K' . $rowNum, $status_cadangan);
            $sheet->setCellValue('L' . $rowNum, $row['unit_tidak_dihuni']);
            
            $sheet->setCellValue('M' . $rowNum, $row['baik_diduduki']);
            $sheet->setCellValue('N' . $rowNum, $row['baik_guna_sama']);
            $sheet->setCellValue('O' . $rowNum, $row['ket_baik_guna_sama']);
            $sheet->setCellValue('P' . $rowNum, $row['baik_tukar_fungsi']);
            $sheet->setCellValue('Q' . $rowNum, $row['ket_baik_tukar_fungsi']);
            $sheet->setCellValue('R' . $rowNum, $row['baik_sewaan']);
            $sheet->setCellValue('S' . $rowNum, $row['ket_baik_sewaan']);
            
            $sheet->setCellValue('T' . $rowNum, $row['rosak_baik_pulih']);
            $sheet->setCellValue('U' . $rowNum, $row['ket_rosak_baik_pulih']);
            $sheet->setCellValue('V' . $rowNum, $row['rosak_guna_sama']);
            $sheet->setCellValue('W' . $rowNum, $row['ket_rosak_guna_sama']);
            $sheet->setCellValue('X' . $rowNum, $row['rosak_tukar_fungsi']);
            $sheet->setCellValue('Y' . $rowNum, $row['ket_rosak_tukar_fungsi']);
            $sheet->setCellValue('Z' . $rowNum, $row['rosak_sewaan']);
            $sheet->setCellValue('AA' . $rowNum, $row['ket_rosak_sewaan']);
            $sheet->setCellValue('AB' . $rowNum, $row['rosak_roboh']);
            $sheet->setCellValue('AC' . $rowNum, $row['ket_rosak_roboh']);

            $sheet->setCellValue('AD' . $rowNum, $row['total_unit_kuarters']);
            $sheet->setCellValue('AE' . $rowNum, $total_check);
            $sheet->setCellValue('AF' . $rowNum, $status_total);
            
            $sheet->setCellValue('AG' . $rowNum, $row['nama_kategori_isu']);
            $sheet->setCellValue('AH' . $rowNum, $row['keterangan_isu']);
            $sheet->setCellValue('AI' . $rowNum, $row['status_tindakan']);
            $sheet->setCellValue('AJ' . $rowNum, $row['senarai_kerja']);
            $sheet->setCellValue('AK' . $rowNum, $row['kos_rm']);
            $sheet->setCellValue('AL' . $rowNum, $row['jangkaan_pelaksanaan']);
            $sheet->setCellValue('AM' . $rowNum, $row['catatan']);

            // Formatting Matawang untuk Kos
            $sheet->getStyle('AK' . $rowNum)->getNumberFormat()->setFormatCode('#,##0.00');

            // Warna Merah jika FALSE
            if ($status_dihuni == 'FALSE') { $sheet->getStyle('I'.$rowNum)->getFont()->getColor()->setARGB('FF0000'); }
            if ($status_cadangan == 'FALSE') { $sheet->getStyle('K'.$rowNum)->getFont()->getColor()->setARGB('FF0000'); }
            if ($status_total == 'FALSE') { $sheet->getStyle('AF'.$rowNum)->getFont()->getColor()->setARGB('FF0000'); }

            $rowNum++;
        }

        // 3. STYLING SELEPAS LOOP (OPSYEN 2: WRAP TEXT)
        $lastRow = $rowNum - 1;
        $highestColumn = $sheet->getHighestColumn();

        // Wrap Text untuk kolum panjang
        $wrapColumns = ['B', 'O', 'Q', 'S', 'U', 'W', 'Y', 'AA', 'AC', 'AH', 'AI', 'AJ', 'AM'];
        foreach ($wrapColumns as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(false);
            $sheet->getColumnDimension($col)->setWidth(35);
            $sheet->getStyle($col . '2:' . $col . $lastRow)->getAlignment()->setWrapText(true);
        }

        // Auto-size untuk kolum selebihnya
       // 3. STYLING SELEPAS LOOP
        $lastRow = $rowNum - 1;

        // Kolum yang perlu di-Wrap
        $wrapColumns = ['B', 'O', 'Q', 'S', 'U', 'W', 'Y', 'AA', 'AC', 'AH', 'AI', 'AJ', 'AM'];

        // Gunakan ColumnIterator untuk mengendalikan kolum melebihi 'Z'
        foreach ($sheet->getColumnIterator() as $column) {
            $columnID = $column->getColumnIndex(); // Ini akan dapat 'A', 'B' ... 'AA', 'AB' dsb.

            if (in_array($columnID, $wrapColumns)) {
                // Styling untuk kolum panjang (Wrap Text)
                $sheet->getColumnDimension($columnID)->setAutoSize(false);
                $sheet->getColumnDimension($columnID)->setWidth(35);
                $sheet->getStyle($columnID . '2:' . $columnID . $lastRow)->getAlignment()->setWrapText(true);
            } else {
                // Auto-size untuk kolum pendek
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            // Set semua alignment vertical ke TOP supaya kemas
            $sheet->getStyle($columnID . '2:' . $columnID . $lastRow)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
        }

        // Tambah Border untuk semua data
        $sheet->getStyle('A1:' . $highestColumn . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // 4. OUTPUT DOWNLOAD
        $filename = "Statistik_Agensi_Induk_" . date('Ymd_His') . ".xlsx";
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }



	
		//return view('admin/v_list_user',$data);
	


	



	

	

}
