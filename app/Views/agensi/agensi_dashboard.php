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
            
            <div class="d-flex align-items-center">
                <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                    <i class="bi bi-calendar3" style="font-size: 24px;"></i>
                </div>
                <div>
                    <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 1px; font-size: 11px;">Status Laporan Terkini</div>
                    <div class="fs-5 fw-bold text-dark">
                        <?= strtoupper($bulan_melayu[(int)$latestDate['bulan']]) ?> <span class="text-primary"><?= $latestDate['tahun'] ?></span>
                    </div>
                </div>
                <div class="ms-4 border-start ps-4 d-none d-md-block">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                        <i class="bi bi-check-circle-fill me-1"></i> LAPORAN TELAH DISAHKAN
                    </span>
                </div>
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