<!-- Main content -->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
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
            <form name="carian" action="<?= site_url() ?>/kuarters/list_kuarters" method="get">
              <div class="card-body">
                <!-- Add margin-top to create spacing between the form and the card border -->
                <div class="row mt-4">
                  <!-- Name input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="kod_kuarters" value="<?= esc($carian_kod) ?>" placeholder="Kod Kuarters">
                      <label for="floatingName">Kod Kuarters</label>
                    </div>
                  </div>

                  <!-- No HP input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="nama_kuarters" value="<?= esc($carian_nama) ?>" placeholder="Nama Kuarters">
                      <label for="floatingNoHp">Nama Kuarters</label>
                    </div>
                  </div>


                </div>

                <div class="row">
                  <!-- kiri Peranan (Role) dropdown -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" id="floatingNegeri" name="id_negeri" aria-label="Pilih Negeri">
                        <option value="">-- Semua Negeri --</option>
                        <?php if (isset($list_state) && !empty($list_state)) : ?>
                          <?php foreach ($list_state as $state) : ?>
                            <option value="<?= $state['id_adm_state'] ?>" <?= (isset($carian_negeri) && $carian_negeri == $state['id_adm_state']) ? 'selected' : '' ?>>
                              <?= $state['state_description'] ?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                      <label for="floatingNegeri">Negeri</label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" id="floatingNegeri" name="id_agensi_induk" aria-label="Pilih Agensi">
                        <option value="">-- Semua Agensi --</option>
                        <?php if (isset($list_agensi) && !empty($list_agensi)) : ?>
                          <?php foreach ($list_agensi as $agensi) : ?>
                            <option value="<?= $agensi['id_agensi_induk'] ?>" <?= (isset($carian_agensi) && $carian_agensi == $agensi['id_agensi_induk']) ? 'selected' : '' ?>>
                              <?= $agensi['nama_agensi_induk'] ?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                      <label for="floatingNegeri">Agensi</label>
                    </div>
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
              <!--<div class="card-body position-relative">
                <button type="button" class="btn btn-success btn position-absolute top-0 end-0"
                  data-bs-toggle="modal" data-bs-target="#modal-tambah">
                  Tambah Kuarters <i class="bi bi-person-plus"></i>
                </button>

                 Other content inside the div 

              </div>-->

              <h4>Senarai Carian</h4>

              <!-- Table with stripped rows -->


              <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                  <tr>
                    <th width="5%">Bil</th>
                    <th>Nama Kuarters</th>
                    <th>Kod Kuarters</th>
                    <th>Jenis Kuarters/Kelas</th>
                    <th>Tahun Siap</th>
                    <th>Negeri</th>
                    <th>Daerah</th>
                    <th width="15%">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // --- LOGIK KIRAAN NOMBOR BILANGAN ---
                  // Ambil page dari URL. Jika tiada, set kepada 1.
                  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                  $perPage = 10; // Mesti sama dengan controller: ->paginate(10)

                  // Formula: (Page Semasa - 1) * Jumlah Data Per Page
                  // Page 1: (1-1)*10 = 0. Mula 1.
                  // Page 2: (2-1)*10 = 10. Mula 11.
                  $bil = 1 + ($perPage * ($page - 1));

                  if (isset($list_kuarters) && !empty($list_kuarters)) {
                    foreach ($list_kuarters as $row) {
                  ?>
                      <tr>
                        <td><?= $bil++ ?>.</td>
                        <td><?= esc($row['nama_kuarters']) ?></td>
                        <td><?= (!empty($row['kod_kuarters'])) ? esc($row['kod_kuarters']) : "-" ?></td>
                        <td><?= esc($row['senarai_kelas']) ?></td>
                        <td><?= esc($row['tahun_siap']) ?></td>

                        <td><?= get_negeri($row['id_negeri']) ?></td>
                        <td><?= get_daerah($row['id_daerah']) ?></td>

                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#modal-kelas<?= $row['id_kuarters'] ?>"
                              title="Kemaskini Jenis Kuarters">
                              <i class="bi bi-tag"></i> </button>

                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable<?= $row['id_kuarters'] ?>" title="Edit">
                              <i class="bi bi-pencil-square"></i>
                            </button>

                            
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="8" class="text-center text-muted py-3">
                        <i class="bi bi-search" style="font-size: 2rem;"></i><br>
                        Tiada Maklumat Dijumpai
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>


              <div class="row mt-3 align-items-center">

                <div class="col-md-6 col-sm-12 text-muted">
                  <?php
                  // 1. Dapatkan info dari object Pager
                  $total    = $pager->getTotal();         // Jumlah semua data (contoh: 50)
                  $perPage  = $pager->getPerPage();       // Data per page (contoh: 10)
                  $current  = $pager->getCurrentPage();   // Page sekarang (contoh: 2)

                  // 2. Kira 'Dari' (Start)
                  // Kalau total 0, start mesti 0. Kalau tak, kira: (Page-1 * 10) + 1
                  $start = ($total == 0) ? 0 : (($current - 1) * $perPage) + 1;

                  // 3. Kira 'Hingga' (End)
                  $end   = $current * $perPage;

                  // 4. Kalau 'Hingga' lebih besar dari Total, set jadi Total
                  if ($end > $total) {
                    $end = $total;
                  }
                  ?>

                  Memaparkan <b><?= $start ?></b> hingga <b><?= $end ?></b> daripada <b><?= number_format($total) ?></b> rekod
                </div>

                <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                  <?= $pager->links('default', 'bootstrap_pagination') ?>
                </div>

              </div>

              </tbody>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Modal Dialog Scrollable -->

    <?php
    foreach ($list_kuarters as $row) {
    ?>

      <div class="modal fade" id="modalDialogScrollable<?= $row['id_kuarters'] ?>" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Kemaskini Kuarters</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php echo form_open('Kuarters/edit_kuarters_proses/' . $row['id_kuarters']); ?>

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
                        value="<?= $row['senarai_kelas'] ?>" disabled>
                      <label>Jenis Kuarters</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control"
                        name="tahun_siap"
                        value="<?= $row['tahun_siap'] ?>">
                      <label>Tahun Siap</label>
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

                  <div class="col-md-6">
                    <div class="form-control mb-3">
                      <label for="floatingLevel">Sub Agensi</label>
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
                  <div class="col-md-6">
                    <div class="form-control mb-3">
                      <label for="floatingLevel">Negeri</label>
                      <select id="id_negeri" name="id_negeri" class="form-control select2-modal" style="width: 100%;">
                        <option value="">--sila pilih--</option>
                        <?php foreach ($list_state as $negeri): ?>
                          <option value="<?= $negeri['id_adm_state'] ?>"
                            <?= ($row['id_negeri'] ?? '') == $negeri['id_adm_state'] ? 'selected' : '' ?>>
                            <?= $negeri['state_description'] ?>
                          </option>
                        <?php endforeach; ?>

                      </select>

                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-control mb-3">
                      <label for="floatingLevel">Daerah</label>
                      <select id="id_daerah" name="id_daerah" class="form-control select2-modal" style="width: 100%;">
                        <option value="">--sila pilih--</option>
                        <?php foreach ($list_district as $daerah): ?>
                          <option value="<?= $daerah['id_adm_district'] ?>"
                            <?= ($row['id_daerah'] ?? '') == $daerah['id_adm_district'] ? 'selected' : '' ?>>
                            <?= $daerah['district_name'] ?>
                          </option>
                        <?php endforeach; ?>

                      </select>

                    </div>
                  </div>

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


    <?php foreach ($list_kuarters as $row) { ?>

  <div class="modal fade" id="modal-kelas<?= $row['id_kuarters'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <div class="modal-content">
        
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">
              <i class="bi bi-tags me-2"></i>Kemaskini Jenis Kuarters
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <?= form_open('Kuarters/update_kelas_process/' . $row['id_kuarters']); ?>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              
              <div class="mb-3">
                <label class="form-label text-muted">Nama Kuarters</label>
                <input type="text" class="form-control" value="<?= $row['nama_kuarters'] ?>" readonly disabled>
              </div>

         <div class="mb-3">
    <label class="form-label fw-bold">Pilih Jenis Kuarters (Kelas)</label>
    
   <?php 
    // Tukar string "1,2" kepada array [1, 2]
    $current_selected_ids = !empty($row['selected_ids']) ? explode(',', $row['selected_ids']) : []; 
?>

<select name="kategori_kuarters[]" class="tom-select" multiple>
    <?php if (isset($list_kategori) && !empty($list_kategori)) : ?>
        <?php foreach ($list_kategori as $kategori) : ?>
            <?php 
                // 1. Ambil huruf sahaja dari "A - KELAS A"
                $parts = explode(' - ', $kategori['kelas']);
                $label_huruf = trim($parts[0]);

                // 2. Bersihkan keterangan dari perkataan "KELAS" dan "Huruf" itu sendiri
                $cari = ['KELAS', $label_huruf]; 
                $keterangan_bersih = trim(str_ireplace($cari, '', $kategori['keterangan_kategori_kuarters']));
            ?>
            <option value="<?= $kategori['id_kategori_kuarters'] ?>" 
                <?= in_array($kategori['id_kategori_kuarters'], $current_selected_ids) ? 'selected' : '' ?>>
                
                <?= esc($label_huruf) ?> 
                <?php if (!empty($keterangan_bersih)): ?>
                    - <?= esc($keterangan_bersih) ?>
                <?php endif; ?>

            </option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>
</div>

            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success">
              <i class="bi bi-save me-1"></i> Simpan Perubahan
          </button>
        </div>

        <?= form_close(); ?>
      </div>
    </div>
  </div>

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

<script>
$(document).ready(function() {
    // Kita guna event 'shown.bs.modal' supaya Select2 dimulakan 
    // HANYA selepas modal muncul sepenuhnya.
    $('.modal').on('shown.bs.modal', function () {
        var modalId = $(this).attr('id');
        $(this).find('.select2-khas').select2({
            theme: 'bootstrap-5', // Jika anda guna Bootstrap 5
            placeholder: "Sila pilih...",
            allowClear: true,
            width: '100%',
            dropdownParent: $('#' + modalId) // WAJIB ada supaya dropdown muncul di atas modal
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
$(document).ready(function() {
    // Objek untuk menyimpan instance TomSelect supaya tidak berlaku duplicate init
    var tomInstances = {};

    // Apabila modal kelas dibuka
    $('.modal[id^="modal-kelas"]').on('shown.bs.modal', function () {
        var modal = $(this);
        var selectEl = modal.find('.tom-select')[0];
        
        if (selectEl && !selectEl.tomselect) {
            new TomSelect(selectEl, {
                plugins: ['remove_button'],
                create: false,
                placeholder: 'Sila pilih kelas...',
                hideSelected: true,
                dropdownParent: 'body' // Supaya menu tidak terpotong oleh modal
            });
        }
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Cari semua element dengan class tom-select
    document.querySelectorAll('.tom-select').forEach((el) => {
        new TomSelect(el, {
            plugins: ['remove_button'],
            create: false,
            persist: false,
            placeholder: 'Sila pilih kelas...',
            hideSelected: true,
        });
    });
});

// Jika anda guna Bootstrap Modal, kadangkala TomSelect perlu re-init 
// tapi biasanya kod di atas sudah memadai jika modal di-render dalam loop.
</script>

  </main>
</section>
<!-- End Main content -->