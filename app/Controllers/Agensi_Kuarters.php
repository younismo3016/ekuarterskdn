<?php

namespace App\Controllers;

use App\Models\Model_Agensi_Kuarters;

class Agensi_Kuarters extends BaseController
{
    public function agensi_kuarters_list()
    {
        $idAgensiInduk = session()->get('id_agensi_induk');

        if (!$idAgensiInduk) {
            return redirect()->to('/login')->with('error', 'Sesi telah tamat.');
        }

        $model = new Model_Agensi_Kuarters();
        
        // --- Konfigurasi Pagination ---
        $perPage = 10; // Jumlah data per muka surat
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $search = $this->request->getVar('search'); // Ambil kata kunci carian

        $offset = ($currentPage - 1) * $perPage;

        // --- Ambil Data ---
        $list_kuarters = $model->getSenaraiKuarters($idAgensiInduk, $perPage, $offset, $search);
        $totalData = $model->countAllFiltered($idAgensiInduk, $search);

        // --- Hitung jumlah muka surat ---
        $totalPages = ceil($totalData / $perPage);

        $db = \Config\Database::connect();
        $states = $db->table('adm_state')->orderBy('state_description', 'ASC')->get()->getResultArray();

        $all_classes = $db->table('adm_quarters_category')->orderBy('kelas', 'ASC')->get()->getResultArray();

 


        $data = [
            'title'         => 'Senarai Profil Kuarters',
            'list_kuarters' => $list_kuarters,
            'isi'           => 'agensi/agensi_kuarters_list',
            
            // Hantar data pagination ke view
            'currentPage'   => $currentPage,
            'totalPages'    => $totalPages,
            'search'        => $search,
            'states'        => $states,
            'all_classes'   => $all_classes
        ];

        return view('layout/v_wrapper', $data);
    }


public function getDistrictsByState()
{
    $idState = $this->request->getVar('id_state');
    
    if (!$idState) {
        return $this->response->setJSON([]);
    }
    
    $db = \Config\Database::connect();
    $builder = $db->table('adm_district');
    
    $builder->where('id_adm_state', $idState);
    $builder->orderBy('district_name', 'ASC');
    
    $query = $builder->get();
    
    // Gunakan setJSON untuk format response yang betul
    return $this->response->setJSON($query->getResultArray());
}

