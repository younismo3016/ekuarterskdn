<main id="main" class="main">
    <div class="pagetitle mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1">Kemaskini Terperinci: <strong><?= $row['kod_kuarters'] ?></strong></h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">Statistik</li>
                    <li class="breadcrumb-item active"><?= $row['nama_kuarters'] ?></li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('index.php/agensi/agensi_statistik_kemaskini/' . $bulan . '/' . $tahun) ?>" class="btn btn-secondary shadow-sm px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/agensi/simpan_kemaskini_individu') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="id_report" value="<?= $row['id_report'] ?>">

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-info text-white fw-bold small text-uppercase">
                A. Statistik Penghunian (Dihuni)
            </div>
            <div class="card-body row g-3 pt-3">
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Jum. Mohon (F)</label>
                    <input type="number" name="jumlah_permohonan" class="form-control form-control-sm" value="<?= $row['jumlah_permohonan'] ?>" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Jum. Dihuni (G)</label>
                    <input type="number" name="unit_dihuni" id="G" class="form-control form-control-sm bg-white fw-bold border-primary" value="<?= $row['unit_dihuni'] ?>" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold text-success">Dihuni-Baik (H)</label>
                    <input type="number" name="dihuni_baik" id="H" class="form-control form-control-sm calc-huni" value="<?= $row['dihuni_baik'] ?>" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold text-danger">Dihuni-Rosak (I)</label>
                    <input type="number" name="dihuni_rosak" id="I" class="form-control form-control-sm calc-huni" value="<?= $row['dihuni_rosak'] ?>" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold text-primary">Semakan (H+I)</label>
                    <input type="text" id="total_HI" class="form-control form-control-sm bg-light fw-bold text-center" value="<?= (int)$row['dihuni_baik'] + (int)$row['dihuni_rosak'] ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Status</label>
                    <?php $is_tally_huni = ($row['unit_dihuni'] == ($row['dihuni_baik'] + $row['dihuni_rosak'])); ?>
                    <input type="text" id="status" class="form-control form-control-sm fw-bold text-center <?= $is_tally_huni ? 'text-success' : 'text-danger' ?> bg-light" value="<?= $is_tally_huni ? 'TRUE' : 'FALSE' ?>" readonly>
                </div>
            </div>
        </div>

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold small text-uppercase">
                B. Maklumat Unit Tidak Dihuni & Cadangan
            </div>
            <div class="card-body pt-3">
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Unit Tidak Dihuni (A)</label>
                        <input type="number" name="unit_tidak_dihuni" id="unit_tidak_dihuni" class="form-control form-control-sm border-primary fw-bold" value="<?= $row['unit_tidak_dihuni'] ?>" min="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-primary">Jum. Cadangan (B)</label>
                        <?php
                        $fields = ['baik_diduduki', 'baik_guna_sama', 'baik_tukar_fungsi', 'baik_sewaan', 'rosak_baik_pulih', 'rosak_guna_sama', 'rosak_tukar_fungsi', 'rosak_sewaan', 'rosak_roboh'];
                        $total_cadangan = 0;
                        foreach ($fields as $f) {
                            $total_cadangan += (int)$row[$f];
                        }
                        ?>
                        <input type="text" id="total_cadangan" class="form-control form-control-sm bg-light fw-bold text-center text-primary" value="<?= $total_cadangan ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Status Tally (A=B)</label>
                        <?php $is_tally_cadangan = ((int)$row['unit_tidak_dihuni'] == $total_cadangan); ?>
                        <input type="text" id="status_cadangan" class="form-control form-control-sm fw-bold text-center <?= $is_tally_cadangan ? 'text-success' : 'text-danger' ?> bg-light" value="<?= $is_tally_cadangan ? 'TRUE' : 'FALSE' ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h6 class="text-dark fw-bold border-bottom pb-2 small text-center text-uppercase bg-light p-2 mb-3">
                            <i class="bi bi-info-circle me-1"></i>CADANGAN TINDAKAN MENGIKUT KEADAAN KUARTERS
                        </h6>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 border-end">
                        <h6 class="text-success fw-bold small mb-3"><i class="bi bi-check-circle me-1"></i>1. KUARTERS TIDAK DIHUNI BERKEADAAN BAIK</h6>

                        <div class="row g-2 mb-2 align-items-center">
                            <div class="col-4 small">
                                Diduduki
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Dihuni"></i>
                            </div>
                            <div class="col-8">
                                <input type="number" name="baik_diduduki" class="form-control form-control-sm calc-cadangan" value="<?= $row['baik_diduduki'] ?>">
                            </div>
                        </div>
                        <div class="row g-2 mb-2 align-items-center">
                             <div class="col-4 small">
                                Gunasama
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Dibuka untuk kegunaan agensi lain"></i>
                            </div>
                            <div class="col-3"><input type="number" name="baik_guna_sama" class="form-control form-control-sm calc-cadangan" value="<?= $row['baik_guna_sama'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_baik_guna_sama" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_baik_guna_sama'] ?>"></div>
                        </div>
                        <div class="row g-2 mb-2 align-items-center">
                            <div class="col-4 small">
                                Tukar Fungsi
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Fungsi kuarters ditukar untuk kegunaan lain seperti stor, pejabat, bilik fail dan lain-lain"></i>
                            </div>
                            <div class="col-3"><input type="number" name="baik_tukar_fungsi" class="form-control form-control-sm calc-cadangan" value="<?= $row['baik_tukar_fungsi'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_baik_tukar_fungsi" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_baik_tukar_fungsi'] ?>"></div>
                        </div>
                        <div class="row g-2 mb-2 align-items-center">
                             <div class="col-4 small">
                                Sewaan
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Dibuka untuk sewaan pihak ketiga/ swasta"></i>
                            </div>
                            <div class="col-3"><input type="number" name="baik_sewaan" class="form-control form-control-sm calc-cadangan" value="<?= $row['baik_sewaan'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_baik_sewaan" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_baik_sewaan'] ?>"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-danger fw-bold small mb-3"><i class="bi bi-x-circle me-1"></i>2. KUARTERS TIDAK DIHUNI BERKEADAAN ROSAK</h6>

                        <div class="row g-2 mb-2 align-items-center">
                             <div class="col-4 small">
                                Baik Pulih
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Pembaikan "></i>
                            </div>
                            <div class="col-3"><input type="number" name="rosak_baik_pulih" class="form-control form-control-sm calc-cadangan" value="<?= $row['rosak_baik_pulih'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_rosak_baik_pulih" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_rosak_baik_pulih'] ?>"></div>
                        </div>
                        <div class="row g-2 mb-2 align-items-center">
                               <div class="col-4 small">
                                Gunasama
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Dibuka untuk kegunaan agensi lain"></i>
                            </div>
                            <div class="col-3"><input type="number" name="rosak_guna_sama" class="form-control form-control-sm calc-cadangan" value="<?= $row['rosak_guna_sama'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_rosak_guna_sama" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_rosak_guna_sama'] ?>"></div>
                        </div>
                        <div class="row g-2 mb-2 align-items-center">
                            <div class="col-4 small">
                                Tukar Fungsi
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Fungsi kuarters ditukar untuk kegunaan lain seperti stor, pejabat, bilik fail dan lain-lain"></i>
                            </div>
                            <div class="col-3"><input type="number" name="rosak_tukar_fungsi" class="form-control form-control-sm calc-cadangan" value="<?= $row['rosak_tukar_fungsi'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_rosak_tukar_fungsi" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_rosak_tukar_fungsi'] ?>"></div>
                        </div>
                        <div class="row g-2 mb-2 align-items-center">
                           <div class="col-4 small">
                                Sewaan
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Dibuka untuk sewaan pihak ketiga/ swasta"></i>
                            </div>
                            <div class="col-3"><input type="number" name="rosak_sewaan" class="form-control form-control-sm calc-cadangan" value="<?= $row['rosak_sewaan'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_rosak_sewaan" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_rosak_sewaan'] ?>"></div>
                        </div>
                        <div class="row g-2 mb-2 align-items-center">
                             <div class="col-4 small">
                                Roboh
                                <i class="bi bi-info-circle text-muted ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title=" Disyorkan untuk roboh kerana terlalu uzur/ tidak selamat untuk diduduki"></i>
                            </div>
                            <div class="col-3"><input type="number" name="rosak_roboh" class="form-control form-control-sm calc-cadangan" value="<?= $row['rosak_roboh'] ?>"></div>
                            <div class="col-5"><input type="text" name="ket_rosak_roboh" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $row['ket_rosak_roboh'] ?>"></div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 align-items-center mt-3 border-top pt-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-dark">Total Unit Kuarters (T)</label>
                        <input type="number" name="total_unit_kuarters" id="total_unit_kuarters" class="form-control form-control-sm border-dark fw-bold" value="<?= $row['total_unit_kuarters'] ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-primary">Semakan (Dihuni + Kosong)</label>
                        <input type="text" id="kira_kuarters" class="form-control form-control-sm bg-light fw-bold text-center text-primary" value="<?= (int)$row['unit_dihuni'] + (int)$row['unit_tidak_dihuni'] ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Status Tally</label>
                        <?php $is_tally_k = ((int)$row['total_unit_kuarters'] == ((int)$row['unit_dihuni'] + (int)$row['unit_tidak_dihuni'])); ?>
                        <input type="text" id="status_kuarters" class="form-control form-control-sm fw-bold text-center <?= $is_tally_k ? 'text-success' : 'text-danger' ?> bg-light" value="<?= $is_tally_k ? 'TRUE' : 'FALSE' ?>" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-warning text-dark fw-bold small text-uppercase">
                D. Isu Pengoperasian & Penyelenggaraan
            </div>
            <div class="card-body row g-3 pt-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Isu Pengoperasian (U)</label>
                    <select name="id_kategori_isu[]" id="isu-select" class="tom-select" multiple>
                        <?php
                        $selected_array = !empty($row['selected_issues']) ? explode(',', $row['selected_issues']) : [];
                        foreach ($kategori_isu as $isu): ?>
                            <option value="<?= $isu['id_kategori_isu'] ?>" <?= in_array($isu['id_kategori_isu'], $selected_array) ? 'selected' : '' ?>>
                                <?= $isu['keterangan_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Keterangan Isu (V)</label>
                    <textarea name="keterangan_isu" class="form-control form-control-sm" rows="2"><?= $row['keterangan_isu'] ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Status Tindakan & Cadangan (W)</label>
                    <textarea name="status_tindakan" class="form-control form-control-sm" rows="2"><?= $row['status_tindakan'] ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Senarai Kerja Penyelenggaraan (X)</label>
                    <textarea name="senarai_kerja" class="form-control form-control-sm" rows="2"><?= $row['senarai_kerja'] ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Kos Penyelenggaraan (RM) (Y)</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">RM</span>
                        <input type="number" step="0.01" name="kos_rm" class="form-control" value="<?= $row['kos_rm'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Jangkaan Tahun Pelaksanaan</label>
                    <select name="jangkaan_pelaksanaan" class="form-select form-select-sm">
                        <option value="">-- Pilih Tahun --</option>
                        <?php
                        $tahun_sekarang = (int) date('Y');
                        for ($y = $tahun_sekarang - 5; $y <= $tahun_sekarang + 10; $y++): ?>
                            <option value="<?= $y ?>" <?= ($row['jangkaan_pelaksanaan'] == $y) ? 'selected' : '' ?>><?= $y ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Catatan</label>
                    <textarea name="catatan" class="form-control form-control-sm" rows="1"><?= $row['catatan'] ?></textarea>
                </div>
            </div>
        </div>

        <div class="text-center pb-5">
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                <i class="bi bi-save me-2"></i>Simpan Kemaskini
            </button>
        </div>
    </form>
</main>

<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // 1. Initialize TomSelect
        new TomSelect("#isu-select", {
            plugins: ['remove_button'],
            maxItems: 5
        });

        // 2. Main Calculation Logic
        $('.form-control, .form-select').on('input change', function() {
            // A. Kira Pengiraan Dihuni (H+I)
            let G = parseInt($('#G').val()) || 0;
            let H = parseInt($('#H').val()) || 0;
            let I = parseInt($('#I').val()) || 0;
            let totalHI = H + I;
            $('#total_HI').val(totalHI);

            if (G === totalHI) {
                $('#status').val('TRUE').removeClass('text-danger').addClass('text-success');
            } else {
                $('#status').val('FALSE').removeClass('text-success').addClass('text-danger');
            }

            // B. Kira Jumlah Cadangan
            let sumCadangan = 0;
            $('.calc-cadangan').each(function() {
                sumCadangan += parseInt($(this).val()) || 0;
            });
            $('#total_cadangan').val(sumCadangan);

            let unitKosong = parseInt($('#unit_tidak_dihuni').val()) || 0;
            if (unitKosong === sumCadangan) {
                $('#status_cadangan').val('TRUE').removeClass('text-danger').addClass('text-success');
            } else {
                $('#status_cadangan').val('FALSE').removeClass('text-success').addClass('text-danger');
            }

            // C. Kira Total Kuarters (Dihuni + Tidak Dihuni)
            let totalKira = G + unitKosong;
            $('#kira_kuarters').val(totalKira);

            let totalFail = parseInt($('#total_unit_kuarters').val()) || 0;
            if (totalFail === totalKira) {
                $('#status_kuarters').val('TRUE').removeClass('text-danger').addClass('text-success');
            } else {
                $('#status_kuarters').val('FALSE').removeClass('text-success').addClass('text-danger');
            }
        });
    });
</script>