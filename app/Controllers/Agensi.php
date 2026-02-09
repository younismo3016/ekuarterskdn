<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;
use App\Models\Model_User;
use App\Models\Model_Bahagian;
use App\Models\Model_Seksyen;
use App\Models\Model_Level;
use App\Models\StatistikAgensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Agensi extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->Model_User = new Model_User();
		$this->Model_Bahagian = new Model_Bahagian();
		$this->Model_Seksyen = new Model_Seksyen();
		$this->Model_Level = new Model_Level();
        $this->StatistikAgensiModel = new StatistikAgensiModel();
		
	}

public function index()
{
    $id_agensi = session()->get('id_agensi_induk');
    $db = \Config\Database::connect();

    // 1. Ambil maklumat agensi
    $agency = $db->table('table_main_agency')
                ->where('id_agensi_induk', $id_agensi)
                ->get()
                ->getRowArray();

    // 2. Dapatkan bulan dan tahun TERKINI (status_hantar = 2)
    $latestDate = $db->table('table_report r')
                ->select('r.bulan, r.tahun')
                ->join('table_quarters_profile tqp', 'tqp.id_kuarters = r.id_kuarters')
                ->where('tqp.id_agensi_induk', $id_agensi)
                ->where('r.status_hantar', 2)
                ->orderBy('r.tahun', 'DESC')
                ->orderBy('r.bulan', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();

    // 3. Kira statistik menggunakan formula: Total = Dihuni + Kosong
    if ($latestDate) {
        $stats = $db->table('table_report r')
                    ->selectSum('r.unit_dihuni', 'total_dihuni')
                    ->selectSum('r.unit_tidak_dihuni', 'total_kosong')
                    ->select('(SUM(r.unit_dihuni) + SUM(r.unit_tidak_dihuni)) as total_unit')
                    ->join('table_quarters_profile tqp', 'tqp.id_kuarters = r.id_kuarters')
                    ->where([
                        'tqp.id_agensi_induk' => $id_agensi,
                        'r.status_hantar'     => 2,
                        'r.bulan'             => $latestDate['bulan'],
                        'r.tahun'             => $latestDate['tahun']
                    ])
                    ->get()
                    ->getRowArray();

        // 4. Ambil senarai mengikut NEGERI (adm_state)
        $laporanNegeri = $db->table('table_quarters_profile tqp')
                    ->select('
                        s.state_description, 
                        SUM(r.unit_dihuni) as total_dihuni, 
                        SUM(r.unit_tidak_dihuni) as total_kosong,
                        (SUM(r.unit_dihuni) + SUM(r.unit_tidak_dihuni)) as jumlah_kuarters
                    ')
                    ->join('table_report r', 'r.id_kuarters = tqp.id_kuarters')
                    ->join('adm_state s', 's.id_adm_state = tqp.id_negeri')
                    ->where([
                        'tqp.id_agensi_induk' => $id_agensi,
                        'r.status_hantar'     => 2,
                        'r.bulan'             => $latestDate['bulan'],
                        'r.tahun'             => $latestDate['tahun']
                    ])
                    ->groupBy('s.state_description')
                    ->orderBy('s.state_description', 'ASC')
                    ->get()
                    ->getResultArray();

  } else {
    // --- LETAK DI SINI (BAHAGIAN ELSE) ---
    // Jika tiada data status_hantar = 2, kita bagi nilai kosong supaya View tak error
    $stats = ['total_unit' => 0, 'total_dihuni' => 0, 'total_kosong' => 0];
    $laporanNegeri = [];
    
    // Kita set bulan & tahun semasa sebagai "dummy" data supaya $bulan_melayu tidak error
    $latestDate = [
        'bulan' => (int)date('n'), 
        'tahun' => (int)date('Y')
    ]; 
}

    $bulan_melayu = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];

    $data = [
        'title'         => 'Dashboard Agensi',
        'agency'        => $agency,
        'stats'         => $stats,
        'latestDate'    => $latestDate,
        'laporanNegeri' => $laporanNegeri, // Tambah variabel ini
        'bulan_melayu'  => $bulan_melayu,
        'isi'           => 'agensi/agensi_dashboard',
    ];

    return view('layout/v_wrapper', $data);
}
	public function agensi_statistik_list()
	{

        $model = new StatistikAgensiModel();
		$data = [
            'title'          => 'Statistik Agensi Induk',
            'list_statistik' => $model->getStatistikByAgensi(1),
			'isi'            => 'agensi/agensi_statistik_list',
            'bulan_sekarang' => (int)date('m'),
            'tahun_sekarang' => (int)date('Y'),
            'nama_bulan_sekarang' => $this->getNamaBulan(date('m'))
		
		];
		return view('layout/v_wrapper', $data);
	}


    	public function agensi_statistik_kemaskini($bulan, $tahun)
{
    $model = new StatistikAgensiModel();
    $db = \Config\Database::connect();
    $id_agensi = session()->get('id_agensi_induk');

    $page   = (int)($this->request->getGet('page') ?? 1);
    $page   = ($page < 1) ? 1 : $page;
    $limit  = 10;
    $offset = ($page - 1) * $limit;

    $keyword = $this->request->getGet('q');

    $reports = $model->getDetailedReport(
        $bulan,
        $tahun,
        $id_agensi,
        $limit,
        $offset,
        $keyword
    );

    $totalRows = $model->countDetailedReport1(
        $bulan,
        $tahun,
        $id_agensi,
        $keyword
    );

    $totalPages = ceil($totalRows / $limit);

    $kategori_isu = $db->table('adm_issue_category')
                       ->select('id_kategori_isu, keterangan_kategori')
                       ->get()
                       ->getResultArray();


        $tarikh_terakhir = null;
        $oleh = '-';

    if (!empty($reports)) {
        // 1. Cari tarikh paling lewat & siapa yang buat (kemaskini_oleh)
        $dates = array_column($reports, 'tarikh_kemaskini');
        $maxDate = max($dates);
        $index = array_search($maxDate, $dates);
        
        $tarikh_terakhir = $maxDate;
        $id_user_kemaskini = $reports[$index]['kemaskini_oleh']; // Ambil ID user dari table_report

        // 2. Tarik nama_penuh terus dari tbl_user guna ID tadi
        $user = $db->table('tbl_user')
                   ->select('nama_penuh')
                   ->where('id_user', $id_user_kemaskini)
                   ->get()
                   ->getRowArray();

        $oleh = $user ? $user['nama_penuh'] : '-';
    }                  

    $data = [
        'isi'               => 'agensi/agensi_statistik_kemaskini',
        'reports'           => $reports,
        'kategori_isu'      => $kategori_isu,
        'bulan'             => $bulan,
        'tahun'             => $tahun,
        'page'              => $page,
        'totalPages'        => $totalPages,
        'keyword'           => $keyword,
        'totalRows'         => $totalRows,
        'tarikh_terakhir'   => $tarikh_terakhir,
        'oleh'              => $oleh
    ];

    return view('layout/v_wrapper', $data);
}


    // Proses simpan data



    public function simpan_kemaskini()
{
    $db = \Config\Database::connect();
    $reports = $this->request->getPost('report');

    if (empty($reports)) {
        return redirect()->back()->with('error', 'Tiada data dikesan.');
    }

    $db->transBegin(); // Guna manual begin untuk kawalan ralat lebih ketat

    try {
        $builderReport = $db->table('table_report');
        $builderIssue = $db->table('table_issue');

        foreach ($reports as $report) {
            $id_report = $report['id_report'];

            // 1. Proses table_issue
            $selectedIssues = $report['id_kategori_isu'] ?? [];
            unset($report['id_kategori_isu']);
            
            $builderIssue->where('id_report', $id_report)->delete();
            if (!empty($selectedIssues) && is_array($selectedIssues)) {
                $dataIssues = [];
                foreach ($selectedIssues as $id_isu) {
                    if (!empty($id_isu)) {
                        $dataIssues[] = ['id_report' => $id_report, 'id_kategori_isu' => $id_isu];
                    }
                }
                if (!empty($dataIssues)) $builderIssue->insertBatch($dataIssues);
            }

            // 2. Sediakan Data & Paksa Jenis Data (Typecasting)
            $dataUpdate = [
                'jumlah_permohonan'   => (int)($report['jumlah_permohonan'] ?? 0),
                'unit_dihuni'         => (int)($report['unit_dihuni'] ?? 0),
                'dihuni_baik'         => (int)($report['dihuni_baik'] ?? 0),
                'dihuni_rosak'        => (int)($report['dihuni_rosak'] ?? 0),
                'unit_tidak_dihuni'   => (int)($report['unit_tidak_dihuni'] ?? 0),
                'total_unit_kuarters' => (int)($report['total_unit_kuarters'] ?? 0),
                'kos_rm'              => (float)str_replace(',', '', $report['kos_rm'] ?? 0),
                'status_hantar'       => 1,
                'tarikh_kemaskini'    => date('Y-m-d H:i:s'),
                'kemaskini_oleh'      => session()->get('id_user') ?? 5,
                'keterangan_isu'      => $report['keterangan_isu'] ?: '-',
                'status_tindakan'     => $report['status_tindakan'] ?: '-',
                'senarai_kerja'       => $report['senarai_kerja'] ?: '-',
                'catatan'             => $report['catatan'] ?: '-',
                'jangkaan_pelaksanaan'=> !empty($report['jangkaan_pelaksanaan']) ? $report['jangkaan_pelaksanaan'] : null,

                'ket_baik_guna_sama'     => $report['ket_baik_guna_sama'] ?? '',
                'ket_baik_tukar_fungsi'  => $report['ket_baik_tukar_fungsi'] ?? '',
                'ket_baik_sewaan'        => $report['ket_baik_sewaan'] ?? '',
                'ket_rosak_baik_pulih'   => $report['ket_rosak_baik_pulih'] ?? '',
                'ket_rosak_guna_sama'    => $report['ket_rosak_guna_sama'] ?? '',
                'ket_rosak_tukar_fungsi' => $report['ket_rosak_tukar_fungsi'] ?? '',
                'ket_rosak_sewaan'       => $report['ket_rosak_sewaan'] ?? '',
                'ket_rosak_roboh'        => $report['ket_rosak_roboh'] ?? '',
            ];

          
            // Set 0 untuk semua kolum pecahan yang mungkin kosong
            $numeric_cols = ['baik_diduduki', 'baik_guna_sama', 'baik_tukar_fungsi', 'baik_sewaan', 'rosak_baik_pulih', 'rosak_guna_sama', 'rosak_tukar_fungsi', 'rosak_sewaan', 'rosak_roboh'];
            foreach ($numeric_cols as $col) {
                $dataUpdate[$col] = (int)($report[$col] ?? 0);
            }

            // 3. Jalankan Update & Tangkap Ralat Jika Gagal
            if (!$builderReport->where('id_report', $id_report)->update($dataUpdate)) {
                $error = $db->error();
                $db->transRollback();
                
                // Paparkan ralat tepat untuk anda lihat
                dd([
                    'Mesej' => 'Gagal pada ID Report: ' . $id_report,
                    'SQL_Error' => $error['message'],
                    'Data_Hantar' => $dataUpdate
                ]);
            }
        }

        $db->transCommit();
        return redirect()->to(base_url('index.php/agensi/agensi_statistik_kemaskini/' . $this->request->getPost('bulan') . '/' . $this->request->getPost('tahun')))
                         ->with('success', 'Rekod berjaya dikemaskini.');

    } catch (\Exception $e) {
        $db->transRollback();
        dd("Exception: " . $e->getMessage());
    }
}



    // Proses simpan data
public function simpan_kemaskini_bck()
{
    $db = \Config\Database::connect();
    $reports = $this->request->getPost('report');

    if (empty($reports)) {
        return redirect()->back()->with('error', 'Tiada data dikesan.');
    }

    $db->transBegin();

    try {
        $builderReport = $db->table('table_report');
        $builderIssue = $db->table('table_issue');

        $dataBatchReport = [];

        foreach ($reports as $report) {
            $id_report = $report['id_report'];

            // 1. Asingkan data id_kategori_isu (ini adalah array dari Tom Select)
            $selectedIssues = $report['id_kategori_isu'] ?? [];

            // 2. Sediakan data untuk updateBatch table_report (buang id_kategori_isu dari array utama)
            unset($report['id_kategori_isu']);

            // TAMBAH BARIS INI: Set status_hantar kepada 1 (Draf)
            $report['status_hantar'] = 1;
            $report['tarikh_kemaskini'] = date('Y-m-d H:i:s');
          // Use get() to retrieve the value, not set()
            $report['kemaskini_oleh'] = session()->get('id_user');
            
            // Sanitize field lain (contoh: tarikh)
            if (isset($report['jangkaan_pelaksanaan']) && $report['jangkaan_pelaksanaan'] === "") {
                $report['jangkaan_pelaksanaan'] = null;
            }
            
            $dataBatchReport[] = $report;

            // 3. PROSES TABLE_ISSUE (Multiple Selection)
            // Langkah A: Padam isu lama untuk report ini supaya tidak bertindih
            $builderIssue->where('id_report', $id_report)->delete();

            // Langkah B: Insert isu baru jika ada yang dipilih
            if (!empty($selectedIssues) && is_array($selectedIssues)) {
                $dataIssues = [];
                foreach ($selectedIssues as $id_isu) {
                    if (!empty($id_isu)) {
                        $dataIssues[] = [
                            'id_report'       => $id_report,
                            'id_kategori_isu' => $id_isu
                        ];
                    }
                }
                
                if (!empty($dataIssues)) {
                    $builderIssue->insertBatch($dataIssues);
                }
            }
        }

        // 4. Update maklumat utama dalam table_report secara batch
        if (!empty($dataBatchReport)) {
            $builderReport->updateBatch($dataBatchReport, 'id_report');
        }

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal kemaskini. Sila cuba lagi.');
        } else {
            $db->transCommit();
            $bulan = $this->request->getPost('bulan');
            $tahun = $this->request->getPost('tahun');

            return redirect()->to(base_url('index.php/agensi/agensi_statistik_kemaskini/' . $bulan . '/' . $tahun))
                             ->with('success', 'Rekod dan Kategori Isu berjaya dikemaskini.');
        }

    } catch (\Exception $e) {
        $db->transRollback();
        return redirect()->back()->with('error', 'Ralat Sistem: ' . $e->getMessage());
    }
}
    // Fungsi bantuan untuk nama bulan
    private function getNamaBulan($m) {
    $bulan = [
        1=>'Januari', 2=>'Februari', 3=>'Mac', 4=>'April', 5=>'Mei', 6=>'Jun',
        7=>'Julai', 8=>'Ogos', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Disember'
    ];
    return $bulan[(int)$m];
}

