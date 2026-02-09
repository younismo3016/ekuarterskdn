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
            <i class="bi bi-shield-lock me-2"></i> Tukar Katalaluan
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="<?= site_url('changepwd/update') ?>" method="post">
          <?= csrf_field() ?>
          <div class="modal-body p-4">

            <p class="text-muted small mb-4">Pastikan katalaluan anda selamat dan sukar diteka oleh orang lain.</p>

            <div class="mb-4">
              <label class="form-label fw-bold text-secondary small">KATALALUAN LAMA</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                <input type="password" name="old_password" class="form-control border-start-0 bg-light" placeholder="Masukkan katalaluan asal" required>
              </div>
            </div>

            <hr class="text-black-50 my-4">

            <div class="mb-3">
              <label class="form-label fw-bold text-secondary small">KATALALUAN BARU</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                <input type="password" name="new_password" class="form-control border-start-0 bg-light" placeholder="Minimum 8 aksara" minlength="8" required>
              </div>
              <div id="passwordHelp" class="form-text small"><i class="bi bi-info-circle me-1"></i> Gunakan gabungan huruf dan nombor.</div>
            </div>

            <div class="mb-2">
              <label class="form-label fw-bold text-secondary small">SAHKAN KATALALUAN BARU</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-check-all text-muted"></i></span>
                <input type="password" name="confirm_password" class="form-control border-start-0 bg-light" placeholder="Taip semula katalaluan baru" required>
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


  
  <?= view_cell('\App\Cells\UserCell::paparkanProfil') ?>