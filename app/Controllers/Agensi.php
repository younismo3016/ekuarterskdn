<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\Model;
use App\Models\Model_User;
use App\Models\Model_Bahagian;
use App\Models\Model_Seksyen;
use App\Models\Model_Level;
use App\Models\StatistikAgensiModel;

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

    $kategori_isu = $db->table('adm_issue_category')
                       ->select('id_kategori_isu, keterangan_kategori')
                       ->get()
                       ->getResultArray();

    $reports = $model->getDetailedReport($bulan, $tahun, $id_agensi);

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
    $db = \Config\Database::connect();
    $id_agensi = session()->get('id_agensi_induk');
    
    $bulan_ini = (int)date('m');
    $tahun_ini = (int)date('Y');

    // 1. Semak jika rekod bulan semasa sudah wujud
    $exists = $db->table('table_report')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where('table_quarters_profile.id_agensi_induk', $id_agensi)
        ->where('table_report.bulan', $bulan_ini)
        ->where('table_report.tahun', $tahun_ini)
        ->countAllResults();

    if ($exists > 0) {
        return redirect()->to(base_url('index.php/agensi/statistik'))->with('error', 'Rekod bagi bulan semasa sudah wujud.');
    }

    // 2. Ambil data laporan terakhir
    $last_report = $db->table('table_report')
        ->select('table_report.*')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where('table_quarters_profile.id_agensi_induk', $id_agensi)
        ->orderBy('table_report.tahun', 'DESC')
        ->orderBy('table_report.bulan', 'DESC')
        ->get()
        ->getResultArray();

    if (empty($last_report)) {
        return redirect()->back()->with('error', 'Tiada rekod lama untuk disalin.');
    }

    // Gunakan Transaction untuk pastikan integriti data antara table_report & table_issue
    $db->transStart();

    $seen_kuarters = [];

    foreach ($last_report as $row) {
        if (!in_array($row['id_kuarters'], $seen_kuarters)) {
            
            // Simpan data laporan baru
            $data_report_baru = [
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

            $db->table('table_report')->insert($data_report_baru);
            $new_report_id = $db->insertID(); // ID unik untuk table_issue

            // 3. PROSES SALIN ISU (table_issue)
            // Ambil semua isu yang berkaitan dengan laporan lama (id_report asal)
            $old_issues = $db->table('table_issue')
                ->where('id_report', $row['id_report'])
                ->get()
                ->getResultArray();

            if (!empty($old_issues)) {
                $data_issue_baru = [];
                foreach ($old_issues as $issue) {
                    $data_issue_baru[] = [
                        'id_report'       => $new_report_id, // Guna ID report yang baru
                        'id_kategori_isu' => $issue['id_kategori_isu'],
                        // Tambah field lain jika ada dalam table_issue (cth: catatan_isu)
                    ];
                }
                // Masukkan semua isu untuk report ini secara batch
                $db->table('table_issue')->insertBatch($data_issue_baru);
            }
            
            $seen_kuarters[] = $row['id_kuarters'];
        }
    }

    $db->transComplete();

    if ($db->transStatus() === FALSE) {
        return redirect()->back()->with('error', 'Gagal menyalin data. Sila cuba lagi.');
    }

    return redirect()->to(base_url('index.php/agensi/agensi_statistik_list'))->with('success', 'Rekod laporan dan isu berjaya disalin ke bulan semasa.');
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
            table_quarters_profile.jenis_kuarters,
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
    $db = \Config\Database::connect();
    
    $id_agensi = session()->get('id_agensi_induk');

    // Tambah pemetaan nama bulan
    $senarai_bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];

    $data = [
        'title'        => 'Paparan Statistik Kuarters',
        'isi'          => 'agensi/agensi_statistik_papar', 
        'reports'      => $model->getDetailedReportView($bulan, $tahun, $id_agensi),
        'kategori_isu' => $db->table('adm_issue_category')->get()->getResultArray(),
        'bulan'        => $bulan,
        'tahun'        => $tahun,
        // Tambah baris ini:
        'nama_bulan'   => $senarai_bulan[(int)$bulan] ?? 'Statistik' 
    ];

    return view('layout/v_wrapper', $data);
}

public function hantar_ke_kdn($bulan, $tahun)
{
    $id_agensi = session()->get('id_agensi_induk'); 
    $model = new \App\Models\StatistikAgensiModel();

    // 1. DAPATKAN SENARAI YANG TAK TALLY
    $senarai_ralat = $model->getSenaraiTidakTally($bulan, $tahun, $id_agensi);

    if (!empty($senarai_ralat)) {
        // Bina string senarai kuarters
        $senarai_teks = "<ul>";
        foreach ($senarai_ralat as $r) {
            $senarai_teks .= "<li><b>" . $r['kod_kuarters'] . "</b> - " . $r['nama_kuarters'] . "</li>";
        }
        $senarai_teks .= "</ul>";

        session()->setFlashdata('error', '<b>Penghantaran Gagal!</b> Kuarters berikut mempunyai data tidak tally: ' . $senarai_teks . 'Sila betulkan sebelum hantar.');

        return redirect()->to(base_url("index.php/agensi/agensi_statistik_kemaskini/$bulan/$tahun"));
    }

    // 2. PROSES UPDATE STATUS (Jika tiada ralat)
    $data_update = ['status_hantar' => 2];
    $result = $model->updateStatusHantar($bulan, $tahun, $id_agensi, $data_update);

    if ($result) {
        session()->setFlashdata('success', 'Rekod statistik telah berjaya dihantar ke KDN.');
        return redirect()->to(base_url('index.php/agensi/agensi_statistik_list'));
    } else {
        session()->setFlashdata('error', 'Gagal menghantar rekod. Sila cuba lagi.');
        return redirect()->to(base_url("index.php/agensi/agensi_statistik_kemaskini/$bulan/$tahun"));
    }
}



public function papar_individu($id_kuarters, $bulan, $tahun) {
    $db = \Config\Database::connect();
    
    $row = $db->table('table_report')
        ->select('table_report.*, table_quarters_profile.kod_kuarters, table_quarters_profile.nama_kuarters, table_quarters_profile.jenis_kuarters')
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

    $data = [
        'title'        => 'Paparan Statistik Individu',
        'isi'          => 'agensi/papar_individu_view', 
        'data'         => $row,          // Kita guna 'data' supaya view anda tidak perlu diubah
        'senarai_isu'  => $senarai_isu,
        'bulan'        => $bulan,
        'tahun'        => $tahun
    ];

    return view('layout/v_wrapper', $data);
}



	} //lastclose

	

        

		