public function tambah_baru_bck()
{
    $db = \Config\Database::connect();
    $id_agensi = session()->get('id_agensi_induk');
    
    $bulan_ini = (int)date('m');
    $tahun_ini = (int)date('Y');

    // 1. Semak jika agensi ini sudah mempunyai rekod untuk bulan/tahun ini
    $exists = $db->table('table_report')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where('table_quarters_profile.id_agensi_induk', $id_agensi)
        ->where('table_report.bulan', $bulan_ini)
        ->where('table_report.tahun', $tahun_ini)
        ->countAllResults();

    if ($exists > 0) {
        return redirect()->to(base_url('index.php/agensi/statistik'))->with('error', 'Rekod bagi bulan semasa sudah wujud dalam sistem.');
    }

    // 2. Ambil semua data terakhir (bulan sebelum) untuk agensi tersebut
    $last_report = $db->table('table_report')
        ->select('table_report.*')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where('table_quarters_profile.id_agensi_induk', $id_agensi)
        ->orderBy('table_report.tahun', 'DESC')
        ->orderBy('table_report.bulan', 'DESC')
        ->get()
        ->getResultArray();

    if (empty($last_report)) {
        return redirect()->back()->with('error', 'Tiada rekod bulan sebelumnya ditemui untuk disalin.');
    }

    $data_baru = [];
    $seen_kuarters = [];

    foreach ($last_report as $row) {
        // Pastikan hanya satu rekod (paling terkini) diambil bagi setiap id_kuarters
        if (!in_array($row['id_kuarters'], $seen_kuarters)) {
            
            $data_baru[] = [
                'id_kuarters'             => $row['id_kuarters'],
                'status_hantar'           => 0, // Set semula sebagai draft (Belum Hantar)
                'bulan'                   => $bulan_ini,
                'tahun'                   => $tahun_ini,
                'jumlah_permohonan'       => $row['jumlah_permohonan'],
                'unit_dihuni'             => $row['unit_dihuni'],
                'dihuni_baik'             => $row['dihuni_baik'],
                'dihuni_rosak'            => $row['dihuni_rosak'],
                'unit_tidak_dihuni'       => $row['unit_tidak_dihuni'],
                'baik_diduduki'           => $row['baik_diduduki'],
                'baik_guna_sama'          => $row['baik_guna_sama'],
                'ket_baik_guna_sama'      => $row['ket_baik_guna_sama'],
                'baik_tukar_fungsi'       => $row['baik_tukar_fungsi'],
                'ket_baik_tukar_fungsi'   => $row['ket_baik_tukar_fungsi'],
                'baik_sewaan'             => $row['baik_sewaan'],
                'ket_baik_sewaan'         => $row['ket_baik_sewaan'],
                'rosak_baik_pulih'        => $row['rosak_baik_pulih'],
                'ket_rosak_baik_pulih'    => $row['ket_rosak_baik_pulih'],
                'rosak_guna_sama'         => $row['rosak_guna_sama'],
                'ket_rosak_guna_sama'     => $row['ket_rosak_guna_sama'],
                'rosak_tukar_fungsi'      => $row['rosak_tukar_fungsi'],
                'ket_rosak_tukar_fungsi'  => $row['ket_rosak_tukar_fungsi'],
                'rosak_sewaan'            => $row['rosak_sewaan'],
                'ket_rosak_sewaan'        => $row['ket_rosak_sewaan'],
                'rosak_roboh'             => $row['rosak_roboh'],
                'ket_rosak_roboh'         => $row['ket_rosak_roboh'],
                'total_unit_kuarters'     => $row['total_unit_kuarters'],
                
                'keterangan_isu'          => $row['keterangan_isu'],
                'status_tindakan'         => $row['status_tindakan'],
                'senarai_kerja'           => $row['senarai_kerja'],
                'kos_rm'                  => $row['kos_rm'],
                'jangkaan_pelaksanaan'    => $row['jangkaan_pelaksanaan'],
                'catatan'                 => $row['catatan']
            ];
            
            $seen_kuarters[] = $row['id_kuarters'];
        }
    }

    // 3. Masukkan data secara batch
    if (!empty($data_baru)) {
        try {
            $db->table('table_report')->insertBatch($data_baru);
            return redirect()->to(base_url('index.php/agensi/agensi_statistik_list'))->with('success', 'Rekod bagi ' . $bulan_ini . '/' . $tahun_ini . ' berjaya dijana dengan menyalin data bulan sebelumnya.');
        } catch (\Exception $e) {
            // Jika ralat "Duplicate Entry" masih berlaku di peringkat database
            return redirect()->back()->with('error', 'Gagal menyalin: Rekod bertindih dikesan.');
        }
    }

    return redirect()->back()->with('error', 'Tiada data kuarters untuk disalin.');
}




