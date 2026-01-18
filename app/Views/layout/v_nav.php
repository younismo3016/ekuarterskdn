<!-- ======= Sidebar 951120045400 ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">

      <?php if (session()->get('level') == 1) { ?>

        <a class="nav-link collapsed" href="<?= site_url('admin') ?>">
          <i class="bi bi-grid"></i>
          <span>Utama</span>
        </a>
    </li><!-- End Dashboard Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Pengurusan Kuarters</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= site_url('admin/senarai_rekod') ?>">
            <i class="bi bi-circle"></i><span>Senarai Aset</span>
          </a>
        </li>
         <li>
          <a href="<?= site_url('admin/add_rekod') ?>">
            <i class="bi bi-circle"></i><span>Tambah Aset</span>
          </a>
        </li>
        

      </ul>

      <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Permohonan Kuarters</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= site_url('admin/senarai_rekod') ?>">
            <i class="bi bi-circle"></i><span>Senarai Permohonan</span>
          </a>
        </li>
         <li>
          <a href="<?= site_url('admin/add_rekod') ?>">
            <i class="bi bi-circle"></i><span>Senarai Aduan Kerosakan</span>
          </a>
        </li>
        

      </ul>
    </li>
    </li><!-- End Forms Nav -->

     

    <li class="nav-heading">Administrator</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= site_url('admin/list_user') ?>">
        <i class="bi bi-person"></i>
        <span>Pengguna</span>
      </a>
    </li><!-- End Profile Page Nav -->



  </ul>

</aside><!-- End Sidebar-->


<?php } ?><!-- KPSU-->
<?php if (session()->get('level') == 2) { ?>

  <a class="nav-link collapsed" href="<?= site_url('agensi')?>">
      <i class="bi bi-grid"></i>
      <span>Utama</span>
    </a>
  </li><!-- End Dashboard Nav -->

  

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Statistik</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= site_url('agensi/agensi_statistik_list') ?>">
            <i class="bi bi-circle"></i><span>Statistik Bulanan</span>
          </a>
        </li>
        
        

      </ul>
  </li>
  <!-- End Forms Nav -->

  

  

</ul>

</aside>

<?php } ?>
<?php if (session()->get('level') == 3) { ?>



<?php } ?>
<?php if (session()->get('level') == 5) { ?>
  <a class="nav-link collapsed" href="<?= site_url('admin/landing') ?>">
          <i class="bi bi-house-fill"></i>
          <span>Selamat Datang</span>
        </a>
<a class="nav-link collapsed" href="<?= site_url('admin') ?>">
          <i class="bi bi-grid"></i>
          <span>Utama</span>
        </a>
    </li><!-- End Dashboard Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        
        
        <li>
          <a href="<?= site_url('admin/senarai_cr_psu') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(PSU)</span>
          </a>
        </li>
        
      </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="tables-general.html">
            <i class="bi bi-circle"></i><span>General Tables</span>
          </a>
        </li>
        <li>
          <a href="tables-data.html" class="active">
            <i class="bi bi-circle"></i><span>Data Tables</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
          </a>
        </li>
        <li>
          <a href="icons-remix.html">
            <i class="bi bi-circle"></i><span>Remix Icons</span>
          </a>
        </li>
        <li>
          <a href="icons-boxicons.html">
            <i class="bi bi-circle"></i><span>Boxicons</span>
          </a>
        </li>
      </ul>
    </li><!-- End Icons Nav -->

    <li class="nav-heading">Administrator</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= site_url('admin/list_user') ?>">
        <i class="bi bi-person"></i>
        <span>Pengguna</span>
      </a>
      <a class="nav-link collapsed" href="<?= site_url('admin/list_sistem') ?>">
        <i class="bi bi-person"></i>
        <span>Sistem</span>
      </a>
    </li><!-- End Profile Page Nav -->



  </ul>

</aside><!-- End Sidebar-->
<?php } ?>

<?php if (session()->get('level') == 4) { ?>

 <a class="nav-link collapsed" href="<?= site_url('admin/landing') ?>">
          <i class="bi bi-house-fill"></i>
          <span>Selamat Datang</span>
        </a>

<a class="nav-link collapsed" href="<?= site_url('admin') ?>">
          <i class="bi bi-grid"></i>
          <span>Utama</span>
        </a>
    </li><!-- pptm -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Cr Aplikasi</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        
        <li>
          <a href="<?= site_url('admin/senarai_cr_pptm') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(PPTM)</span>
          </a>
        </li>
       
        

      </ul>
    </li><!-- End Forms Nav -->
   

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="tables-general.html">
            <i class="bi bi-circle"></i><span>General Tables</span>
          </a>
        </li>
        <li>
          <a href="tables-data.html" class="active">
            <i class="bi bi-circle"></i><span>Data Tables</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
          </a>
        </li>
        <li>
          <a href="icons-remix.html">
            <i class="bi bi-circle"></i><span>Remix Icons</span>
          </a>
        </li>
        <li>
          <a href="icons-boxicons.html">
            <i class="bi bi-circle"></i><span>Boxicons</span>
          </a>
        </li>
      </ul>
    </li><!-- End Icons Nav -->

    <li class="nav-heading">Administrator</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= site_url('admin/list_user') ?>">
        <i class="bi bi-person"></i>
        <span>Pengguna</span>
      </a>
      <a class="nav-link collapsed" href="<?= site_url('admin/list_sistem') ?>">
        <i class="bi bi-person"></i>
        <span>Sistem</span>
      </a>
    </li><!-- End Profile Page Nav -->



  </ul>

</aside><!-- End Sidebar-->

<?php } ?>

