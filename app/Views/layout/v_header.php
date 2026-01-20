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
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profail Saya</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Kata Laluan</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= site_url('auth/logout') ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>

                <div class="pull-right">
                  <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->