<main id="main" class="main">

  <div class="pagetitle text-center">
    <h1>Selamat Datang</h1>
    <p>Sila pilih kategori permohonan anda.</p>
  </div>

  <style>
    .custom-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
      border-radius: 1rem;
      color: #fff;
    }

    .custom-card:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }

    .bg-rangkaian {
      background: #20c997;
    }

    /* Hijau laut */
    .bg-pusat {
      background: #0d6efd;
    }

    /* Biru */
    .bg-db {
      background: #6f42c1;
    }

    /* Ungu */
    .bg-teknikal {
      background: #fd7e14;
    }

    /* Oren */
    .bg-risiko {
      background: #dc3545;
    }

    /* Merah */

    .card-icon {
      font-size: 3rem;
    }
  </style>

  <div class="row justify-content-center mt-4">

    <!-- Rangkaian dan Keselamatan -->
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
      <div class="card custom-card bg-rangkaian text-center"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#modal-rangkaian">
        <div class="card-body">
          <div class="card-icon mb-3">
            <i class="bi bi-shield-lock-fill"></i>
          </div>
          <h5 class="card-title">Rangkaian & Keselamatan</h5>
          <p class="card-text">Permohonan berkaitan firewall, akses rangkaian,dll.</p>
        </div>
      </div>
    </div>

    <!-- Pusat Data -->
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">

      <div class="card custom-card bg-pusat text-center"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#modal-pdata">

        <div class="card-body">
          <div class="card-icon mb-3">
            <i class="bi bi-diagram-3-fill"></i>
          </div>
          <h5 class="card-title">Pusat Data</h5>
          <p class="card-text">penambahbaikan server, tambah akses,konfigurasi server dan sebagainya..</p>
        </div>
      </div>

    </div>

    <!-- Pangkalan Data -->
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
      <div class="card custom-card bg-db text-center"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#modal-pangkalandata">
        <div class="card-body">
          <div class="card-icon mb-3">
            <i class="bi bi-database-fill-gear"></i>
          </div>
          <h5 class="card-title">Pangkalan Data</h5>
          <p class="card-text">Permohonan database, akses pengguna dan konfigurasi DB.</p>
        </div>
      </div>

    </div>

    <!-- Teknikal dan Lain-lain -->
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">

      <div class="card custom-card bg-teknikal text-center"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#modal-teknikal">
        <div class="card-body">
          <div class="card-icon mb-3">
            <i class="bi bi-tools"></i>
          </div>
          <h5 class="card-title">Teknikal & Lain-lain</h5>
          <p class="card-text">Permohonan konfigurasi,bantuan teknikal dan lain-lain.</p>
        </div>
      </div>

    </div>

    <!-- Risiko / Impak / Gangguan -->
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">

      <div class="card custom-card bg-risiko text-center"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#modal-risiko">
        <div class="card-body">
          <div class="card-icon mb-3">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </div>
          <h5 class="card-title">Risiko / Gangguan</h5>
          <p class="card-text">Lapor risiko keselamatan, gangguan network dan dsb.</p>
        </div>
      </div>

    </div>

  </div>


  <!--==============================modal================================== -->


  <div class="modal fade" id="modal-pangkalandata" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pangkalan Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="modal-body">
          <?php echo form_open('Senaraicr/add_cr_pdata'); ?>

          <!-- Baris 1: Maklumat Permohonan & Tarikh -->
          <div class="row g-4">
            <div class="col-md-6">
              <h6 class="fw-bold text-orange">Maklumat Permohonan</h6>

              <div class="form-floating mb-3">
                <select name="penambahbaikan" class="form-select" id="penambahbaikan">
                  <option value="" selected disabled>Pilih Jenis</option>
                  <option value="Akses_Pengguna_Baru">Akses Pengguna Baru</option>
                  <option value="Baru">Baru</option>
                  <option value="Backup">Backup/Restore</option>
                  <option value="Migrasi">Migrasi Data</option>
                  <option value="Kemaskini">Kemaskini</option>
                  <option value="Hapus">Hapus</option>
                </select>
                <label for="penambahbaikan">Jenis Permohonan</label>
              </div>

              <div class="form-floating mb-3">
                <select name="kategori" class="form-select" id="kategori">
                  <option value="" selected disabled>Pilih Kategori</option>
                  <option value="Standard">Standard</option>
                  <option value="Normal-Minor">Normal-Minor</option>
                  <option value="Normal-Major">Normal-Major</option>
                  <option value="Kecemasan">Kecemasan</option>
                </select>
                <label for="kategori">Kategori Perubahan</label>
              </div>

              <div class="form-floating mb-3">
                <textarea class="form-control" name="justifikasi" id="justifikasi" placeholder="Tulis justifikasi" style="height: 100px"></textarea>
                <label for="justifikasi">Justifikasi</label>
              </div>
            </div>

            <div class="col-md-6">
              <h6 class="fw-bold text-orange">Tarikh & Keutamaan</h6>

              <div class="form-floating mb-3">
                <input type="text" name="tarikh_mohon" class="form-control" id="tarikh_mohon" placeholder="Tarikh Mohon" value="<?= date("Y/m/d") ?>" disabled>
                <label for="tarikh_mohon">Tarikh Mohon</label>
              </div>

              <div class="form-floating mb-3">
                <input type="date" name="tarikh_diperlukan" class="form-control" id="tarikh_diperlukan" placeholder="Tarikh Diperlukan" required value="<?= isset($tarikh_diperlukan) ? $tarikh_diperlukan : '' ?>">
                <label for="tarikh_diperlukan">Tarikh Diperlukan</label>
              </div>

              <div class="form-floating mb-3">
                <select name="keutamaan" class="form-select" id="keutamaan">
                  <option value="" selected disabled>Pilih Keutamaan</option>
                  <option value="Rendah">Rendah</option>
                  <option value="Sederhana">Sederhana</option>
                  <option value="Tinggi">Tinggi</option>
                  <option value="Kritikal">Kritikal</option>
                </select>
                <label for="keutamaan">Keutamaan</label>
              </div>
            </div>
          </div>

          <hr>

          <!-- Baris 2: Server & Penambahbaikan -->
          <div class="row g-4">
            <div class="col-md-6">
              <h6 class="fw-bold text-primary">Server</h6>

              <div class="form-floating mb-3">
                <input type="text" name="server_nama" class="form-control" id="server_nama" placeholder="Contoh: Server xxxxxx">
                <label for="server_nama">Nama Server</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" name="server_ip" class="form-control" id="server_ip" placeholder="Contoh: Server01 / 10.1.2.3">
                <label for="server_ip">IP Server</label>
              </div>

              <div class="form-floating mb-3">
                <select name="pangkalan_data" class="form-select" id="pangkalan_data">
                  <option value="" selected disabled>Pilih</option>
                  <option value="MySQL">MySQL</option>
                  <option value="MariaDB">MariaDB</option>
                  <option value="Lain-lain">Lain-lain</option>
                </select>
                <label for="pangkalan_data">Pangkalan Data</label>
              </div>

              <hr>

              <h6 class="fw-bold text-primary">Pengesahan</h6>
              <div class="form-floating mb-3">
                <select required name="id_pegawai_pengesah" id="id_pegawai_pengesah" class="form-select">
                  <option value="">Pegawai Pengesah</option>
                  <?php
                  $id_bahagian_user = $_SESSION['id_bahagian'] ?? null;
                  $list_to_use = ($id_bahagian_user == 8) ? $list_pengesah_it : $list_pengesah;
                  foreach ($list_to_use as $row): ?>
                    <option value="<?= $row['id_user'] ?>"><?= $row['nama_penuh'] ?></option>
                  <?php endforeach; ?>
                </select>
                <label for="id_pegawai_pengesah">Pegawai Pengesah</label>
              </div>
            </div>

            <div class="col-md-6">
              <h6 class="fw-bold text-success">Maklumat Penambahbaikan</h6>

              <label class="mb-2">Kebenaran Akses (IP Address)</label>
              <div id="ip-list-wrapper">
                <div class="input-group mb-2">
                  <input type="text" class="form-control ip-field" placeholder="Contoh: 192.168.1.10">
                  <button type="button" class="btn btn-outline-success btn-add-ip"><i class="bi bi-plus-circle"></i></button>
                </div>
              </div>

              <input type="hidden" name="senarai_akses_ip" id="senarai_akses_ip">
            </div>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const ipListWrapper = document.getElementById('ip-list-wrapper');
              const hiddenInput = document.getElementById('senarai_akses_ip');

              ipListWrapper.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-add-ip') || e.target.closest('.btn-add-ip')) {
                  const newInputGroup = document.createElement('div');
                  newInputGroup.className = 'input-group mb-2';
                  newInputGroup.innerHTML = `
            <input type="text" class="form-control ip-field" placeholder="Contoh: 192.168.1.10">
            <button type="button" class="btn btn-outline-danger btn-remove-ip"><i class="bi bi-dash-circle"></i></button>
          `;
                  ipListWrapper.appendChild(newInputGroup);
                }

                if (e.target.classList.contains('btn-remove-ip') || e.target.closest('.btn-remove-ip')) {
                  e.target.closest('.input-group').remove();
                }
              });

              const form = ipListWrapper.closest('form');
              if (form) {
                form.addEventListener('submit', function() {
                  const ipFields = document.querySelectorAll('.ip-field');
                  const ipValues = Array.from(ipFields)
                    .map(input => input.value.trim())
                    .filter(val => val !== '');
                  hiddenInput.value = ipValues.join(',');
                });
              }
            });
          </script>

          <!-- Hidden Input -->
          <input type="hidden" name="id_pemohon" id="id_pemohon" value="<?= session()->get('id_user') ?? '' ?>">
          <input type="hidden" name="id_bahagian" id="id_bahagian" value="<?= session()->get('id_bahagian') ?? '' ?>">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <input type="reset" class="btn btn-danger" value="Semula">
          </div>

          <?php echo form_close(); ?>
        </div>

      </div>
    </div>
  </div>

  <!-- --risiko---- -->


  <div class="modal fade" id="modal-risiko" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Risiko atau Gangguan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <?php echo form_open('Senaraicr/add_cr_rangkaian'); ?>

          <div class="row g-3">

            <div class="row g-4">
              <!-- Maklumat Permohonan CR -->
              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Maklumat Permohonan</h6>
                <div class="form-group">
                  <label>Jenis Permohonan</label>
                  <select name="penambahbaikan" class="form-control">
                    <option value="" selected disabled>Pilih Jenis</option>
                    <option value="Akses_Pengguna_Baru">Akses Pengguna Baru</option>
                    <option value="Baru">Baru</option>
                    <option value="Perubahan">Perubahan</option>
                    <option value="Kemaskini">Kemaskini</option>
                    <option value="Hapus">Hapus</option>
                  </select>



                  <label class="mt-3">Kategori Perubahan</label>
                  <select name="kategori" class="form-control">
                    <option value="" selected disabled>Pilih Kategori</option>
                    <option value="Standard">Standard</option>
                    <option value="Normal-Minor">Normal-Minor</option>
                    <option value="Normal-Major">Normal-Major</option>
                    <option value="Kecemasan">Kecemasan</option>
                  </select>
                </div>

                <label class="mt-3">Justfikasi</label>
                <textarea class="form-control" name="justifikasi" rows="2"></textarea>
              </div>

              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Tarikh & Keutamaan</h6>
                <div class="form-group">
                  <label>Tarikh Mohon</label>
                  <input type="text" name="tarikh_mohon" class="form-control" value="<?= date("Y/m/d") ?>" disabled>

                  <label class="mt-3">Tarikh Diperlukan</label>
                  <input type="date" name="tarikh_diperlukan" class="form-control" required value="<?= isset($tarikh_diperlukan) ? $tarikh_diperlukan : '' ?>">

                  <label class="mt-3">Keutamaan</label>
                  <select name="keutamaan" class="form-control">
                    <option value="" selected disabled>Pilih Keutamaan</option>
                    <option value="Rendah">Rendah</option>
                    <option value="Sederhana">Sederhana</option>
                    <option value="Tinggi">Tinggi</option>
                    <option value="Kritikal">Kritikal</option>
                  </select>
                </div>
              </div>
            </div>

            <hr>
            <div class="row g-4">
              <!-- KIRI -->
              <div class="col-md-6">


                <!-- Permohonan Tapisan Capaian Internet -->
                <h6 class="fw-bold text-primary">Permohonan Tapisan Capaian Internet</h6>
                <div class="form-group">

                  <div class="form-group">
                    <label>KEPERLUAN SHUTDOWN</label>
                    <select class="form-control" name="keperluan_shutdown">
                      <option value="">-Sila Pilih-</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>IMPAK TERHADAP PENGGUNA</label>
                    <select class="form-control" name="impak_pengguna">
                      <option value="">-Sila Pilih-</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>PEMBERITAHUAN MELALUI EMAIL</label>
                    <select class="form-control" name="pemberitahuan_email">
                      <option value="">-Sila Pilih-</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>




                </div>





              </div>

              <!-- KANAN -->
              <div class="col-md-6">
                <label class="mt-2">Tempoh Shutdown</label>
                <div class="input-group">
                  <input type="date" class="form-control" name="tempoh_dari">
                  <span class="input-group-text">hingga</span>
                  <input type="date" class="form-control" name="tempoh_hingga">
                </div>





                <hr>

                <h6 class="fw-bold text-primary">Pengesahan</h6>
                <label class="mt-2">Pegawai Pengesah</label>
                <div class="form-group">
                  <select required name="id_pegawai_pengesah" id="id_pegawai_pengesah" class="form-select">
                    <option value="">Pegawai Pengesah</option>

                    <?php
                    $id_bahagian_user = $_SESSION['id_bahagian'] ?? null;

                    $list_to_use = ($id_bahagian_user == 8) ? $list_pengesah_it : $list_pengesah;
                    ?>

                    <?php foreach ($list_to_use as $row): ?>
                      <option value="<?= $row['id_user'] ?>"><?= $row['nama_penuh'] ?></option>
                    <?php endforeach; ?>


                  </select>

                </div>

              </div>



            </div>




            <!-- Hidden Input -->
            <input type="hidden" name="id_pemohon" id="id_pemohon" value="<?= session()->get('id_user') ?? '' ?>">
            <input type="hidden" name="id_bahagian" id="id_bahagian" value="<?= session()->get('id_bahagian') ?? '' ?>">







            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <input type="reset" class="btn btn-danger" value="Semula">
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- --teknikal---- -->

  <div class="modal fade" id="modal-teknikal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Teknikal dan Lain-lain</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <?php echo form_open('Senaraicr/add_cr_teknikal'); ?>

          <div class="row g-3">

            <div class="row g-4">
              <!-- Maklumat Permohonan CR -->
              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Maklumat Permohonan</h6>
                <div class="form-floating mb-3">

                  <select name="penambahbaikan" class="form-control">
                    <option value="" selected disabled>Pilih Jenis</option>
                    <option value="Akses_Pengguna_Baru">Akses Pengguna Baru</option>
                    <option value="Baru">Baru</option>
                    <option value="Backup">Backup/Restore</option>
                    <option value="Kemaskini">Kemaskini</option>
                    <option value="Hapus">Hapus</option>
                  </select>
                  <label>Jenis Permohonan</label>
                </div>


                <div class="form-floating mb-3">

                  <select name="kategori" class="form-control">
                    <option value="" selected disabled>Pilih Kategori</option>
                    <option value="Standard">Standard</option>
                    <option value="Normal-Minor">Normal-Minor</option>
                    <option value="Normal-Major">Normal-Major</option>
                    <option value="Kecemasan">Kecemasan</option>
                  </select>
                  <label>Kategori Perubahan</label>
                </div>

                <div class="form-floating mb-3">
                  <textarea class="form-control" name="justifikasi" rows="2"></textarea>
                  <label>Justfikasi/Tujuan/Catatan</label>
                </div>

                <div class="form-floating mb-3">

                  <select name="keperluan_teknikal" class="form-control">
                    <option value="" selected disabled>-Sila Pilih-</option>
                    <option value="Perkakasan">Perkakasan</option>
                    <option value="Perisian">Perkhidmatan</option>
                    <option value="Aplikasi">Aplikasi</option>
                    <option value="Aplikasi">Lain-lain</option>
                  </select>
                  <label>Keperluan Teknikal</label>
                </div>
              </div>

              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Tarikh & Keutamaan</h6>
                <div class="form-floating mb-3">
                  
                  <input type="text" name="tarikh_mohon" class="form-control" value="<?= date("Y/m/d") ?>" disabled>
                  <label>Tarikh Mohon</label>
                </div>
                <div class="form-floating mb-3">
                  
                  <input type="date" name="tarikh_diperlukan" class="form-control" required value="<?= isset($tarikh_diperlukan) ? $tarikh_diperlukan : '' ?>">
                <label >Tarikh Diperlukan</label>
              </div>

              <div class="form-floating mb-3">
                
                  <select name="keutamaan" class="form-control">
                    <option value="" selected disabled>Pilih Keutamaan</option>
                    <option value="Rendah">Rendah</option>
                    <option value="Sederhana">Sederhana</option>
                    <option value="Tinggi">Tinggi</option>
                    <option value="Kritikal">Kritikal</option>
                  </select>
                    <label>Keutamaan</label>
                  </div>

                <hr>
                
                <div class="form-floating mb-3">
                  <select required name="id_pegawai_pengesah" id="id_pegawai_pengesah" class="form-select">
                    <option value="">Pegawai Pengesah</option>

                    <?php
                    $id_bahagian_user = $_SESSION['id_bahagian'] ?? null;

                    $list_to_use = ($id_bahagian_user == 8) ? $list_pengesah_it : $list_pengesah;
                    ?>

                    <?php foreach ($list_to_use as $row): ?>
                      <option value="<?= $row['id_user'] ?>"><?= $row['nama_penuh'] ?></option>
                    <?php endforeach; ?>


                  </select>
                      <label>Pegawai Pengesah</label>
                </div>
                </div>

            
            
            </div>









          </div>



        </div>




        <!-- Hidden Input -->
        <input type="hidden" name="id_pemohon" id="id_pemohon" value="<?= session()->get('id_user') ?? '' ?>">
        <input type="hidden" name="id_bahagian" id="id_bahagian" value="<?= session()->get('id_bahagian') ?? '' ?>">







        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="reset" class="btn btn-danger" value="Semula">
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>





  <div class="modal fade" id="modal-pdata" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pusat Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <?php echo form_open('Senaraicr/add_cr_pusatdata'); ?>

          <div class="row g-3">
            <div class="row g-4">
              <!-- Maklumat Permohonan CR -->
              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Maklumat Permohonan</h6>

                <div class="form-floating mb-3">
                  <select name="penambahbaikan" class="form-control">
                    <option value="" selected disabled>Pilih Jenis</option>
                    <option value="Akses_Pengguna_Baru">Akses Pengguna Baru</option>
                    <option value="Baru">Baru</option>
                    <option value="Backup">Backup/Restore</option>
                    <option value="Kemaskini">Kemaskini</option>
                    <option value="Hapus">Hapus</option>
                  </select>
                  <label>Jenis Permohonan</label>
                </div>

                <div class="form-floating mb-3">
                  <select name="kategori" class="form-control">
                    <option value="" selected disabled>Pilih Kategori</option>
                    <option value="Standard">Standard</option>
                    <option value="Normal-Minor">Normal-Minor</option>
                    <option value="Normal-Major">Normal-Major</option>
                    <option value="Kecemasan">Kecemasan</option>
                  </select>
                  <label>Kategori Perubahan</label>
                </div>

                <div class="form-floating mb-3">
                  <textarea class="form-control" name="justifikasi" placeholder="Tulis justifikasi di sini" style="height: 100px"></textarea>
                  <label>Justifikasi</label>
                </div>
              </div>

              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Tarikh & Keutamaan</h6>

                <div class="form-floating mb-3">
                  <input type="text" name="tarikh_mohon" class="form-control" placeholder="Tarikh Mohon" value="<?= date("Y/m/d") ?>" disabled>
                  <label>Tarikh Mohon</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="date" name="tarikh_diperlukan" class="form-control" placeholder="Tarikh Diperlukan" required value="<?= isset($tarikh_diperlukan) ? $tarikh_diperlukan : '' ?>">
                  <label>Tarikh Diperlukan</label>
                </div>

                <div class="form-floating mb-3">
                  <select name="keutamaan" class="form-control">
                    <option value="" selected disabled>Pilih Keutamaan</option>
                    <option value="Rendah">Rendah</option>
                    <option value="Sederhana">Sederhana</option>
                    <option value="Tinggi">Tinggi</option>
                    <option value="Kritikal">Kritikal</option>
                  </select>
                  <label>Keutamaan</label>
                </div>
              </div>
            </div>

            <div class="row g-4">
              <!-- Server Baru -->
              <div class="col-md-6">
                <div class="form-floating mb-2">
                  <input type="text" name="server_nama" class="form-control" placeholder="Nama Server">
                  <label>Nama Server</label>
                </div>

                <div class="form-floating mb-2">
                  <select name="jenis_server" class="form-control">
                    <option value="" disabled selected>Pilih</option>
                    <option value="Virtual">Virtual</option>
                    <option value="Fizikal">Fizikal</option>
                  </select>
                  <label>Jenis Server</label>
                </div>

                <div class="form-floating mb-2">
                  <select name="os_server" class="form-control">
                    <option value="" disabled selected>Pilih</option>
                    <option value="Windows">Windows</option>
                    <option value="CentOS">CentOS</option>
                  </select>
                  <label>Operating System</label>
                </div>

                <div class="form-floating mb-2">
                  <input type="text" name="hdd" class="form-control" placeholder="Contoh: 150">
                  <label>HDD (min 150GB)</label>
                </div>

                <div class="form-floating mb-2">
                  <input type="text" name="cpu" class="form-control" placeholder="Contoh: 8">
                  <label>CPU (Core)</label>
                </div>

                <div class="form-floating mb-2">
                  <input type="text" name="ram" class="form-control" placeholder="Contoh: 8">
                  <label>RAM (GB)</label>
                </div>

                <div class="form-floating mb-2">
                  <select name="webserver" class="form-control">
                    <option value="" disabled selected>Pilih</option>
                    <option value="Apache">Apache</option>
                    <option value="Wamp">Wamp</option>
                    <option value="Tomcat">Tomcat</option>
                    <option value="Laragon">Laragon</option>
                    <option value="Lain-lain">Lain-lain</option>
                  </select>
                  <label>Webserver</label>
                </div>

                 
              </div>

              <!-- Clone Server -->
              <div class="col-md-6">
                <div class="form-floating mb-2">
                  <select name="programing" class="form-control">
                    <option value="" disabled selected>Pilih</option>
                    <option value="PHP">PHP</option>
                    <option value="HTML">HTML</option>
                    <option value="JAVA">JAVA</option>
                    <option value="PYTHON">PYTHON</option>
                    <option value="Lain-lain">Lain-lain</option>
                  </select>
                  <label>Programming Langguange</label>
                </div>
                <div class="form-floating mb-2">
                  <select name="antivirus" class="form-control">
                    <option value="" disabled selected>Pilih</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                  </select>
                  <label>Antivirus</label>
                </div>

                <div class="mb-3">
                  <label class="mb-1">Kebenaran Akses (IP Address)</label>
                  <div id="ip-list-wrapper2">
                    <div class="input-group mb-2">
                      <input type="text" class="form-control ip-field2" placeholder="Contoh: 192.168.1.10">
                      <button type="button" class="btn btn-outline-success btn-add-ip"><i class="bi bi-plus-circle"></i></button>
                    </div>
                  </div>
                  <input type="hidden" name="senarai_akses_ip_pusatdata" id="senarai_akses_ip_pusatdata">
                </div>

                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    const ipListWrapper = document.getElementById('ip-list-wrapper2');
                    const hiddenInput = document.getElementById('senarai_akses_ip_pusatdata');

                    ipListWrapper.addEventListener('click', function(e) {
                      if (e.target.classList.contains('btn-add-ip') || e.target.closest('.btn-add-ip')) {
                        const newInputGroup = document.createElement('div');
                        newInputGroup.className = 'input-group mb-2';
                        newInputGroup.innerHTML = `
                  <input type="text" class="form-control ip-field2" placeholder="Contoh: 192.168.1.10">
                  <button type="button" class="btn btn-outline-danger btn-remove-ip"><i class="bi bi-dash-circle"></i></button>`;
                        ipListWrapper.appendChild(newInputGroup);
                      }

                      if (e.target.classList.contains('btn-remove-ip') || e.target.closest('.btn-remove-ip')) {
                        e.target.closest('.input-group').remove();
                      }
                    });

                    const form = ipListWrapper.closest('form');
                    if (form) {
                      form.addEventListener('submit', function() {
                        const ipFields = document.querySelectorAll('.ip-field2');
                        const ipValues = Array.from(ipFields)
                          .map(input => input.value.trim())
                          .filter(val => val !== '');
                        hiddenInput.value = ipValues.join(',');
                      });
                    }
                  });
                </script>

                <hr>
                <h6 class="fw-bold text-primary" >Backup (Netvault)/Clone Server/Restore Backup</h6>

                <div class="form-floating mb-2">
                  <input type="text" name="clone_ip_server" class="form-control" placeholder="Contoh: 10.1.2.4">
                  <label>Nama IP Server</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="text" name="path" class="form-control" placeholder="Contoh: /var/www/html">
                  <label>Path</label>
                </div>

                <hr>
                <h6 class="fw-bold text-primary">Pengesahan</h6>

                <div class="form-floating">
                  <select required name="id_pegawai_pengesah" id="id_pegawai_pengesah" class="form-select">
                    <option value="">Pegawai Pengesah</option>
                    <?php
                    $id_bahagian_user = $_SESSION['id_bahagian'] ?? null;
                    $list_to_use = ($id_bahagian_user == 8) ? $list_pengesah_it : $list_pengesah;
                    foreach ($list_to_use as $row): ?>
                      <option value="<?= $row['id_user'] ?>"><?= $row['nama_penuh'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <label>Pegawai Pengesah</label>
                </div>

              </div>
            </div>
          </div>
        
        </div>





        <!-- Hidden Input -->
        <input type="hidden" name="id_pemohon" id="id_pemohon" value="<?= session()->get('id_user') ?? '' ?>">
        <input type="hidden" name="id_bahagian" id="id_bahagian" value="<?= session()->get('id_bahagian') ?? '' ?>">







        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <input type="reset" class="btn btn-danger" value="Semula">
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>







  <div class="modal fade" id="modal-rangkaian" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Rangkaian dan Keselamatan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <?php echo form_open('Senaraicr/add_cr_rangkaian'); ?>

          <div class="row g-3">

            <div class="row g-4">
              <!-- Maklumat Permohonan CR -->
              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Maklumat Permohonan</h6>

                <div class="form-floating mb-3">
                  <select name="penambahbaikan" class="form-select" id="penambahbaikan">
                    <option value="" selected disabled>Pilih Jenis</option>
                    <option value="Akses_Pengguna_Baru">Akses Pengguna Baru</option>
                    <option value="Baru">Baru</option>
                    <option value="Backup">Backup/Restore</option>
                    <option value="Kemaskini">Kemaskini</option>
                    <option value="Hapus">Hapus</option>
                  </select>
                  <label for="penambahbaikan">Jenis Permohonan</label>
                </div>

                <div class="form-floating mb-3">
                  <select name="kategori" class="form-select" id="kategori">
                    <option value="" selected disabled>Pilih Kategori</option>
                    <option value="Standard">Standard</option>
                    <option value="Normal-Minor">Normal-Minor</option>
                    <option value="Normal-Major">Normal-Major</option>
                    <option value="Kecemasan">Kecemasan</option>
                  </select>
                  <label for="kategori">Kategori Perubahan</label>
                </div>

                <div class="form-floating mb-3">
                  <textarea class="form-control" name="justifikasi" id="justifikasi" placeholder="Tulis justifikasi di sini" style="height: 100px"></textarea>
                  <label for="justifikasi">Justifikasi</label>
                </div>
              </div>

              <div class="col-md-6">
                <h6 class="fw-bold text-orange">Tarikh & Keutamaan</h6>

                <div class="form-floating mb-3">
                  <input type="date" name="tarikh_mohon" class="form-control" id="tarikh_mohon" value="<?= date('Y-m-d') ?>" placeholder="Tarikh Mohon" disabled>
                  <label for="tarikh_mohon">Tarikh Mohon</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="date" name="tarikh_diperlukan" class="form-control" id="tarikh_diperlukan" value="<?= isset($tarikh_diperlukan) ? $tarikh_diperlukan : '' ?>" placeholder="Tarikh Diperlukan" required>
                  <label for="tarikh_diperlukan">Tarikh Diperlukan</label>
                </div>

                <div class="form-floating mb-3">
                  <select name="keutamaan" class="form-select" id="keutamaan">
                    <option value="" selected disabled>Pilih Keutamaan</option>
                    <option value="Rendah">Rendah</option>
                    <option value="Sederhana">Sederhana</option>
                    <option value="Tinggi">Tinggi</option>
                    <option value="Kritikal">Kritikal</option>
                  </select>
                  <label for="keutamaan">Keutamaan</label>
                </div>
              </div>
            </div>

            <hr>
            <div class="row g-4">
              <!-- KIRI -->
              <div class="col-md-6">
                <!-- Permohonan Tapisan Capaian Internet -->
                <h6 class="fw-bold text-primary">Permohonan Tapisan Capaian Internet</h6>

                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="nama_url" id="nama_url" placeholder="Contoh: www.example.com">
                  <label for="nama_url">Nama URL atau Website</label>
                </div>

                <label class="mb-1">Tempoh</label>
                <div class="input-group mb-3">
                  <input type="date" class="form-control" name="tempoh_dari">
                  <span class="input-group-text">hingga</span>
                  <input type="date" class="form-control" name="tempoh_hingga">
                </div>

                <hr>

                <!-- Maklumat Penambahbaikan -->
                <h6 class="fw-bold text-primary">Maklumat Penambahbaikan</h6>

                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="server_nama" id="server_nama" placeholder="Nama Server" required>
                  <label for="server_nama">Nama Server</label>
                </div>

                <div class="form-floating mb-3">
                  <select class="form-select" name="segmen" id="segmen" required>
                    <option value="" selected disabled>Pilih Segmen</option>
                    <option value="Dalaman">Dalaman</option>
                    <option value="Luaran">Luaran</option>
                  </select>
                  <label for="segmen">Segmen</label>
                </div>




              </div>

              <!-- KANAN -->
              <div class="col-md-6">

                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="domain_semasa" id="domain_semasa" placeholder="Contoh: domain.moha.gov.my">
                  <label for="domain_semasa">Domain Semasa</label>
                </div>

                <div class="form-floating mb-3">
                  <select class="form-select" name="capaian" id="capaian" required>
                    <option value="" selected disabled>Pilih Capaian</option>
                    <option value="Dalaman">Dalaman</option>
                    <option value="Luaran">Luaran</option>
                    <option value="Public IP">Public IP</option>
                  </select>
                  <label for="capaian">Capaian</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="domain_baru" id="domain_baru" placeholder="Contoh: nama.moha.gov.my">
                  <label for="domain_baru">Domain Baru (cth: NamaDomain.moha.gov.my)</label>
                </div>
                <!-- Pembukaan Port Firewall -->
                <h6 class="fw-bold text-primary">Pembukaan Port Firewall</h6>

                <!-- Source IP -->
                <label class="mb-2">Source IP</label>
                <div id="ip-list-wrapper3">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control ip-field2" placeholder="Contoh: 192.168.1.10">
                    <button type="button" class="btn btn-outline-success btn-add-ip"><i class="bi bi-plus-circle"></i></button>
                  </div>
                </div>
                <input type="hidden" name="source_ip" id="source_ip">

                <!-- Destination IP -->
                <label class="mt-3 mb-2">Destination IP</label>
                <div id="ip-list-wrapper4">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control ip-field3" placeholder="Contoh: 192.168.1.20">
                    <button type="button" class="btn btn-outline-success btn-add-ip"><i class="bi bi-plus-circle"></i></button>
                  </div>
                </div>
                <input type="hidden" name="destination_ip" id="destination_ip">

                <script>
                  // Source IP
                  document.addEventListener('DOMContentLoaded', function() {
                    const ipListWrapper3 = document.getElementById('ip-list-wrapper3');
                    const hiddenInput3 = document.getElementById('source_ip');

                    ipListWrapper3.addEventListener('click', function(e) {
                      if (e.target.closest('.btn-add-ip')) {
                        const newInputGroup = document.createElement('div');
                        newInputGroup.className = 'input-group mb-2';
                        newInputGroup.innerHTML = `
              <input type="text" class="form-control ip-field2" placeholder="Contoh: 192.168.1.10">
              <button type="button" class="btn btn-outline-danger btn-remove-ip"><i class="bi bi-dash-circle"></i></button>
            `;
                        ipListWrapper3.appendChild(newInputGroup);
                      }
                      if (e.target.closest('.btn-remove-ip')) {
                        e.target.closest('.input-group').remove();
                      }
                    });

                    const form3 = ipListWrapper3.closest('form');
                    if (form3) {
                      form3.addEventListener('submit', function() {
                        const ipFields = document.querySelectorAll('.ip-field2');
                        const ipValues = Array.from(ipFields).map(input => input.value.trim()).filter(val => val !== '');
                        hiddenInput3.value = ipValues.join(',');
                      });
                    }
                  });

                  // Destination IP
                  document.addEventListener('DOMContentLoaded', function() {
                    const ipListWrapper4 = document.getElementById('ip-list-wrapper4');
                    const hiddenInput4 = document.getElementById('destination_ip');

                    ipListWrapper4.addEventListener('click', function(e) {
                      if (e.target.closest('.btn-add-ip')) {
                        const newInputGroup = document.createElement('div');
                        newInputGroup.className = 'input-group mb-2';
                        newInputGroup.innerHTML = `
              <input type="text" class="form-control ip-field3" placeholder="Contoh: 192.168.1.10">
              <button type="button" class="btn btn-outline-danger btn-remove-ip"><i class="bi bi-dash-circle"></i></button>
            `;
                        ipListWrapper4.appendChild(newInputGroup);
                      }
                      if (e.target.closest('.btn-remove-ip')) {
                        e.target.closest('.input-group').remove();
                      }
                    });

                    const form4 = ipListWrapper4.closest('form');
                    if (form4) {
                      form4.addEventListener('submit', function() {
                        const ipFields = document.querySelectorAll('.ip-field3');
                        const ipValues = Array.from(ipFields).map(input => input.value.trim()).filter(val => val !== '');
                        hiddenInput4.value = ipValues.join(',');
                      });
                    }
                  });
                </script>

                <hr>

                <!-- Pengesahan -->
                <h6 class="fw-bold text-primary">Pengesahan</h6>
                <div class="form-floating mb-3">
                  <select required name="id_pegawai_pengesah" id="id_pegawai_pengesah" class="form-select">
                    <option value="">Pilih Pegawai Pengesah</option>
                    <?php
                    $id_bahagian_user = $_SESSION['id_bahagian'] ?? null;
                    $list_to_use = ($id_bahagian_user == 8) ? $list_pengesah_it : $list_pengesah;
                    foreach ($list_to_use as $row): ?>
                      <option value="<?= $row['id_user'] ?>"><?= $row['nama_penuh'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <label for="id_pegawai_pengesah">Pegawai Pengesah</label>
                </div>
              </div>
            </div>





            <!-- Hidden Input -->
            <input type="hidden" name="id_pemohon" id="id_pemohon" value="<?= session()->get('id_user') ?? '' ?>">
            <input type="hidden" name="id_bahagian" id="id_bahagian" value="<?= session()->get('id_bahagian') ?? '' ?>">







            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <input type="reset" class="btn btn-danger" value="Semula">
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>