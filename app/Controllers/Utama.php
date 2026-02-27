<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;

use App\Models\Model_Utama;
use App\Models\Model_Report;

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
        $this->Model_Report = new Model_Report();
		

		
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
    $bulan_semasa   = (int)date('m'); 
    $tahun_sekarang = (int)date('Y');
    
    $list_statistik_penuh = [];

    // Loop 3 bulan (2 Bulan Lepas -> Bulan Semasa)
    for ($i = 2; $i >= 0; $i--) {
        $b = $bulan_semasa - $i;
        $t = $tahun_sekarang;
        
        if ($b <= 0) {
            $b += 12; // Pusing ke tahun lepas
            $t -= 1;  
        }
        
        // 1. Ambil data snapshot tepat untuk bulan & tahun ini
        $row = $this->Model_Utama->getStatistikBulan($b, $t);
        $row['nama_bulan'] = $this->getNamaBulan($b);
        
        // 2. Tentukan Status Dinamik (Siapa hantar, siapa tak hantar)
        if ($row['jumlah_kuarters_berdaftar'] > 0 && $row['jumlah_hantar_semasa'] == $row['jumlah_kuarters_berdaftar']) {
            // SEMUA agensi hantar bulan ini
            $row['status_teks']   = 'SELESAI';
            $row['status_hantar'] = 2; // Badge Hijau
            
        } elseif ($row['jumlah_hantar_semasa'] > 0) {
            // SEPARUH hantar bulan ni, SEPARUH guna data bawaan bulan lepas
            $row['status_teks']   = 'SEPARUH HANTAR (ADA BAWAAN)';
            $row['status_hantar'] = 1; // Badge Kuning
            
        } elseif ($row['total_unit_dihuni'] > 0 || $row['total_unit_tidak_dihuni'] > 0) {
            // TIADA hantar bulan ni, KESEMUA guna data bawaan bulan lepas
            $row['status_teks']   = 'BELUM HANTAR (DATA BAWAAN)';
            $row['status_hantar'] = 0; // Badge Kuning
            
        } else {
            // Memang tak wujud data langsung dalam database untuk bulan ini/sebelumnya
            $row['status_teks']   = 'TIADA DATA';
            $row['status_hantar'] = 0; // Badge Kelabu
        }

        $list_statistik_penuh[] = $row;
    }

    $data = [
        'title'               => 'Statistik Agensi Induk',
        'list_statistik'      => $list_statistik_penuh, 
        'isi'                 => 'utama/v_report_bulanan',
        'bulan_sekarang'      => $bulan_semasa,
        'tahun_sekarang'      => $tahun_sekarang,
        'nama_bulan_sekarang' => $this->getNamaBulan($bulan_semasa) 
    ];

    return view('layout/v_wrapper', $data);
}

// Function helper Tuan (Kekal tiada perubahan)
private function getNamaBulan($m) 
{
    $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April', 
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos', 
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];
    
    return $bulan[(int)$m] ?? 'Bulan Tidak Sah'; 
}

// Function papar detail Tuan (Kekal tiada perubahan)
public function report_bulanan_papar($bulan, $tahun)
{
    $model = new \App\Models\Model_Utama();
    $id_agensi = session()->get('id_agensi_induk');
    
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

public function admin_statistik_papar_excel($bulan, $tahun)
{
    $model = new \App\Models\Model_Utama();
    $data = $model->getStatistikByAgensiExcel($bulan, $tahun);

    if (empty($data)) {
        return redirect()->back()->with('error', 'Tiada rekod laporan dijumpai sehingga tarikh tersebut.');
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Statistik Laporan');

    // --- 1. SETUP HEADER DINAMIK (Ikut Nama SQL AS) ---
    // Ambil keys dari row pertama data sebagai Header
    $firstRow = $data[0]; 
    $headers = array_keys($firstRow); 

    $col = 'A';
    foreach ($headers as $h) {
        $sheet->setCellValue($col . '1', $h);
        
        // Styling Header
        $sheet->getStyle($col . '1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4472C4']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ]);
        $col++;
    }

    // --- 2. PENGISIAN DATA ---
    $rowNum = 2;
    foreach ($data as $row) {
        $col = 'A';
        foreach ($row as $key => $value) {
            $sheet->setCellValue($col . $rowNum, $value);
            
            // Format Matawang jika kolum ialah 'Y. KOS...'
            if (strpos($key, 'KOS PENYELENGGARAAN') !== false) {
                $sheet->getStyle($col . $rowNum)->getNumberFormat()->setFormatCode('#,##0.00');
            }

            // Warna Merah untuk FALSE (Validity Check)
            if (strpos($key, 'Validity') !== false && $value === 'FALSE') {
                $sheet->getStyle($col . $rowNum)->getFont()->getColor()->setARGB('FF0000');
                $sheet->getStyle($col . $rowNum)->getFont()->setBold(true);
            }

            $col++;
        }
        $rowNum++;
    }

    // --- 3. STYLING AKHIR ---
    $lastRow = $rowNum - 1;
    $highestCol = $sheet->getHighestColumn();

    // AutoSize & Wrap Text Loop
    foreach ($sheet->getColumnIterator() as $column) {
        $colID = $column->getColumnIndex();
        $headerVal = $sheet->getCell($colID . '1')->getValue();

        // Senarai kata kunci untuk kolum yang perlu WRAP TEXT (panjang)
        $longTextKeywords = ['NAMA KUARTERS', 'JENIS KUARTERS', 'KETERANGAN', 'ISU', 'SENARAI', 'CADANGAN', 'CATATAN'];
        
        $needWrap = false;
        foreach ($longTextKeywords as $keyword) {
            if (strpos($headerVal, $keyword) !== false) {
                $needWrap = true;
                break;
            }
        }

        if ($needWrap) {
            $sheet->getColumnDimension($colID)->setAutoSize(false)->setWidth(40);
            $sheet->getStyle($colID . '2:' . $colID . $lastRow)->getAlignment()->setWrapText(true);
        } else {
            $sheet->getColumnDimension($colID)->setAutoSize(true);
        }
        
        // Vertical Top Alignment
        $sheet->getStyle($colID . '1:' . $colID . $lastRow)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
    }

    // Border Keseluruhan
    $sheet->getStyle('A1:' . $highestCol . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    // --- 4. OUTPUT ---
    $filename = "Laporan_Statistik_Terkini_" . $bulan . "-" . $tahun . ".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}

   public function update_status($id_agensi_induk,$id_bulan,$id_tahun)
	{
		
    
        $data = [
			
			'status_hantar' => 1,

		];
		$this->Model_Report->kemaskini_status($data,$id_agensi_induk,$id_bulan, $id_tahun);
		session()->setFlashdata('pesan', 'Status Berjaya Dikemaskini');
		return redirect()->to(site_url('Utama/utama')); 
	}

	
		//return view('admin/v_list_user',$data);
	


	



	

	

}
