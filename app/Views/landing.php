<main id="main" class="main">

  <div class="pagetitle text-center">
    <h1>Selamat Datang</h1>
    <p>Sila pilih peranan atau tindakan anda.</p>
  </div>

  <style>
    .custom-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
      border-radius: 1rem;
      color: #fff;
    }
    .custom-card:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }
    .bg-cr-pusat    { background: #0d6efd; }  /* Biru */
    .bg-cr-app      { background: #6f42c1; }  /* Ungu */
    .bg-pemohon     { background: #198754; }  /* Hijau */
    .bg-pengesah    { background: #fd7e14; }  /* Oren */
    .card-icon {
      font-size: 3rem;
    }
  </style>

  <div class="row justify-content-center mt-4">
     <!-- CR Aplikasi -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= site_url('admin') ?>" class="text-decoration-none">
        <div class="card custom-card bg-cr-app text-center">
          <div class="card-body">
            <div class="card-icon mb-3">
              <i class="bi bi-gear-fill"></i>
            </div>
            <h5 class="card-title">CR Aplikasi</h5>
            <p class="card-text">Permohonan ubah suai aplikasi.</p>
             <p class="card-text">Mohon penambahbaikan,tambah id,kemaskini pengguna dan lain-lain.</p>
          </div>
        </div>
      </a>
    </div>

    <!-- CR Pusat -->

    <?php
$user_level = session()->get('level');
$user_seksyen = session()->get('id_seksyen');

if ($user_level == 6 && $user_seksyen == 'OK') {
    $link = site_url('admin/senarai_cr_data_pptm');
} elseif ($user_level == 6) {
    $link = site_url('admin/senarai_cr_data_pemohon');
} elseif ($user_level == 5 && $user_seksyen == 'OK') {
    $link = site_url('admin/senarai_cr_data_tindakan');
} elseif ($user_level == 5) {
    $link = site_url('admin/senarai_cr_data_psu');
} else {
    $link = site_url('admin/landing'); // fallback
}
?>

 
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= $link ?>" class="text-decoration-none">
        <div class="card custom-card bg-cr-pusat text-center">
          <div class="card-body">
            <div class="card-icon mb-3">
              <i class="bi bi-diagram-3-fill"></i>
            </div>
            <h5 class="card-title">CR Pusat Data</h5>
            <p class="card-text">Permohonan dan tindakan berkaitan Pusat Data.</p>
            <p class="card-text">Mohon Penambahbaikan Server,Kemaskini Akses Server,Mohon server Database,dan lain-lain</p>
          </div>
        </div>
      </a>
    </div>

   

    

  </div>

</main>