public function tambah_baru()
{
    set_time_limit(300); 
    $db = \Config\Database::connect();
    $id_agensi = session()->get('id_agensi_induk');

    $bulan_ini = (int)date('m');
    $tahun_ini = (int)date('Y');

    // 1. Semak kewujudan
    $exists = $db->table('table_report')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where('table_quarters_profile.id_agensi_induk', $id_agensi)
        ->where('table_report.bulan', $bulan_ini)
        ->where('table_report.tahun', $tahun_ini)
        ->countAllResults();

    if ($exists > 0) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Rekod bagi bulan semasa sudah wujud.'
        ]);
    }

    // 2. Ambil data terakhir
    $last_report = $db->table('table_report')
        ->select('table_report.*')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where('table_quarters_profile.id_agensi_induk', $id_agensi)
        ->orderBy('table_report.tahun', 'DESC')
        ->orderBy('table_report.bulan', 'DESC')
        ->get()
        ->getResultArray();

    if (empty($last_report)) {
        return $this->response->setJSON([
            'status' => 'error', 
            'message' => 'Tiada rekod lama untuk disalin.'
        ]);
    }

    $db->transStart();

    $seen_kuarters = [];
    foreach ($last_report as $row) {
        if (!in_array($row['id_kuarters'], $seen_kuarters)) {
            
            $data_report_baru = [
                'id_kuarters'             => $row['id_kuarters'],
                'status_hantar'           => 0, 
                'bulan'                   => $bulan_ini,
                'tahun'                   => $tahun_ini,
                'jumlah_permohonan'       => $row['jumlah_permohonan'],
                'unit_dihuni'             => $row['unit_dihuni'],
                'dihuni_baik'             => $row['dihuni_baik'],
                'dihuni_rosak'            => $row['dihuni_rosak'],
                'unit_tidak_dihuni'       => $row['unit_tidak_dihuni'],
                'baik_diduduki'           => $row['baik_diduduki'],
                'baik_guna_sama'          => $row['baik_guna_sama'],
                'ket_baik_guna_sama'      => $row['ket_baik_guna_sama'],
                'baik_tukar_fungsi'       => $row['baik_tukar_fungsi'],
                'ket_baik_tukar_fungsi'   => $row['ket_baik_tukar_fungsi'],
                'baik_sewaan'             => $row['baik_sewaan'],
                'ket_baik_sewaan'         => $row['ket_baik_sewaan'],
                'rosak_baik_pulih'        => $row['rosak_baik_pulih'],
                'ket_rosak_baik_pulih'    => $row['ket_rosak_baik_pulih'],
                'rosak_guna_sama'         => $row['rosak_guna_sama'],
                'ket_rosak_guna_sama'     => $row['ket_rosak_guna_sama'],
                'rosak_tukar_fungsi'      => $row['rosak_tukar_fungsi'],
                'ket_rosak_tukar_fungsi'  => $row['ket_rosak_tukar_fungsi'],
                'rosak_sewaan'            => $row['rosak_sewaan'],
                'ket_rosak_sewaan'        => $row['ket_rosak_sewaan'],
                'rosak_roboh'             => $row['rosak_roboh'],
                'ket_rosak_roboh'         => $row['ket_rosak_roboh'],
                'total_unit_kuarters'     => $row['total_unit_kuarters'],
                'keterangan_isu'          => $row['keterangan_isu'],
                'status_tindakan'         => $row['status_tindakan'],
                'senarai_kerja'           => $row['senarai_kerja'],
                'kos_rm'                  => $row['kos_rm'],
                'jangkaan_pelaksanaan'    => $row['jangkaan_pelaksanaan'],
                'catatan'                 => $row['catatan']
            ];

            $db->table('table_report')->insert($data_report_baru);
            $new_report_id = $db->insertID();

            $old_issues = $db->table('table_issue')
                ->where('id_report', $row['id_report'])
                ->get()
                ->getResultArray();

            if (!empty($old_issues)) {
                $batch_issues = [];
                foreach ($old_issues as $issue) {
                    $batch_issues[] = [
                        'id_report'       => $new_report_id,
                        'id_kategori_isu' => $issue['id_kategori_isu'],
                    ];
                }
                $db->table('table_issue')->insertBatch($batch_issues);
            }
            
            $seen_kuarters[] = $row['id_kuarters'];
        }
    }

    $db->transComplete();

    if ($db->transStatus() === FALSE) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menyalin data disebabkan ralat pangkalan data.'
        ]);
    }

    // PENGGANTI REDIRECT: Hantar URL ke JavaScript
    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Rekod berjaya disalin.',
        'redirect_url' => base_url('index.php/agensi/agensi_statistik_list')
    ]);
}



