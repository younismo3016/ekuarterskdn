<!-- Main content -->


<section class="content">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pengurusan Kuarters</h1>
      <nav>

      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-10">

          <div class="card">
            <form name="carian" action="<?= site_url() ?>/kuarters/list_kuarters" method="post">
              <div class="card-body">
                <!-- Add margin-top to create spacing between the form and the card border -->
                <div class="row mt-4">
                  <!-- Name input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingName" name="kod_kuarters" placeholder="Kod Kuarters" value="<?= set_value('kod_kuarters') ?>">
                      <label for="floatingName">Kod Kuarters</label>
                    </div>
                  </div>

                  <!-- No HP input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingNoHp" name="nama_kuarters" value="<?= set_value('nama_kuarters') ?>" placeholder="Nama Kuarters">
                      <label for="floatingNoHp">Nama Kuarters</label>
                    </div>
                  </div>


                </div>

                <div class="row">
                  <!-- kiri Peranan (Role) dropdown -->
                  <div class="col-md-6">


                  </div>
                  <!-- kanan  -->


                </div>
                <div class="row">


                </div>
                <!-- kanan  -->





                <!-- Button positioned at the bottom -->
                <div class="row">
                  <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">
                      <i class="bi bi-search me-1"></i>Cari
                    </button>
                  </div>
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
              <div class="card-body position-relative">
                <button type="button" class="btn btn-success btn position-absolute top-0 end-0"
                  data-bs-toggle="modal" data-bs-target="#modal-tambah">
                  Tambah Pegguna <i class="bi bi-person-plus"></i>
                </button>

                <!-- Other content inside the div -->

              </div>

              <h4>Senarai Carian</h4>

              <!-- Table with stripped rows -->
              <table id="example1" class="table table-bordered table-striped datatable">
                <thead>
                  <tr>
                    <th>Bil</th>
                    <th>Nama Kuarters</th>
                    <th>Kod Kuarters</th>
                    <th>Jenis Kuarters</th>
                    <th>Tahun Siap</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $bil = 1;
                  if (isset($list_kuarters) && !empty($list_kuarters)) {
                    foreach ($list_kuarters as $row) {
                  ?>
                      <tr>
                        <td width="5%"><?= $bil++ ?>.</td>
                        <td><?= $row['nama_kuarters'] ?></td>
                        <td><?= (!empty($row['kod_kuarters'])) ? $row['kod_kuarters'] : "-" ?></td>
                        <td><?= $row['senarai_kelas'] ?></td>
                        <td><?= $row['tahun_siap'] ?></td>
                      
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm">
                              <i class="fa fa-sticky-note-o"></i>
                            </button>
                            
                            <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable<?= $row['id_kuarters'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-m2" data-bs-toggle="modal" data-bs-target="#modal-password<?= $row['id_kuarters'] ?>">
                              <i class="bi bi-lock"></i>
                            </button>
                          </div>

                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="6" align="center">Tiada Maklumat</td>
                    </tr>
                  <?php } ?>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Modal Dialog Scrollable -->

    <?php
    foreach ($kuarters as $row) {
    ?>
    
      <div class="modal fade" id="modalDialogScrollable<?= $row['id_kuarters'] ?>" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Kemaskini Kuarters</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php echo form_open('Admin/edit_kuarters/' . $row['id_kuarters']); ?>

              <div class="col-md-12">
                <!-- Name input with form-floating -->
                <div class="row">

          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input type="text" class="form-control"
                     name="nama_kuarters"
                     value="<?= $row['nama_kuarters'] ?>">
              <label>Nama Kuarters</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input type="text" class="form-control"
                     name="kod_kuarters"
                     value="<?= $row['kod_kuarters'] ?>">
              <label>Kod Kuarters</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating mb-3">
              <input type="text" class="form-control"
                     name="jenis_kuarters"
                     value="<?= $row['jenis_kuarters'] ?>">
              <label>Jenis Kuarters</label>
            </div>
          </div>
              <div class="col-md-6">
                  <div class="form-control mb-3">
                        <label for="floatingLevel">Agensi</label>
                        <select id="id_agensi_induk" name="id_agensi_induk" class="form-control" style="width: 100%;">
                          <option value="">--sila pilih--</option>
                          <?php foreach ($list_agensi as $agensi): ?>
                            <option value="<?= $agensi['id_agensi_induk'] ?>"
                              <?= ($row['id_agensi_induk'] ?? '') == $agensi['id_agensi_induk'] ? 'selected' : '' ?>>
                              <?= $agensi['nama_agensi_induk'] ?>
                            </option>
                          <?php endforeach; ?>

                        </select>

                  </div>
              </div>

        </div>


                

                <div class="form-control mb-3">
                  <label for="floatingLevel">Sub Agensi</label>
                  <select id="id_sub_agensi" name="id_sub_agensi" class="form-control " style="width: 100%;">
                    <option value="">--sila pilih--</option>
                    <?php foreach ($list_sub_agensi as $sub_agensi): ?>
                      <option value="<?= $sub_agensi['id_sub_agensi'] ?>"
                        <?= ($row['id_sub_agensi'] ?? '') == $sub_agensi['id_sub_agensi'] ? 'selected' : '' ?>>
                        <?= $sub_agensi['nama_sub_agensi'] ?>
                      </option>
                    <?php endforeach; ?>

                  </select>

                </div>

                <div class="form-control mb-3">
                  <label for="floatingLevel">Sub Agensi</label>
                  <select id="id_sub_agensi" name="id_sub_agensi" class="form-control " style="width: 100%;">
                    <option value="">--sila pilih--</option>
                    <?php foreach ($list_sub_agensi as $sub_agensi): ?>
                      <option value="<?= $sub_agensi['id_sub_agensi'] ?>"
                        <?= ($row['id_sub_agensi'] ?? '') == $sub_agensi['id_sub_agensi'] ? 'selected' : '' ?>>
                        <?= $sub_agensi['nama_sub_agensi'] ?>
                      </option>
                    <?php endforeach; ?>

                  </select>

                </div>
                <div class="form-control mb-3">
                  <label for="floatingLevel">Sub Agensi</label>
                  <select id="id_sub_agensi" name="id_sub_agensi" class="form-control " style="width: 100%;">
                    <option value="">--sila pilih--</option>
                    <?php foreach ($list_sub_agensi as $sub_agensi): ?>
                      <option value="<?= $sub_agensi['id_sub_agensi'] ?>"
                        <?= ($row['id_sub_agensi'] ?? '') == $sub_agensi['id_sub_agensi'] ? 'selected' : '' ?>>
                        <?= $sub_agensi['nama_sub_agensi'] ?>
                      </option>
                    <?php endforeach; ?>

                  </select>

                </div>
                <div class="form-control mb-3">
                  <label for="floatingLevel">Sub Agensi</label>
                  <select id="id_sub_agensi" name="id_sub_agensi" class="form-control " style="width: 100%;">
                    <option value="">--sila pilih--</option>
                    <?php foreach ($list_sub_agensi as $sub_agensi): ?>
                      <option value="<?= $sub_agensi['id_sub_agensi'] ?>"
                        <?= ($row['id_sub_agensi'] ?? '') == $sub_agensi['id_sub_agensi'] ? 'selected' : '' ?>>
                        <?= $sub_agensi['nama_sub_agensi'] ?>
                      </option>
                    <?php endforeach; ?>

                  </select>

                </div>
                <div class="form-control mb-3">
                  <label for="floatingLevel">Sub Agensi</label>
                  <select id="id_sub_agensi" name="id_sub_agensi" class="form-control " style="width: 100%;">
                    <option value="">--sila pilih--</option>
                    <?php foreach ($list_sub_agensi as $sub_agensi): ?>
                      <option value="<?= $sub_agensi['id_sub_agensi'] ?>"
                        <?= ($row['id_sub_agensi'] ?? '') == $sub_agensi['id_sub_agensi'] ? 'selected' : '' ?>>
                        <?= $sub_agensi['nama_sub_agensi'] ?>
                      </option>
                    <?php endforeach; ?>

                  </select>

                </div>



                <!-- Peranan (Role) dropdown -->
                



                <!-- Password input with form-floating -->

              </div>

              <!-- Modal footer with submit button -->



            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </div><!-- End Modal Dialog Scrollable-->
      <?php echo form_close(); ?>
    <?php } ?>

    <div class="modal fade" id="modal-tambah" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>



          <div class="modal-body">
            <?php echo form_open('Admin/add_user'); ?>

            <div class="col-md-12">
              <!-- Name input with form-floating -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" name="nama_penuh" value="" placeholder="Nama">
                <label for="floatingName">Nama</label>
              </div>

              <!-- Email input with form-floating -->
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" name="email" value="" placeholder="Email">
                <label for="floatingEmail">Email</label>
              </div>

              <!-- No HP input with form-floating -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingNoHp" name="no_tel" value="" placeholder="No HP">
                <label for="floatingNoHp">No HP</label>
              </div>

              <!-- Bahagian (Role) dropdown -->
              <div class="form-floating mb-3">
                <select id="id_agensi_induk" name="id_agensi_induk" class="form-control select2" style="width: 100%;">
                  
                  <option value="">--sila pilih--</option>
                    <?php foreach ($list_agensi as $row): ?>
                    <option value="<?= $row['id_agensi_induk']  ?>"><?= $row['nama_agensi_induk'] ?></option>

                  <?php endforeach; ?>

                </select>
                <label for="floatingLevel">Agensi</label>
              </div>

              <div class="form-floating mb-3">
                <select id="id_sub_agensi" name="id_sub_agensi" class="form-control select2" style="width: 100%;">
                  
                  <option value="">--sila pilih--</option>
                    <?php foreach ($list_sub_agensi as $row): ?>
                    <option value="<?= $row['id_sub_agensi']  ?>"><?= $row['nama_sub_agensi'] ?></option>
                  <?php endforeach; ?>

                </select>
                <label for="floatingLevel">Sub Agensi</label>
              </div>

             

              <!-- Peranan (Role) dropdown -->
              



              <!-- Password input with form-floating -->

            </div>

            <!-- Modal footer with submit button -->



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>


   


  </main>
</section>
<!-- End Main content -->
 