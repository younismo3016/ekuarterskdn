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
        <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm">
                        <span class="text-muted small fw-bold">TOTAL UNIT</span>
                        <h3 class="fw-bold text-dark"><?= number_format($stats['total_unit']) ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm border-success" style="border-left-color: #198754;">
                        <span class="text-muted small fw-bold">UNIT DIHUNI</span>
                        <h3 class="fw-bold text-success"><?= number_format($stats['total_dihuni']) ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm border-danger" style="border-left-color: #dc3545;">
                        <span class="text-muted small fw-bold">UNIT KOSONG</span>
                        <h3 class="fw-bold text-danger"><?= number_format($stats['total_kosong']) ?></h3>
                    </div>
                </div>
               
            </div>

            

        <div class="col-lg-10">

      <?php if($latestDate): ?>
<div class="d-flex align-items-center mb-4">
    <div class="badge bg-white text-primary border shadow-sm px-3 py-2 rounded-3 d-flex align-items-center">
        <div class="bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
            <i class="bi bi-calendar-check" style="font-size: 14px;"></i>
        </div>
        <span class="text-muted small fw-bold me-1">Data Setakat:</span> 
        <span class="fw-bold text-dark">
            <?= strtoupper($bulan_melayu[(int)$latestDate['bulan']]) ?> <?= $latestDate['tahun'] ?>
        </span>
    </div>
</div>
<?php endif; ?>




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
       

            

            <div class="table-responsive shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Senarai Kuarters & Status Semasa</h5>
                    <input type="text" class="form-control form-control-sm w-25" placeholder="Cari kod atau lokasi...">
                </div>
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>KOD</th>
                            <th>NAMA KUARTERS (B)</th>
                            <th>DAERAH</th>
                            <th class="text-center">DIHUNI (G)</th>
                            <th class="text-center">ROSAK (I)</th>
                            <th class="text-center">VALIDITY</th>
                            <th>KOS RM (Y)</th>
                            <th class="text-center">TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">KDN76</td>
                            <td>Penjara Sungai Udang</td>
                            <td>Sg Udang</td>
                            <td class="text-center">454</td>
                            <td class="text-center text-danger">0</td>
                            <td class="text-center text-success fw-bold">TRUE</td>
                            <td class="fw-bold">500,000.00</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-maroon">KDN83</td>
                            <td>Penjara Simpang Renggam</td>
                            <td>Simpang Renggam</td>
                            <td class="text-center">380</td>
                            <td class="text-center text-danger">317</td>
                            <td class="text-center text-danger fw-bold">FALSE</td>
                            <td class="fw-bold">1,000,000.00</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">KDN88</td>
                            <td>Pusat Koreksional Perlis</td>
                            <td>Kangar</td>
                            <td class="text-center">133</td>
                            <td class="text-center text-danger">0</td>
                            <td class="text-center text-success fw-bold">TRUE</td>
                            <td class="fw-bold text-muted">0.00</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 p-2 bg-light rounded border border-info">
                    <i class="bi bi-info-circle-fill text-info me-2"></i>
                    <small class="text-muted">Nota: Data KDN83 menunjukkan status <strong>FALSE</strong> pada lajur Validity kerana perbezaan data fizikal dan hunian.</small>
                </div>
            </div>

        
    </div>
</div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>















  


    <!-- tutup modal -->





  </main>