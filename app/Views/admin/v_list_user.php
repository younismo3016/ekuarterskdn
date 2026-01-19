<!-- Main content -->


<section class="content">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pengurusan Pengguna</h1>
      <nav>

      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-10">

          <div class="card">
            <form name="carian" action="<?= site_url() ?>/admin/list_user" method="post">
              <div class="card-body">
                <!-- Add margin-top to create spacing between the form and the card border -->
                <div class="row mt-4">
                  <!-- Name input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingName" name="nama_penuh" placeholder="Nama" value="<?= set_value('nama_penuh') ?>">
                      <label for="floatingName">Nama</label>
                    </div>
                  </div>

                  <!-- No HP input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingNoHp" name="email" value="<?= set_value('email') ?>" placeholder="Email">
                      <label for="floatingNoHp">Email</label>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aktiviti</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $bil = 1;
                  if (isset($pengguna) && !empty($pengguna)) {
                    foreach ($pengguna as $row) {
                  ?>
                      <tr>
                        <td width="5%"><?= $bil++ ?>.</td>
                        <td><?= $row['nama_penuh'] ?>
                        </td>
                        <td><?= (!empty($row['email'])) ? $row['email'] : "-" ?></td>
                        <td>
                          <?php echo get_peranan($row['level']); ?>
                        </td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm">
                              <i class="fa fa-sticky-note-o"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" onclick="window.location.href='<?= site_url() ?>/admin/user/edit_user/<?= $row['id_user'] ?>';"> -->
                            <!-- <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" onclick="window.location.href='<?= site_url(route_to('user.edit', $row['id_user'])) ?>';">
    <i class="bi bi-pencil-square"></i>
  </button> -->
                            <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable<?= $row['id_user'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-m2" data-bs-toggle="modal" data-bs-target="#modal-password<?= $row['id_user'] ?>">
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
    foreach ($pengguna as $row) {
    ?>
      <div class="modal fade" id="modalDialogScrollable<?= $row['id_user'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Kemaskini Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php echo form_open('Admin/edit_user/' . $row['id_user']); ?>

              <div class="col-md-12">
                <!-- Name input with form-floating -->
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="nama_penuh" name="nama_penuh" value="<?= $row['nama_penuh']  ?>" placeholder="Nama">
                  <label for="floatingName">Nama</label>
                </div>

                <!-- Email input with form-floating -->
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="email" name="email" value="<?= $row['email']  ?>" placeholder="Email">
                  <label for="floatingEmail">Email</label>
                </div>

                <!-- No HP input with form-floating -->
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="no_tel" name="no_tel" value="<?= $row['no_tel']  ?>" placeholder="No HP">
                  <label for="floatingNoHp">No HP</label>
                </div>


                <div class="form-control mb-3">
                  <label for="floatingLevel">Bahagian</label>
                  <select id="id_bahagian" name="id_bahagian" class="form-control " style="width: 100%;">
                    <option value="">--sila pilih--</option>
                    <?php foreach ($list_bahagian as $bahagian): ?>
                      <option value="<?= $bahagian['id_bahagian'] ?>"
                        <?= ($row['id_bahagian'] == $bahagian['id_bahagian']) ? 'selected' : '' ?>>
                        <?= $bahagian['nama_bahagian'] ?>
                      </option>
                    <?php endforeach; ?>

                  </select>

                </div>



                <!-- Peranan (Role) dropdown -->
                <div class="form-floating mb-3">
                  <select id="level" name="level" class="form-control" style="width: 100%;">
                    <option value="">--sila pilih--</option>
                    <?php foreach ($list_level as $level): ?>
                      <option value="<?= $level['id_peranan'] ?>"
                        <?= ($row['level'] == $level['id_peranan']) ? 'selected' : '' ?>>
                        <?= $level['peranan'] ?>
                      </option>
                    <?php endforeach; ?>

                  </select>
                  <label for="floatingLevel">Peranan</label>
                </div>



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
                <select id="id_bahagian" name="id_bahagian" class="form-control select2" style="width: 100%;">
                  
                  <option value="">--sila pilih--</option>
                    <?php foreach ($list_bahagian as $row): ?>
                    <option value="<?= $row['id_bahagian']  ?>"><?= $row['nama_bahagian'] ?></option>

                  <?php endforeach; ?>

                </select>
                <label for="floatingLevel">Bahagian</label>
              </div>

             

              <!-- Peranan (Role) dropdown -->
              <div class="form-floating mb-3">
                <select id="floatingLevel" name="level" id="level" class="form-select">
                  <option value="">--Sila Pilih--</option>
                  <?php foreach ($list_level as $row): ?>
                    <option value="<?= $row['id_peranan']  ?>"><?= $row['peranan'] ?></option>

                  <?php endforeach; ?>
                 
                </select>
                <label for="floatingLevel">Peranan</label>
              </div>



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


    <?php
    foreach ($pengguna as $row) {
    ?>
      <div class="modal fade" id="modal-password<?= $row['id_user'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Kemaskini Kata Laluan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php echo form_open('Admin/edit_password/' . $row['id_user']); ?>

              <div class="col-md-12">
                <!-- Name input with form-floating -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingName" name="password" value="" placeholder="Password">
                  <label for="floatingName">Password</label>
                </div>




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
    <?php } ?>


  </main>