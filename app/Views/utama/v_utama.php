<!-- Main content -->


<section class="content">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Utama</h1>
      <nav>

      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-10">

          <div class="card">
            <form name="carian" action="<?= site_url() ?>/admin/senarai_rekod" method="post">
              <div class="card-body">
                <!-- Add margin-top to create spacing between the form and the card border -->
                <div class="row mt-4">
                  <!-- Name input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingName" name="no_fail" placeholder="Nombor Fail">
                      <label for="floatingName">Jabatan</label>
                    </div>
                  </div>

                  <!-- No HP input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingperkara" name="perkara" placeholder="Perkara/Tajuk">
                      <label for="floatingperkara">Tahun</label>
                    </div>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatinglokasi" name="lokasi" placeholder="Lokasi">
                      <label for="floatinglokasi">Bulan</label>
                    </div>
                  </div>
                  





                  <!-- Button positioned at the bottom -->
                  <div class="row">
                    <div class="col-md-12 text-end">
                      <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>Hantar
                      </button>
                    </div>
                  </div>


                </div>
              </div>
          </div>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold">Dashboard: Utama/h4>
                    
                </div>
                <button class="btn btn-danger" onclick="window.location.href = 'report_jan2026_agensi.html'"><i class="bi bi-plus-circle me-2"></i>Kemas Kini Januari 2026</button>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm">
                        <span class="text-muted small fw-bold">TOTAL UNIT (T)</span>
                        <h3 class="fw-bold text-dark">2,158</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm border-success" style="border-left-color: #198754;">
                        <span class="text-muted small fw-bold">UNIT DIHUNI (G)</span>
                        <h3 class="fw-bold text-success">1,475</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm border-danger" style="border-left-color: #dc3545;">
                        <span class="text-muted small fw-bold">UNIT ROSAK (I)</span>
                        <h3 class="fw-bold text-danger">683</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm border-warning" style="border-left-color: #ffc107;">
                        <span class="text-muted small fw-bold">BUDGET DIPERLUKAN (Y)</span>
                        <h3 class="fw-bold text-dark">RM 4.3M</h3>
                    </div>
                </div>
            </div>

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














    <!-- buka modal 2 -->

    <?php
    foreach ($list_cr as $row) {
    ?>
      <div class="modal fade" id="modal-sah<?= $row['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Maklumat Rekod</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="col-md-12">
                <!-- Name input with form-floating -->


                <div class="card info-card customers-card">


                  <div class="card-body">
                    <h5 class="card-title"><span>Maklumat |</span> Fail </h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                      </div>
                      <div class="ps-3">

                        <span class="text-default small pt-1 fw-bold">Lokasi:</span>
                        <span class="text-muted small pt-2 ps-1"><?php echo $row['lokasi']; ?></span></br>

                        <span class="text-default small pt-1 fw-bold">Kotak:</span>
                        <span class="text-muted small pt-2 ps-1"><?php echo $row['kotak']; ?></span></br>

                        <span class="text-default small pt-1 fw-bold">Bilangan Lampiran:</span>
                        <span class="text-muted small pt-2 ps-1"><?php echo $row['bil_lampiran']; ?></span></br>




                      </div>
                    </div>

                  </div>

                </div>

                <!-- buka -->
                <div class="card info-card customers-card">


                  <div class="card-body">
                    <h5 class="card-title"><span>Tarikh |</span>Maklumat Tarikh </h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                      </div>
                      <div class="ps-3">
                        <span class="text-default small pt-1 fw-bold">Tarikh Daripada:</span>
                        <span class="text-muted small pt-2 ps-1"><?php echo $row['tarikh_daripada']; ?></span></br>
                        <span class="text-default small pt-1 fw-bold">Tarikh Kepada:</span>
                        <span class="text-muted small pt-2 ps-1"><?php echo $row['tarikh_kepada']; ?></span></br>

                      </div>
                    </div>

                  </div>

                </div>
                <!-- tutup -->











                <!-- tutup -->




              </div>

              <!-- Modal footer with submit button -->



            </div>
            <div class="modal-footer">

              <form action="<?= base_url('admin/edit_rekod/' . $row['id']) ?>" method="post">
                <?= csrf_field() ?>

                <button type="submit" class="btn btn-primary">
                  Kemaskini
                </button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

            </div>
          </div>
        </div>
      </div>


    <?php } ?>


    <!-- tutup modal -->





  </main>