public function kemaskini_individu($id_kuarters, $bulan, $tahun) {
    $db = \Config\Database::connect();
    
    // 1. Ambil data laporan join dengan profil DAN join table_issue untuk dapatkan senarai isu
    // Kita gunakan GROUP_CONCAT untuk kumpulkan semua id_kategori_isu dalam satu string
    $row = $db->table('table_report')
        ->select('
            table_report.*, 
            table_quarters_profile.kod_kuarters, 
            table_quarters_profile.nama_kuarters, 
            
            GROUP_CONCAT(table_issue.id_kategori_isu) as selected_issues
        ')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->join('table_issue', 'table_issue.id_report = table_report.id_report', 'left') // Join table_issue
        ->where([
            'table_report.id_kuarters' => $id_kuarters,
            'table_report.bulan' => $bulan,
            'table_report.tahun' => $tahun
        ])
        ->groupBy('table_report.id_report') // Wajib ada jika guna GROUP_CONCAT
        ->get()->getRowArray();

    // 2. Ambil data kategori dari jadual rujukan untuk dropdown
    $kategori_isu = $db->table('adm_issue_category')->get()->getResultArray();

    // 3. Susun data untuk dihantar ke view
    $data = [
        'title'        => 'Kemaskini Statistik Individu',
        'isi'          => 'agensi/kemaskini_individu_view', 
        'row'          => $row,
        'kategori_isu' => $kategori_isu,
        'bulan'        => $bulan,
        'tahun'        => $tahun
    ];

    // 4. Hantar ke wrapper
    return view('layout/v_wrapper', $data);
}





public function simpan_kemaskini_individu() {
    $db = \Config\Database::connect();
    $id_report = $this->request->getPost('id_report');
    $isu_array = $this->request->getPost('id_kategori_isu'); // Data dari Tom-Select (Array)

    // ---------------------------------------------------------
    // BAHAGIAN 1: KEMASKINI table_report
    // ---------------------------------------------------------
    $data_report = [
        'jumlah_permohonan'      => $this->request->getPost('jumlah_permohonan'),
        'unit_dihuni'            => $this->request->getPost('unit_dihuni'),
        'dihuni_baik'            => $this->request->getPost('dihuni_baik'),
        'dihuni_rosak'           => $this->request->getPost('dihuni_rosak'),
        'baik_diduduki'          => $this->request->getPost('baik_diduduki'),
        'baik_guna_sama'         => $this->request->getPost('baik_guna_sama'),
        'ket_baik_guna_sama'     => $this->request->getPost('ket_baik_guna_sama'),
        'baik_tukar_fungsi'      => $this->request->getPost('baik_tukar_fungsi'),
        'ket_baik_tukar_fungsi'  => $this->request->getPost('ket_baik_tukar_fungsi'),
        'baik_sewaan'            => $this->request->getPost('baik_sewaan'),
        'ket_baik_sewaan'        => $this->request->getPost('ket_baik_sewaan'),
        'rosak_baik_pulih'       => $this->request->getPost('rosak_baik_pulih'),
        'ket_rosak_baik_pulih'   => $this->request->getPost('ket_rosak_baik_pulih'),
        'rosak_guna_sama'        => $this->request->getPost('rosak_guna_sama'),
        'ket_rosak_guna_sama'    => $this->request->getPost('ket_rosak_guna_sama'),
        'rosak_tukar_fungsi'     => $this->request->getPost('rosak_tukar_fungsi'),
        'ket_rosak_tukar_fungsi' => $this->request->getPost('ket_rosak_tukar_fungsi'),
        'rosak_sewaan'           => $this->request->getPost('rosak_sewaan'),
        'ket_rosak_sewaan'       => $this->request->getPost('ket_rosak_sewaan'),
        'rosak_roboh'            => $this->request->getPost('rosak_roboh'),
        'ket_rosak_roboh'        => $this->request->getPost('ket_rosak_roboh'),
        'unit_tidak_dihuni'      => $this->request->getPost('unit_tidak_dihuni'),
        'total_unit_kuarters'    => $this->request->getPost('total_unit_kuarters'),
        'keterangan_isu'         => $this->request->getPost('keterangan_isu'),
        'status_tindakan'        => $this->request->getPost('status_tindakan'),
        'senarai_kerja'          => $this->request->getPost('senarai_kerja'),
        'kos_rm'                 => $this->request->getPost('kos_rm'),
        'jangkaan_pelaksanaan'   => $this->request->getPost('jangkaan_pelaksanaan'),
        'catatan'                => $this->request->getPost('catatan')
    ];

    $db->transStart(); // Guna Transaction untuk integriti data

    // Update table utama
    $db->table('table_report')->where('id_report', $id_report)->update($data_report);

    // ---------------------------------------------------------
    // BAHAGIAN 2: KEMASKINI table_issue (Relationship 1-to-Many)
    // ---------------------------------------------------------
    
    // A. Buang isu lama untuk id_report ini
    $db->table('table_issue')->where('id_report', $id_report)->delete();

    // B. Masukkan isu baru jika ada pilihan dibuat
    if (!empty($isu_array)) {
        $data_issue = [];
        foreach ($isu_array as $id_kat) {
            $data_issue[] = [
                'id_report'       => $id_report,
                'id_kategori_isu' => $id_kat
            ];
        }
        $db->table('table_issue')->insertBatch($data_issue);
    }


    

    $db->transComplete(); // Selesai Transaction

    if ($db->transStatus() === FALSE) {
        return redirect()->back()->with('error', 'Gagal mengemaskini data.');
    } else {
        return redirect()->back()->with('success', 'Rekod dan Isu berjaya dikemaskini!');
    }
}



public function agensi_statistik_papar($bulan, $tahun)
{
    $model = new \App\Models\StatistikAgensiModel();
    $id_agensi = session()->get('id_agensi_induk');
    
    // Ambil input dari query string
    $search = $this->request->getVar('q') ?? '';
    $page = $this->request->getVar('page') ?? 1;
    $perPage = 10;
    $offset = ($page - 1) * $perPage;

    $totalRecords = $model->countDetailedReport($bulan, $tahun, $id_agensi, $search);
    $reports = $model->getDetailedReportView($bulan, $tahun, $id_agensi, $perPage, $offset, $search);

    $senarai_bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];

    $data = [
        'title'        => 'Paparan Statistik Kuarters',
        'isi'          => 'agensi/agensi_statistik_papar', 
        'id_agensi'    => $id_agensi,
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


public function hantar_ke_kdn($bulan, $tahun)
{

    // $email = \Config\Services::email();

    // $email->setFrom('noreply@moha.gov.my', 'Sistem eKuarters KDN');
    // $email->setTo('yuslizam@moha.gov.my');

    // $email->setSubject('TEST IP RELAY MyGovUC');
    // $email->setMessage('Ini email ujian IP based relay.');

    // if (! $email->send()) {
    //     echo '<pre>';
    //     print_r($email->printDebugger(['headers']));
    //     echo '</pre>';
    // }



    $id_agensi = session()->get('id_agensi_induk'); 
    $model = new \App\Models\StatistikAgensiModel();
    $userModel = new \App\Models\StatistikAgensiModel(); // Pastikan model user wujud

    // 1. DAPATKAN SENARAI YANG TAK TALLY
    $senarai_ralat = $model->getSenaraiTidakTally($bulan, $tahun, $id_agensi);
if (!empty($senarai_ralat)) {
        // Menggunakan <ol> untuk penomboran
        $senarai_teks = "<ol>"; 
        foreach ($senarai_ralat as $r) {
            // Menambah simbol ❌ dan perkataan [FALSE] di hujung setiap baris
            $senarai_teks .= "<li><b>" . $r['kod_kuarters'] . "</b> - " . $r['nama_kuarters'] . " <span style='color:red;'>❌ <b>[FALSE]</b></span></li>";
        }
        $senarai_teks .= "</ol>";

        session()->setFlashdata('error', '<b>Penghantaran Gagal!</b> Sila betulkan data berikut: ' . $senarai_teks);
        return redirect()->to(base_url("index.php/agensi/agensi_statistik_kemaskini/$bulan/$tahun"));
    }

    // 2. PROSES UPDATE STATUS
    $data_update = ['status_hantar' => 2];
    $result = $model->updateStatusHantar($bulan, $tahun, $id_agensi, $data_update);

    if ($result) {
        // --- PROSES HANTAR EMEL ---
        
        // A. Dapatkan Nama Agensi & Senarai Emel Admin KDN
        $nama_agensi = $model->getNamaAgensi($id_agensi);
        $admin_emails = $userModel->getAdminKdnEmails(); // Anda perlu bina function ini di model user
        
        if (!empty($admin_emails)) {
            $this->_hantarNotifikasiEmel($bulan, $tahun, $nama_agensi, $admin_emails);
        }

        session()->setFlashdata('success', 'Rekod statistik telah berjaya dihantar ke KDN.');
        return redirect()->to(base_url('index.php/agensi/agensi_statistik_list'));
    } else {
        session()->setFlashdata('error', 'Gagal menghantar rekod. Sila cuba lagi.');
        return redirect()->to(base_url("index.php/agensi/agensi_statistik_kemaskini/$bulan/$tahun"));
    }
}

// Fungsi Private untuk menghantar emel
private function _hantarNotifikasiEmel($bulan, $tahun, $nama_agensi, $admin_emails)
{

   $email = \Config\Services::email();

    // 1. PENTING: Set penghantar (From). Tanpa ini, emel selalunya gagal dihantar.
    $pengirim_email = 'noreply@moha.gov.my'; // Ambil emel user yang sedang login
    $nama_sistem    = 'Sistem eKuarters KDN';

    $email->setFrom($pengirim_email, $nama_sistem);

    $bulanBM = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Mac',
    4 => 'April',
    5 => 'Mei',
    6 => 'Jun',
    7 => 'Julai',
    8 => 'Ogos',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Disember'
];

$tarikh_masa = date('j') . ' ' .
               $bulanBM[date('n')] . ' ' .
               date('Y g:i A');

echo $tarikh_masa;



    $senarai_bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];
    
    // Tukar bulan angka ke teks (Bahasa Inggeris secara default)
    $bulan_teks = $senarai_bulan[(int)$bulan];

    $subject = "Sistem eKuarters KDN: Notifikasi Penghantaran Laporan Bagi $bulan_teks $tahun - $nama_agensi";
    
    $message = "Tuan/Puan,<br><br>";
    $message .= "Adalah dimaklumkan bahawa <b>$nama_agensi</b> telah menghantar laporan bagi <b>$bulan_teks $tahun</b> melalui Sistem eKuarters KDN pada <b>$tarikh_masa</b>.<br><br>";
    $message .= "Tuan/Puan boleh log masuk ke dalam Sistem eKuarters KDN di URL <a href='https://ekuarters.moha.gov.my'>ekuarters.moha.gov.my</a> untuk melihat laporan tersebut.<br><br>";
    $message .= "Sekian, terima kasih.<br><br>";
    $message .= "<b>Sistem eKuarters KDN</b>";

    $email->setTo($admin_emails);
    $email->setSubject($subject);
    $email->setMessage($message);
    
    // 2. Tambah Logik Debugging jika masih tak masuk
    if ($email->send()) {
        return true;
    } else {
        // Jika masih tak masuk Mailtrap, buang komen line di bawah untuk lihat error:
        echo $email->printDebugger(['headers', 'subject', 'body']); exit;
        return false;
    }
}


