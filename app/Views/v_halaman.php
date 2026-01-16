<main id="main" class="main">
  

  <div class="pagetitle">
    <h1>Utama</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Utama</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php
$level = session()->get('level');

$baruCardClass = '';
$lulusCardClass = '';
$dalamTindakanCardClass = '';
$tutupCardClass = '';

// Contoh: hanya satu card dapat warna ikut level
if ($level == 9) {
    $baruCardClass = 'bg-warning text-dark'; // KPSU
} elseif ($level == 9) {
    $dalamTindakanCardClass = 'bg-info text-white'; // PPTM
} elseif ($level == 9) {
    $tutupCardClass = 'bg-info text-white'; // Pemohon
} elseif ($level == 9) {
    $lulusCardClass = 'bg-danger text-white'; // PSU
}
?>

<?php if (!in_array((int)session()->get('level'), [1, 7, 8])): ?>
<section class="section dashboard">
    <div class="row">
        <div class="row justify-content-end">

            <div class="col-xxl-3 col-md-3">
                <div class="card info-card sales-card <?= $baruCardClass ?>">
                    <div class="card-body">
                        <h5 class="card-title">Baru <span>| Kelulusan KPSU</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <?= $list1->baru ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-3">
                <div class="card info-card sales-card <?= $lulusCardClass ?>">
                    <div class="card-body">
                        <h5 class="card-title">Lulus <span>| Tindakan PSU</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <?= $list1->lulus_cr ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-3">
                <div class="card info-card sales-card <?= $dalamTindakanCardClass ?>">
                    <div class="card-body">
                        <h5 class="card-title">Tindakan <span>| PPTM</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <?= $list1->dalam_tindakan ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-3">
                <div class="card info-card sales-card <?= $tutupCardClass ?>">
                    <div class="card-body">
                        <h5 class="card-title">Tutup <span>| Pemohon</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <?= $list1->tutup ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Left side columns -->
        <div class="col-lg-8">
            <!-- Letak kandungan tambahan di sini -->
        </div>
        <!-- End Left side columns -->

    </div>
</section>
<?php endif; ?>


</main><!-- End #main -->