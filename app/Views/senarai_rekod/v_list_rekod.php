<!-- Main content -->


<section class="content">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Senarai CR</h1>
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
                      <label for="floatingName">Nombor Fail</label>
                    </div>
                  </div>

                  <!-- No HP input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingperkara" name="perkara" placeholder="Perkara/Tajuk">
                      <label for="floatingperkara">Perkara/Tajuk</label>
                    </div>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatinglokasi" name="lokasi" placeholder="Lokasi">
                      <label for="floatinglokasi">Lokasi</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingNoHp" name="bil_lampiran" placeholder="Bilangan Lampiran">
                      <label for="floatingNoHp">Bilangan Lampiran</label>
                    </div>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingNoHp" name="kotak" placeholder="Kotak">
                      <label for="floatingNoHp">Kotak</label>
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




              <h4>Senarai Rekod</h4>

              <!-- Table with stripped rows -->
              <table id="example1" class="table table-bordered table-striped datatable">
                <thead>
                  <tr>
                    <th>Bil</th>
                    <th>No Fail</th>
                    <th>Tajuk/Perkara</th>
                   
                    <th>Tindakan</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $bil = 1;
                  if (isset($list_cr) && !empty($list_cr)) {
                    foreach ($list_cr as $row) {
                  ?>
                      <tr>
                        <td width="5%"><?= $bil++ ?>.</td>
                        <td width="10%"><?php echo $row['no_fail']; ?></td>
                        <td width="30%"><?php echo $row['perkara']; ?></td>
                       
                        <td width="10%">
                          <div class="btn-group">

                            <!-- <//?php if (//$row['status_cr'] == 3) : ?>
                              <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $row['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                              </button>
                            <//?php endif; ?> -->

                            <button type="button" class="btn btn-warning btn-m2" data-bs-toggle="modal" data-bs-target="#modal-sah<?= $row['id'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </button>


                          </div>

                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="7" align="center">Tiada Maklumat</td>
                    </tr>
                  <?php } ?>
              </table>
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