    // Fungsi untuk view modal (Pastikan query join table negeri/daerah)
    public function view($idKuarters)
    {
        $idAgensiInduk = session()->get('id_agensi_induk');
        $model = new Model_Agensi_Kuarters();
        
        // Guna fungsi sedia ada tapi pastikan query join negeri/daerah
        // Kalau fungsi sedia ada tak ambil negeri/daerah, kena tambah join dalam model
        $data['data'] = $model->getKuartersById($idKuarters, $idAgensiInduk);
        
        // Ambil data negeri untuk dropdown
        $db = \Config\Database::connect();
        $data['states'] = $db->table('adm_state')->get()->getResultArray();
        
        return view('agensi/modal_view', $data);
    }
    // ... fungsi view() dan edit() kekal sama ...



public function update()
{


    // ... (kod sesi & model) ...
    $idKuarters = $this->request->getPost('id_kuarters');
    $selectedClassesLetters = $this->request->getPost('senarai_kelas'); 
    $currentPage = $this->request->getPost('current_page');

    // Mapping huruf ke ID (kod ini sudah betul)
    $classesIds = [];
    if (!empty($selectedClassesLetters)) {
        $db = \Config\Database::connect();
        $allCategories = $db->table('adm_quarters_category')->get()->getResultArray();
        
        foreach ($allCategories as $category) {
            if (in_array($category['kelas'], $selectedClassesLetters)) {
                $classesIds[] = $category['id_kategori_kuarters'];
            }
        }
    }

    // Sediakan data untuk jadual utama (BUANG 'senarai_kelas')
    $dataProfile = [
        'kod_kuarters'  => $this->request->getPost('kod_kuarters'),
        'nama_kuarters' => $this->request->getPost('nama_kuarters'),
        'tahun_siap'    => $this->request->getPost('tahun_siap'),
        'id_negeri'     => $this->request->getPost('id_negeri'),
        'id_daerah'     => $this->request->getPost('id_daerah'),
    ];

    $model = new Model_Agensi_Kuarters();
    // Panggil fungsi di model (Hantar array ID untuk table mapping)
    $updateSuccess = $model->updateKuarters($idKuarters, $dataProfile, $classesIds);

   return redirect()->to(base_url('index.php/agensi/agensi_kuarters_list?page=' . $currentPage));
}


public function create()
{
    $idAgensiInduk = session()->get('id_agensi_induk');

    if (!$idAgensiInduk) {
        return redirect()->to('/login')->with('error', 'Sesi telah tamat.');
    }

    $db = \Config\Database::connect();
    $model = new Model_Agensi_Kuarters();

    // 1. Ambil data daripada form modal tambah
    // $kodKuarters dibuang kerana dijana auto
    $namaKuarters = $this->request->getPost('nama_kuarters');
    $tahunSiap = $this->request->getPost('tahun_siap');
    $idNegeri = $this->request->getPost('id_negeri');
    $idDaerah = $this->request->getPost('id_daerah');
    
    // Ini adalah array daripada multiple select Tom Select
    $selectedClassesLetters = $this->request->getPost('senarai_kelas'); 

    // 2. LOGIK AUTO GENERATE KOD KUARTERS (+1)
    // Asumsi: Kod format adalah string + nombor (cth: KDN1337)
    
    // Ambil kod terakhir dari DB
 // 1. Ambil kod terakhir dari DB dengan mengasingkan prefix dan nombor secara SQL
$lastRecord = $db->table('table_quarters_profile')
                 ->select('kod_kuarters')
                 // TAMBAH 'false' SEBAGAI PARAMETER KETIGA
                 ->orderBy('CAST(SUBSTRING(kod_kuarters, 4) AS UNSIGNED)', 'DESC', false) 
                 ->limit(1)
                 ->get()
                 ->getRowArray();

if ($lastRecord && !empty($lastRecord['kod_kuarters'])) {
    $lastCode = $lastRecord['kod_kuarters']; 
    
    // --- DEBUG: APA NILAI $lastCode SEBENARNYA? ---
    //dd($lastCode); 
    // ----------------------------------------------

    // Asingkan string dan nombor (Regex)
    if (preg_match('/([a-zA-Z]+)(\d+)/', $lastCode, $matches)) {
        $prefix = $matches[1]; // KDN
        $number = (int)$matches[2]; // 1337
        $newNumber = $number + 1;
        
        $newCode = $prefix . $newNumber;
    } else {
        // --- DEBUG: KENAPA REGEX GAGAL? ---
        // dd('Regex gagal memproses: ' . $lastCode);
        // ----------------------------------
        $newCode = 'KDN1000'; 
    }
} else {
    $newCode = 'KDN1000'; 
}

    // 3. Mapping huruf kelas ke ID Kategori
    $classesIds = [];
    if (!empty($selectedClassesLetters)) {
        $allCategories = $db->table('adm_quarters_category')->get()->getResultArray();
        
        foreach ($allCategories as $category) {
            if (in_array($category['kelas'], $selectedClassesLetters)) {
                $classesIds[] = $category['id_kategori_kuarters'];
            }
        }
    }

    // 4. Sediakan data untuk jadual profil utama
    $dataProfile = [
        'kod_kuarters' 	  => $newCode, // Gunakan kod yang dijana auto
        'nama_kuarters'   => $namaKuarters,
        'tahun_siap'      => $tahunSiap,
        'id_negeri'       => $idNegeri,
        'id_daerah'       => $idDaerah,
        'id_agensi_induk' => $idAgensiInduk,
        // 'created_at'   => date('Y-m-d H:i:s')
    ];
    
    // 5. Panggil fungsi di model untuk simpan
    $insertSuccess = $model->insertKuarters($dataProfile, $classesIds);

    if ($insertSuccess) {
        return redirect()->to(base_url('index.php/agensi/agensi_kuarters_list'))->with('success', 'Kuarters ' . $newCode . ' berjaya ditambah.');
    } else {
        return redirect()->to(base_url('index.php/agensi/agensi_kuarters_list'))->with('error', 'Gagal menambah kuarters.');
    }
}
}