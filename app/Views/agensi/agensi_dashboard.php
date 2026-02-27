<!-- Main content -->


<section class="content">


  <main id="main" class="main">

   <div class="pagetitle">
    <h4 class="fw-bold text-uppercase">
        Dashboard: <?= $agency['nama_agensi_induk'] ?? 'Agensi Tidak Dikenali' ?>
    </h4>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('agensi') ?>">Utama</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>


    <section class="section">
      <div class="row">
        <div class="row mb-12">
                <div class="col-md-4">
                    <div class="card card-stats p-3 shadow-sm">
                        <span class="text-muted small fw-bold">TOTAL UNIT</span>
                        <h3 class="fw-bold text-dark"><?= number_format($stats['total_unit']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats p-3 shadow-sm border-success" style="border-left-color: #198754;">
                        <span class="text-muted small fw-bold">UNIT DIHUNI</span>
                        <h3 class="fw-bold text-success"><?= number_format($stats['total_dihuni']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats p-3 shadow-sm border-danger" style="border-left-color: #dc3545;">
                        <span class="text-muted small fw-bold">UNIT KOSONG</span>
                        <h3 class="fw-bold text-danger"><?= number_format($stats['total_kosong']) ?></h3>
                    </div>
                </div>
               
            </div>

            

        <div class="col-lg-10">

   




    </section>

    </form>


    </div>



    <section class="section">

      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            </p>
            <div class="card-body">



<div class="container-fluid">
    <div class="row">
       
<?php if($latestDate): ?>
<div class="card border shadow-sm rounded-4 mb-4">
    <div class="card-body p-2">
        <div class="d-flex align-items-center justify-content-between">

        
            
  <?php 
    $bulanSemasa = (int)date('m');
    $tahunSemasa = (int)date('Y');
    
    // Semak jika laporan sudah dihantar untuk bulan semasa
    $isHantarBulanSemasa = (!empty($latestDate) && 
                            (int)$latestDate['bulan'] == $bulanSemasa && 
                            (int)$latestDate['tahun'] == $tahunSemasa);

    // Semak jika draf wujud untuk bulan semasa
    $isDrafBulanSemasa = (!empty($latestDateDraf) && 
                          (int)($latestDateDraf['bulan'] ?? 0) == $bulanSemasa && 
                          (int)($latestDateDraf['tahun'] ?? 0) == $tahunSemasa);
?>

<div class="d-flex align-items-center">
    <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
        <i class="bi bi-calendar3" style="font-size: 24px;"></i>
    </div>

   <?php if ($isHantarBulanSemasa): ?>
    <div>
        <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 1px; font-size: 11px;">
           Status Laporan Terkini
        </div>
        <div class="d-flex align-items-center mt-1">
            <div class="fs-5 fw-bold text-dark">
                <?= strtoupper($bulan_melayu[$bulanSemasa]) ?> <span class="text-primary"><?= $tahunSemasa ?></span>
            </div>
            
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle ms-3 d-flex align-items-center" 
                  style="font-size: 10px; font-weight: 700; padding: 4px 10px; letter-spacing: 0.3px;">
                <i class="bi bi-check-circle-fill me-1" style="font-size: 11px;"></i> 
                TELAH DIHANTAR
            </span>
        </div>
    </div>

    <?php else: ?>
        <div>
            <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 1px; font-size: 11px;">Laporan Terakhir Dihantar</div>
            <?php if (!empty($latestDate)): ?>
                <div class="fs-5 fw-bold text-dark">
                    <?= strtoupper($bulan_melayu[(int)$latestDate['bulan']]) ?> <span class="text-primary"><?= $latestDate['tahun'] ?></span>
                </div>
            <?php else: ?>
                <div class="fs-5 fw-bold text-muted">TIADA REKOD</div>
            <?php endif; ?>
        </div>

        <div class="border-start mx-4 d-none d-md-block" style="height: 35px; border-color: #dee2e6 !important;"></div>

        <div>
            <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 1px; font-size: 11px;">
                Status Laporan 
                <span class="text-primary fw-black ms-1" style="font-size: 14px;">
                    <?= strtoupper($bulan_melayu[$bulanSemasa] ?? 'SEMASA') ?> 
                    <span class="text-dark"><?= $tahunSemasa ?></span>
                </span>
            </div>
            
            <div class="d-flex align-items-center mt-1">
                <?php if ($isDrafBulanSemasa): ?>
                    <?php 
                        $status_val = (int)($latestDateDraf['status'] ?? 0);
                        $status_class = ($status_val === 2) ? 'success' : 'warning';
                    ?>
                    <span class="badge bg-<?= $status_class ?>-subtle text-<?= $status_class ?> border border-<?= $status_class ?>-subtle px-3 py-1 rounded-pill small text-uppercase">
                        <?= $latestDateDraf['status_label'] ?? 'DRAF' ?>
                    </span>
                <?php else: ?>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-3 small text-uppercase">
                        <i class="bi bi-exclamation-circle me-1"></i> Belum Dimulakan
                    </span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

            <div class="me-2" style="width: 300px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-start-0 rounded-end-pill" placeholder="Cari negeri...">
                </div>
            </div>

        </div>
    </div>
</div>
<?php endif; ?>
            

           <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>NEGERI</th>
                <th class="text-center">DIHUNI</th>
                <th class="text-center">KOSONG</th>
                <th class="text-center">JUMLAH KUARTERS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($laporanNegeri)): ?>
                <?php foreach ($laporanNegeri as $row): ?>
                <tr>
                    <td class="fw-bold text-uppercase">
                        <?= $row['state_description'] ?>
                    </td>
                    <td class="text-center">
                        <?= number_format($row['total_dihuni']) ?>
                    </td>
                    <td class="text-center text-danger">
                        <?= number_format($row['total_kosong']) ?>
                    </td>
                    <td class="text-center fw-bold text-primary">
                        <?= number_format($row['jumlah_kuarters']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">
                        <?php 
                            $nama_bulan = $bulan_melayu[(int)($latestDate['bulan'] ?? 0)] ?? 'Pilihan';
                            $tahun = $latestDate['tahun'] ?? date('Y');
                        ?>
                        Tiada data bagi bulan <?= $nama_bulan ?> <?= $tahun ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
        
        <?php if (!empty($laporanNegeri)): ?>
        <tfoot class="table-light fw-bold border-top border-dark">
            <tr>
                <td class="text-end">JUMLAH KESELURUHAN:</td>
                <td class="text-center">
                    <?= number_format($stats['total_dihuni']) ?>
                </td>
                <td class="text-center text-danger">
                    <?= number_format($stats['total_kosong']) ?>
                </td>
                <td class="text-center text-primary" style="font-size: 1.1rem;">
                    <?= number_format($stats['total_unit']) ?>
                </td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</div>

        
    </div>
</div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

  <script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toUpperCase();
    let rows = document.querySelector("table tbody").rows;

    for (let i = 0; i < rows.length; i++) {
        let firstCol = rows[i].cells[0].textContent.toUpperCase();
        if (firstCol.indexOf(filter) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }      
    }
});
</script>