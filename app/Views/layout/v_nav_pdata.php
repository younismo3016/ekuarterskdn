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
        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= site_url('admin/senarai_cr') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(ADMIN)</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('admin/senarai_cr_pemohon') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(Pemohon)</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('admin/senarai_cr_kpsu') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(KPSU)</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('admin/senarai_cr_psu') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(PSU)</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('admin/senarai_cr_pptm') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(PPTM)</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('admin/senarai_cr_pengesah') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(Pengesah)</span>
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


<?php } ?><!-- KPSU-->
<?php if (session()->get('level') == 3) { ?>

  <a class="nav-link collapsed" href="<?= site_url('admin/landing') ?>">
          <i class="bi bi-house-fill"></i>
          <span>Selamat Datang</span>
        </a>
  </li><!-- End Dashboard Nav -->

  

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
      
      <li>
        <a href="<?= site_url('Senaraicr/senarai_cr_kpsu')?>">
          <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(KPSU)</span>
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
    <a class="nav-link collapsed" href="<?= site_url('admin/list_user')?>">
      <i class="bi bi-person"></i>
      <span>Pengguna</span>
    </a>
    <a class="nav-link collapsed" href="<?= site_url('admin/list_sistem')?>">
      <i class="bi bi-person"></i>
      <span>Sistem</span>
    </a>
  </li><!-- End Profile Page Nav -->

  

</ul>

</aside>

<?php } ?>
<?php if (session()->get('level') == 4) { ?>

LEVEL 4

<?php } ?>



<?php
$level = session()->get('level');
$seksyen = session()->get('id_seksyen');

if ($level == 5 && $seksyen == 'OK') {
?>
    <!-- Paparan khas untuk level 5 dan seksyen OK -->
    <a class="nav-link collapsed" href="<?= site_url('admin/landing') ?>">
          <i class="bi bi-house-fill"></i>
          <span>Selamat Datang</span>
        </a>
    </li><!-- End Dashboard Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        
        
         <li>
          <a href="<?= site_url('admin/senarai_cr_data_tindakan') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Pusat Data PSU OK</span>
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
<?php
} elseif ($level == 5) {
?>
    <!-- Paparan untuk level 5 yang bukan seksyen OK -->
    <a class="nav-link collapsed" href="<?= site_url('admin/landing') ?>">
          <i class="bi bi-house-fill"></i>
          <span>Selamat Datang</span>
        </a>
    </li><!-- End Dashboard Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        
        
         <li>
          <a href="<?= site_url('admin/senarai_cr_data_psu') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Pusat Data PSU</span>
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
<?php
}
?>


<?php
$level = session()->get('level');
$seksyen = session()->get('id_seksyen');

if ($level == 6 && $seksyen == 'OK') {
?>
    <!-- Paparan khas untuk level 5 dan seksyen OK -->
    <a class="nav-link collapsed" href="<?= site_url('admin/landing') ?>">
          <i class="bi bi-house-fill"></i>
          <span>Selamat Datang</span>
        </a>
    </li><!-- End Dashboard Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        
        
         <li>
          <a href="<?= site_url('admin/senarai_cr_data_pptm') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Pusat Data PPTM OK</span>
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
<?php
} elseif ($level == 6) {
?>
    <!-- Paparan untuk level 5 yang bukan seksyen OK -->
   <a class="nav-link collapsed" href="<?= site_url('admin/landing') ?>">
          <i class="bi bi-house-fill"></i>
          <span>Selamat Datang</span>
        </a>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#pdata-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Cr Pusat Data</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="pdata-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        
        <li>
          <a href="<?= site_url('admin/senarai_cr_data_pemohon') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Pusat Data PPTM</span>
          </a>
        </li>
         <li>
          <a href="<?= site_url('Senaraicr/landing_pdata') ?>">
            <i class="bi bi-circle"></i><span>Mohon CR</span>
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
<?php
}
?>






<?php if (session()->get('level') == 7) { ?>

<a class="nav-link collapsed" href="<?= site_url('admin')?>">
      <i class="bi bi-grid"></i>
      <span>Utama</span>
    </a>
  </li><!-- Pengesah -->

  

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
      
      <li>
        <a href="<?= site_url('admin/senarai_cr_pengesah')?>">
          <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi</span>
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
    <a class="nav-link collapsed" href="<?= site_url('admin/list_user')?>">
      <i class="bi bi-person"></i>
      <span>Pengguna</span>
    </a>
    <a class="nav-link collapsed" href="<?= site_url('admin/list_sistem')?>">
      <i class="bi bi-person"></i>
      <span>Sistem</span>
    </a>
  </li><!-- End Profile Page Nav -->

  

</ul>

</aside>

<?php } ?>
<?php if (session()->get('level') == 8) { ?>

  <a class="nav-link collapsed" href="<?= site_url('admin')?>">
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
        <a href="<?= site_url('admin/senarai_cr_pemohon')?>">
          <i class="bi bi-circle"></i><span>Senarai Cr(PEMOHON)</span>
        </a>
      </li>
      <li>
          <a href="<?= site_url('admin/senarai_cr_pemohon') ?>">
            <i class="bi bi-circle"></i><span>Senarai Cr Aplikasi(Pemohon)</span>
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
    <a class="nav-link collapsed" href="<?= site_url('admin/list_user')?>">
      <i class="bi bi-person"></i>
      <span>Pengguna</span>
    </a>
    <a class="nav-link collapsed" href="<?= site_url('admin/list_sistem')?>">
      <i class="bi bi-person"></i>
      <span>Sistem</span>
    </a>
  </li><!-- End Profile Page Nav -->

  

</ul>

</aside>

<?php } ?>