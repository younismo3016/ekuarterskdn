<!-- Main content -->
<style>
    .month-card {
        border: none;
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #ffffff;
    }

    .month-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    /* Ikon Kalendar Mini */
    .calendar-icon-box {
        width: 50px;
        height: 55px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .calendar-header {
        height: 15px;
        background: #942eb8;
        /* Warna Ungu Agensi */
        width: 100%;
    }

    .calendar-content {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-grow: 1;
        font-size: 1.4rem;
        color: #942eb8;
    }

    /* Badge Styles */
    .badge-soft-success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .badge-soft-warning {
        background-color: #fff8e1;
        color: #f57f17;
        border: 1px solid #ffecb3;
    }

    /* Button Styling */
    .btn-action {
        border-radius: 12px;
        font-weight: 600;
        padding: 10px;
        transition: all 0.3s;
    }
</style>

<section class="content">


    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold">Senarai Statistik Bulanan</h4>
                    <p class="text-muted">Pilih bulan untuk melihat laporan terperinci atau memulakan kemas kini baru.</p>
                </div>



            </div><!-- End Page Title -->


            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>



            <div class="row g-4">
                <?php
                $sudah_ada_bulan_semasa = false;

                if (!empty($list_statistik)):
                    foreach ($list_statistik as $row):
                        // 1. Semak jika rekod ini adalah bulan & tahun semasa
                        if ((int)$row['bulan'] == (int)$bulan_sekarang && (int)$row['tahun'] == (int)$tahun_sekarang) {
                            $sudah_ada_bulan_semasa = true;
                        }
                ?>
                        <div class="col-md-4 mb-4">
                            <div class="card month-card shadow-sm p-4 h-100">
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div class="calendar-icon-box">
                                        <div class="calendar-header"></div>
                                        <div class="calendar-content">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                    </div>

                                    <div>
                                        <?php if (($row['status_hantar'] ?? 0) == 2): ?>
                                            <span class="badge badge-soft-success px-3 py-2 rounded-pill">
                                                <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-soft-warning px-3 py-2 rounded-pill">
                                                <i class="bi bi-exclamation-circle-fill me-1"></i> Belum Hantar
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <h5 class="fw-bold text-dark mb-1"><?= strtoupper($row['nama_bulan']) ?></h5>
                                <p class="text-muted small"><?= $row['tahun'] ?></p>

                                <div class="bg-light rounded-4 p-3 mb-4 mt-2">
                                    <div class="row text-center">
                                        <div class="col-6 border-end">
                                            <small class="text-muted d-block mb-1">Dihuni</small>
                                            <span class="fs-5 fw-bold text-primary"><?= number_format($row['total_unit_dihuni']) ?></span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block mb-1">Kosong</small>
                                            <span class="fs-5 fw-bold text-danger"><?= number_format($row['total_unit_tidak_dihuni']) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-action w-100 <?= ($row['status_hantar'] == 2) ? 'btn-outline-primary' : 'btn-primary shadow-sm' ?>"
                                        onclick="location.href='<?= ($row['status_hantar'] == 2)
                                                                    ? base_url('index.php/agensi/agensi_statistik_papar/' . $row['bulan'] . '/' . $row['tahun'])
                                                                    : base_url('index.php/agensi/agensi_statistik_kemaskini/' . $row['bulan'] . '/' . $row['tahun']) ?>'">

                                        <?php if (($row['status_hantar'] ?? 0) == 2): ?>
                                            <i class="bi bi-file-earmark-text me-2"></i>Lihat Laporan
                                        <?php else: ?>
                                            <i class="bi bi-pencil-square me-2"></i>Kemaskini Laporan
                                        <?php endif; ?>
                                    </button>

                                    <?php
                                    $status_reset = (int)($row['status_reset'] ?? 0);
                                    $is_current_month = ($row['bulan'] == date('m') && $row['tahun'] == date('Y'));

                                    if (session()->get('level') == 2 && $row['status_hantar'] == 2 && $is_current_month):
                                    ?>
                                        <div class="mt-1">
                                            <?php if ($status_reset === 1): ?>
                                                <div class="alert alert-warning border-0 py-2 mb-0 text-center shadow-sm" style="font-size: 0.8rem; background-color: #fff3cd; color: #856404; border-radius: 8px;">
                                                    <i class="bi bi-hourglass-split me-1"></i> Permohonan reset dalam proses
                                                </div>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger w-100"
                                                    onclick="sahkanReset('<?= $row['bulan'] ?>', '<?= $row['tahun'] ?>')">
                                                    <i class="bi bi-arrow-counterclockwise me-1"></i>MOHON RESET
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>



                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
                <?php if (session()->get('level') == 2) { ?>
                    <?php if (!$sudah_ada_bulan_semasa): ?>
                        <div class="col-md-4">
                            <button type="button" id="btnProsesTambah" class="card month-card shadow-sm p-4 w-100 btn-add-new d-flex flex-column align-items-center justify-content-center border-dashed"
                                style="border: 2px dashed #ccc; min-height: 250px; background: #f8f9fa; border-radius: 15px;">
                                <i class="bi bi-plus-circle-dotted mb-2 text-primary" style="font-size: 3rem;"></i>
                                <h5 class="fw-bold"><?= strtoupper($nama_bulan_sekarang) ?> <?= $tahun_sekarang ?></h5>
                                <p class="small text-center text-muted">Klik untuk memulakan kemas kini data bagi bulan semasa</p>
                            </button>
                        </div>
                    <?php endif; ?>
                <?php } ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



                <script>
                    function sahkanReset(bulan, tahun) {
                        Swal.fire({
                            title: 'Mohon Reset Laporan?',
                            text: "Permohonan akan dihantar ke KDN. Anda tidak boleh memohon lagi sehingga proses selesai.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, Mohon Sekarang!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Gunakan window.location untuk redirect ke controller
                                window.location.href = "<?= base_url('index.php/agensi/proses_mohon_reset/') ?>/" + bulan + "/" + tahun;
                            }
                        })
                    }
                </script>

                <script>
                    $(document).ready(function() {
                        // Tangkap flashdata dari Controller
                        <?php if (session()->getFlashdata('swal_icon')): ?>
                            Swal.fire({
                                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                                title: '<?= session()->getFlashdata('swal_title') ?>',
                                text: '<?= session()->getFlashdata('swal_text') ?>',
                                confirmButtonColor: '#3085d6'
                            });
                        <?php endif; ?>
                    });
                </script>


                <script>
                    $(document).ready(function() {
                        $('#btnProsesTambah').on('click', function() {
                            Swal.fire({
                                title: 'Sahkan Tindakan',
                                text: "Salin data dari rekod bulan sebelumnya ke bulan ini?",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#942eb8',
                                confirmButtonText: 'Ya, Salin Sekarang',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {

                                    // 1. Papar Loader
                                    Swal.fire({
                                        title: 'Memproses...',
                                        html: 'Sila tunggu sebentar, sistem sedang menyalin data.',
                                        allowOutsideClick: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        }
                                    });

                                    // 2. Jalan AJAX
                                    $.ajax({
                                        url: "<?= base_url('index.php/agensi/tambah_baru') ?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        success: function(response) {
                                            if (response.status === 'success') {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berjaya!',
                                                    text: response.message,
                                                    confirmButtonText: 'OK'
                                                }).then(() => {
                                                    // 3. Redirect guna JavaScript
                                                    window.location.href = response.redirect_url;
                                                });
                                            } else {
                                                Swal.fire('Ralat!', response.message, 'error');
                                            }
                                        },
                                        error: function(xhr) {
                                            Swal.fire('Ralat!', 'Terjadi ralat pada server. Sila cuba lagi.', 'error');
                                            console.log(xhr.responseText);
                                        }
                                    });
                                }
                            });
                        });
                    });
                </script>


            </div>




        </div>

        </form>


        </div>






    </main>