private function _hantarNotifikasiEmel_bck($bulan, $tahun, $nama_agensi, $admin_emails)
{
    $email = \Config\Services::email();

    // 1. Sediakan Data Tarikh & Bulan
    $senarai_bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];
    $bulan_teks = $senarai_bulan[(int)$bulan];
    $tarikh_hantar = date("d/m/Y h:i A");

    // 2. Rekaan Kandungan HTML
    $message = "
    <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; border: 1px solid #ddd; padding: 20px; border-radius: 10px;'>
        <h2 style='color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;'>Notifikasi Penghantaran Laporan</h2>
        
        <p>Assalamualaikum / Salam Sejahtera,</p>
        <p>Makluman, Laporan bulanan kuarters telah dihantar oleh agensi berikut untuk tindakan tuan/puan:</p>
        
        <table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>
            <tr>
                <td style='padding: 8px; background: #f9f9f9; font-weight: bold; border-bottom: 1px solid #eee;'>Agensi</td>
                <td style='padding: 8px; border-bottom: 1px solid #eee;'>: $nama_agensi</td>
            </tr>
            <tr>
                <td style='padding: 8px; background: #f9f9f9; font-weight: bold; border-bottom: 1px solid #eee;'>Laporan Bagi</td>
                <td style='padding: 8px; border-bottom: 1px solid #eee;'>: $bulan_teks $tahun</td>
            </tr>
            <tr>
                <td style='padding: 8px; background: #f9f9f9; font-weight: bold; border-bottom: 1px solid #eee;'>Tarikh & Masa</td>
                <td style='padding: 8px; border-bottom: 1px solid #eee;'>: $tarikh_hantar</td>
            </tr>
            <tr>
                <td style='padding: 8px; background: #f9f9f9; font-weight: bold; border-bottom: 1px solid #eee;'>Status</td>
                <td style='padding: 8px; border-bottom: 1px solid #eee;'>: <span style='color: green; font-weight: bold;'>Berjaya Dihantar</span></td>
            </tr>
        </table>

        <p style='margin-top: 30px;'>Sila log masuk ke <strong>Sistem eKuarters KDN</strong> untuk membuat semakan dan pengesahan.</p>
        
        <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; font-size: 12px; color: #777;'>
            <p>Ini adalah emel automatik. Sila jangan balas emel ini.</p>
            <p>&copy; " . date('Y') . " Sistem eKuarters - Kementerian Dalam Negeri</p>
        </div>
    </div>";


    $pengirim_email = session()->get('email'); 
    // 3. Konfigurasi Penghantaran
    $email->setFrom($pengirim_email, 'Sistem eKuarters KDN');
    $email->setTo($admin_emails); // Pastikan ini array emel
    $email->setSubject("NOTIFIKASI: Laporan Bulanan $nama_agensi ($bulan_teks $tahun)");
    $email->setMessage($message);

    return $email->send();
}

