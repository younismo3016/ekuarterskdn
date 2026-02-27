<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= base_url() ?>/photo/jata.gif" class="img-circle" alt="User Image">
        <span class="d-none d-lg-block">eKuarters KDN</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">

    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <?php
        // pesan validation error
        $errors = session()->getFlashdata('errors');
        if (!empty($errors)) { ?>
          <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
            <ul class="mb-1 small">
              <?php foreach ($errors as $error) : ?>
                <li><?= esc($error) ?></li>
              <?php endforeach ?>
            </ul>
            <i class="bi bi-exclamation-circle text-danger"></i></button>
          </div>
        <?php } ?>

        <?php
        if (session()->getFlashdata('pesan')) {
          echo '<div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">';

          // Apply 'small' class to make the text smaller
          echo '<div class="small">' . session()->getFlashdata('pesan') . ' &nbsp;&nbsp;<i class="bi bi-check-circle text-success"></i></div>';

          echo '';
          echo '</div>';
        }
        ?>


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0 text-white" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle fs-4"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2 text-white">
              <?= session()->get('nama_penuh') ?>
            </span>


          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= session()->get('name_user') ?> </h6>

            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
             <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modalProfil">
                <i class="bi bi-person"></i>
                <span>Profil Saya</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modalTukarKatalaluan">
                <i class="bi bi-key"></i>
                <span>Tukar Katalaluan</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= site_url('auth/logout') ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>


              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->


  <div class="modal fade" id="modalTukarKatalaluan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow-lg border-0">

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-shield-lock me-2"></i> Tukar Kata laluan
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="<?= site_url('changepwd/update') ?>" method="post">
          <?= csrf_field() ?>
          <div class="modal-body p-4">

            <p class="text-muted small mb-4">Pastikan kata laluan anda selamat dan sukar diteka oleh orang lain.</p>

            <div class="mb-4">
              <label class="form-label fw-bold text-secondary small">KATA LALUAN LAMA</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                <input type="password" name="old_password" class="form-control border-start-0 bg-light" placeholder="Masukkan kata laluan lama" required>
              </div>
            </div>

            <hr class="text-black-50 my-4">

<div class="mb-3">
    <label class="form-label fw-bold text-secondary small">KATA LALUAN BAHARU</label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
        <input type="password" id="new_password" name="new_password" class="form-control border-start-0 bg-light" placeholder="Minimum 12 aksara" required>
    </div>
    <div id="password-requirements" class="small mt-2">
        <div id="req-length" class="text-danger"><i class="bi bi-x-circle me-1"></i> Minimum 12 aksara</div>
        <div id="req-upper" class="text-danger"><i class="bi bi-x-circle me-1"></i> Huruf besar (A-Z)</div>
        <div id="req-lower" class="text-danger"><i class="bi bi-x-circle me-1"></i> Huruf kecil (a-z)</div>
        <div id="req-number" class="text-danger"><i class="bi bi-x-circle me-1"></i> Nombor (0-9)</div>
        <div id="req-symbol" class="text-danger"><i class="bi bi-x-circle me-1"></i> Simbol (@$!%*?&)</div>
    </div>
</div>

<div class="mb-2">
  <label class="form-label fw-bold text-secondary small">SAHKAN KATA LALUAN BAHARU</label>
  <div class="input-group">
    <span class="input-group-text bg-light border-end-0"><i class="bi bi-check-all text-muted"></i></span>
    <input type="password" id="confirm_password" name="confirm_password" class="form-control border-start-0 bg-light" placeholder="Taip semula kata laluan baharu" required>
  </div>
  <div id="match-error" class="small mt-2 d-none">
    <span class="text-danger"><i class="bi bi-exclamation-circle me-1"></i> Kata laluan tidak sepadan.</span>
  </div>
</div>

          </div>

          <div class="modal-footer border-0 p-3 bg-light rounded-bottom">
            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary px-4 shadow-sm">
              <i class="bi bi-save me-1"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script>
const passwordInput = document.getElementById('new_password');
const confirmInput = document.getElementById('confirm_password');
const matchError = document.getElementById('match-error');

// Objek Kriteria (dari kod sebelum ini)
const requirements = {
    length: { el: document.getElementById('req-length'), regex: /.{12,}/ },
    upper:  { el: document.getElementById('req-upper'),  regex: /[A-Z]/ },
    lower:  { el: document.getElementById('req-lower'),  regex: /[a-z]/ },
    number: { el: document.getElementById('req-number'), regex: /[0-9]/ },
    symbol: { el: document.getElementById('req-symbol'), regex: /[@$!%*?&]/ }
};

function validateAll() {
    const passVal = passwordInput.value;
    const confirmVal = confirmInput.value;
    let isComplexityValid = true;

    // 1. Semak Kompleksiti (12 aksara, simbol, dll)
    for (const key in requirements) {
        const item = requirements[key];
        const isValid = item.regex.test(passVal);
        
        if (isValid) {
            item.el.classList.replace('text-danger', 'text-success');
            item.el.querySelector('i').classList.replace('bi-x-circle', 'bi-check-circle');
        } else {
            item.el.classList.replace('text-success', 'text-danger');
            item.el.querySelector('i').classList.replace('bi-check-circle', 'bi-x-circle');
            isComplexityValid = false;
        }
    }

    // 2. Semak Padanan (Matching)
    if (confirmVal === "") {
        matchError.classList.add('d-none');
        confirmInput.setCustomValidity("Sila sahkan kata laluan");
    } else if (passVal !== confirmVal) {
        matchError.classList.remove('d-none');
        confirmInput.classList.add('is-invalid');
        confirmInput.setCustomValidity("Kata laluan tidak sepadan");
    } else {
        matchError.classList.add('d-none');
        confirmInput.classList.remove('is-invalid');
        confirmInput.classList.add('is-valid');
        confirmInput.setCustomValidity("");
    }

    // Halang submit jika kompleksiti tidak lepas
    if (!isComplexityValid) {
        passwordInput.setCustomValidity("Katalaluan tidak memenuhi syarat");
    } else {
        passwordInput.setCustomValidity("");
    }
}

// Jalankan fungsi setiap kali pengguna menaip
passwordInput.addEventListener('input', validateAll);
confirmInput.addEventListener('input', validateAll);
</script>
  
  <?= view_cell('\App\Cells\UserCell::paparkanProfil') ?>