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
		$data = [

			'isi' => 'agensi/agensi_dashboard',
		
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
        $id_agensi = session()->get('id_agensi');

        // Ambil senarai kategori isu untuk dropdown
        $kategori_isu = $db->table('ref_issue_category')
                       ->select('id_kategori_isu, keterangan_kategori')
                       ->get()
                       ->getResultArray();


		$data = [
                      
			'isi'     => 'agensi/agensi_statistik_kemaskini',
            'reports' => $model->getDetailedReport($bulan, $tahun, $id_agensi),
            'kategori_isu' => $kategori_isu, // Hantar data kategori ke View
            'bulan'   => $bulan,
            'tahun'   => $tahun
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

    // --- PROSES DATA UNTUK NULL VALUES ---
    // Kita "sanitize" data supaya string kosong ditukar kepada NULL
    foreach ($reports as $key => $val) {
        if (isset($val['id_kategori_isu']) && $val['id_kategori_isu'] === "") {
            $reports[$key]['id_kategori_isu'] = null;
        }
        
        // Anda juga boleh buat perkara sama untuk tarikh atau medan lain yang nullable
        if (isset($val['jangkaan_pelaksanaan']) && $val['jangkaan_pelaksanaan'] === "") {
            $reports[$key]['jangkaan_pelaksanaan'] = null;
        }
    }

    $db->transBegin();

    try {
        $builder = $db->table('table_report');
        
        // updateBatch akan menjana query UPDATE ... CASE ... THEN yang sangat pantas
        $builder->updateBatch($reports, 'id_report');

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal kemaskini batch. Sila cuba lagi.');
        } else {
            $db->transCommit();
            return redirect()->to(base_url('index.php/agensi/agensi_statistik_list'))
                             ->with('success', 'Semua rekod berjaya dikemaskini secara batch.');
        }
    } catch (\Exception $e) {
        $db->transRollback();
        // Paparkan ralat mesra pengguna atau log ralat
        return redirect()->back()->with('error', 'Ralat Sistem: Sila pastikan semua input adalah sah.');
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
public function tambah_baru()
{
    $db = \Config\Database::connect();
    $id_agensi = session()->get('id_agensi');
    
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
                'id_kategori_isu'         => $row['id_kategori_isu'],
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


public function kemaskini_individu($id_kuarters, $bulan, $tahun) {
    $db = \Config\Database::connect();
    
    // 1. Ambil data laporan join dengan profil (Individu)
    $row = $db->table('table_report')
        ->select('table_report.*, table_quarters_profile.kod_kuarters, table_quarters_profile.nama_kuarters, table_quarters_profile.jenis_kuarters')
        ->join('table_quarters_profile', 'table_quarters_profile.id_kuarters = table_report.id_kuarters')
        ->where([
            'table_report.id_kuarters' => $id_kuarters,
            'table_report.bulan' => $bulan,
            'table_report.tahun' => $tahun
        ])
        ->get()->getRowArray();

    // 2. Ambil data kategori dari jadual yang betul
    $kategori_isu = $db->table('ref_issue_category')->get()->getResultArray();

    // 3. Susun data mengikut style yang anda mahukan
    $data = [
        'title'        => 'Kemaskini Statistik Individu', // Tambahan tajuk jika perlu
        'isi'          => 'agensi/kemaskini_individu_view', // Fail view individu anda
        'row'          => $row,
        'kategori_isu' => $kategori_isu,
        'bulan'        => $bulan,
        'tahun'        => $tahun
    ];

    // 4. Hantar ke wrapper
    return view('layout/v_wrapper', $data);
}

public function simpan_individu() {
    $db = \Config\Database::connect();
    
    // Ambil data dari post
    $id_report = $this->request->getPost('id_report');
    $bulan     = $this->request->getPost('bulan'); // Pastikan ada input hidden 'bulan' dalam view
    $tahun     = $this->request->getPost('tahun'); // Pastikan ada input hidden 'tahun' dalam view

    $data = [
        'jumlah_permohonan'      => $this->request->getPost('jumlah_permohonan'),
        'unit_dihuni'            => $this->request->getPost('unit_dihuni'),
        'dihuni_baik'            => $this->request->getPost('dihuni_baik'),
        'dihuni_rosak'           => $this->request->getPost('dihuni_rosak'),
        'unit_tidak_dihuni'      => $this->request->getPost('unit_tidak_dihuni'),
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
        'total_unit_kuarters'    => $this->request->getPost('total_unit_kuarters'),
        'id_kategori_isu'        => $this->request->getPost('id_kategori_isu'),
        'keterangan_isu'         => $this->request->getPost('keterangan_isu'),
        'status_tindakan'        => $this->request->getPost('status_tindakan'),
        'senarai_kerja'          => $this->request->getPost('senarai_kerja'),
        'kos_rm'                 => $this->request->getPost('kos_rm'),
        'jangkaan_pelaksanaan'   => $this->request->getPost('jangkaan_pelaksanaan'),
        'catatan'                => $this->request->getPost('catatan'),
    ];

    $db->table('table_report')->where('id_report', $id_report)->update($data);

    

    // Redirect ke halaman kemaskini pukal mengikut bulan & tahun
    return redirect()->to(base_url('index.php/agensi/agensi_statistik_kemaskini/' . $bulan . '/' . $tahun))
                     ->with('success', 'Data bagi kuarters tersebut berjaya dikemaskini.');
}

public function agensi_statistik_papar($bulan, $tahun)
{
    $model = new \App\Models\StatistikAgensiModel();
    $db = \Config\Database::connect();
    
    $id_agensi = session()->get('id_agensi');

    // Ambil rujukan kategori isu daripada jadual yang betul
    $kategori_isu = $db->table('ref_issue_category')->get()->getResultArray();

    $data = [
        'title'        => 'Paparan Statistik Kuarters',
        'isi'          => 'agensi/agensi_statistik_papar', 
        'reports'      => $model->getDetailedReportView($bulan, $tahun, $id_agensi),
        'kategori_isu' => $kategori_isu,
        'bulan'        => $bulan,
        'tahun'        => $tahun
    ];

    return view('layout/v_wrapper', $data);
}

public function hantar_ke_kdn($bulan, $tahun)
{
    $id_agensi = session()->get('id_agensi'); 
    $model = new \App\Models\StatistikAgensiModel();
    
    $data_update = [
        'status_hantar' => 1
    ];

    $result = $model->updateStatusHantar($bulan, $tahun, $id_agensi, $data_update);

    if ($result) {
        session()->setFlashdata('success', 'Rekod statistik bagi semua kuarters di bawah agensi anda telah dihantar ke KDN.');
    } else {
        session()->setFlashdata('error', 'Gagal menghantar rekod. Tiada kuarters dijumpai atau ralat sistem.');
    }

    return redirect()->to(base_url('index.php/agensi/agensi_statistik_list'));
}

	} //lastclose

	

        

		