public function papar_individu($id_kuarters, $bulan, $tahun) {
    $db = \Config\Database::connect();
    
    $row = $db->table('table_report')
        ->select('table_report.*, table_quarters_profile.kod_kuarters, table_quarters_profile.nama_kuarters')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where([
            'table_report.id_kuarters' => $id_kuarters,
            'table_report.bulan'       => $bulan,
            'table_report.tahun'       => $tahun
        ])
        ->get()->getRowArray();


        

    if (!$row) {
        return redirect()->back()->with('error', 'Rekod tidak dijumpai.');
    }

    

 $senarai_isu = $db->table('table_issue')
    // Gunakan 'AS' untuk menukar nama kolum secara sementara
    ->select('table_issue.*, adm_issue_category.keterangan_kategori AS nama_kategori_isu')
    ->join('adm_issue_category', 'adm_issue_category.id_kategori_isu = table_issue.id_kategori_isu')
    ->where('table_issue.id_report', $row['id_report'])
    ->get()->getResultArray();


$senarai_kelas = $db->table('table_jenis_kuarters')
    ->select('
        table_jenis_kuarters.id_kategori_kuarters, 
        adm_quarters_category.keterangan_kategori_kuarters
    ')
    ->join('adm_quarters_category', 'table_jenis_kuarters.id_kategori_kuarters = adm_quarters_category.id_kategori_kuarters', 'inner')
    ->where('table_jenis_kuarters.id_kuarters', $id_kuarters)
    ->get()->getResultArray();


    $data = [
        'title'        => 'Paparan Statistik Individu',
        'isi'          => 'agensi/papar_individu_view', 
        'data'         => $row,          // Kita guna 'data' supaya view anda tidak perlu diubah
        'senarai_isu'  => $senarai_isu,
        'senarai_kelas'  => $senarai_kelas,
        'bulan'        => $bulan,
        'tahun'        => $tahun
    ];

    return view('layout/v_wrapper', $data);
}



public function agensi_statistik_papar_excel($id_agensi, $bulan, $tahun)
    {
        $model = new StatistikAgensiModel();
        $data = $model->getStatistikByAgensiExcel($id_agensi, $bulan, $tahun);

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



	} //lastclose

	

        

		

