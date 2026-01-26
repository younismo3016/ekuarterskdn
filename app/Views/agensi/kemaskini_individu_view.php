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
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>


    <form action="<?= base_url('index.php/agensi/simpan_kemaskini_individu') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id_report" value="<?= $row['id_report'] ?>">

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-info text-white fw-bold small text-uppercase">
                        A. Statistik Penghunian (Dihuni)
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-dark">Jum. Mohon (F)</label>
                            <input type="number" name="jumlah_permohonan" class="form-control" value="<?= $row['jumlah_permohonan'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-dark">Jum. Dihuni (G)</label>
                            <input type="number" name="unit_dihuni" id="G" class="form-control bg-white fw-bold border-primary" value="<?= $row['unit_dihuni'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-success">Dihuni-Baik (H)</label>
                            <input type="number" name="dihuni_baik" id="H" class="form-control calc-huni" value="<?= $row['dihuni_baik'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-danger">Dihuni-Rosak (I)</label>
                            <input type="number" name="dihuni_rosak" id="I" class="form-control calc-huni" value="<?= $row['dihuni_rosak'] ?>">
                        </div>
                        <div class="col-12 border-top pt-2">
                            <span id="huni-msg" class="small fw-bold"></span>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-success text-white fw-bold small text-uppercase">
                        B. Pecahan Unit Tidak Dihuni (BAIK)
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Baik Boleh Diduduki (K)</label>
                                <input type="number" name="baik_diduduki" class="form-control calc-tidak-huni" value="<?= $row['baik_diduduki'] ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Baik Cadangan Guna Sama (L)</label>
                                <input type="number" name="baik_guna_sama" class="form-control calc-tidak-huni" value="<?= $row['baik_guna_sama'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Keterangan Baik Guna Sama</label>
                                <textarea name="ket_baik_guna_sama" class="form-control" rows="1"><?= $row['ket_baik_guna_sama'] ?></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Baik Cadangan Tukar Fungsi (M)</label>
                                <input type="number" name="baik_tukar_fungsi" class="form-control calc-tidak-huni" value="<?= $row['baik_tukar_fungsi'] ?>">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label small fw-bold">Keterangan Baik Tukar Fungsi</label>
                                <textarea name="ket_baik_tukar_fungsi" class="form-control" rows="1"><?= $row['ket_baik_tukar_fungsi'] ?></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Baik Sewaan/Pajakan (N)</label>
                                <input type="number" name="baik_sewaan" class="form-control calc-tidak-huni" value="<?= $row['baik_sewaan'] ?>">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label small fw-bold">Keterangan Baik Sewaan/Pajakan</label>
                                <textarea name="ket_baik_sewaan" class="form-control" rows="1"><?= $row['ket_baik_sewaan'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm border-start border-danger border-5">
                    <div class="card-header bg-danger text-white fw-bold small text-uppercase">
                        C. Pecahan Unit Tidak Dihuni (ROSAK)
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Rosak Perlu Baik Pulih (O)</label>
                                <input type="number" name="rosak_baik_pulih" class="form-control calc-tidak-huni" value="<?= $row['rosak_baik_pulih'] ?>">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label small fw-bold">Keterangan Rosak Perlu Baik Pulih</label>
                                <textarea name="ket_rosak_baik_pulih" class="form-control" rows="1"><?= $row['ket_rosak_baik_pulih'] ?></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Rosak Cadangan Guna Sama (P)</label>
                                <input type="number" name="rosak_guna_sama" class="form-control calc-tidak-huni" value="<?= $row['rosak_guna_sama'] ?>">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label small fw-bold">Keterangan Rosak Guna Sama</label>
                                <textarea name="ket_rosak_guna_sama" class="form-control" rows="1"><?= $row['ket_rosak_guna_sama'] ?></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Rosak Tukar Fungsi (Q)</label>
                                <input type="number" name="rosak_tukar_fungsi" class="form-control calc-tidak-huni" value="<?= $row['rosak_tukar_fungsi'] ?>">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label small fw-bold">Keterangan Rosak Tukar Fungsi</label>
                                <textarea name="ket_rosak_tukar_fungsi" class="form-control" rows="1"><?= $row['ket_rosak_tukar_fungsi'] ?></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Rosak Sewaan/Pajakan (R)</label>
                                <input type="number" name="rosak_sewaan" class="form-control calc-tidak-huni" value="<?= $row['rosak_sewaan'] ?>">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label small fw-bold">Keterangan Rosak Sewaan/Pajakan</label>
                                <textarea name="ket_rosak_sewaan" class="form-control" rows="1"><?= $row['ket_rosak_sewaan'] ?></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-danger">Rosak Cadangan Roboh (S)</label>
                                <input type="number" name="rosak_roboh" class="form-control calc-tidak-huni" value="<?= $row['rosak_roboh'] ?>">
                            </div>
                            <div class="col-md-9">
                                <label class="form-label small fw-bold">Keterangan Rosak Roboh</label>
                                <textarea name="ket_rosak_roboh" class="form-control" rows="1"><?= $row['ket_rosak_roboh'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-primary border-2 shadow shadow-sm">
                    <div class="card-body row g-3 bg-white">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-info">Jumlah Tidak Dihuni (J)</label>
                            <input type="number" name="unit_tidak_dihuni" id="J" class="form-control form-control-lg bg-light fw-bold" value="<?= $row['unit_tidak_dihuni'] ?>" readonly>
                            <small class="text-muted">Auto-calc: (K hingga S)</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-primary">Jumlah Keseluruhan Unit (T)</label>
                            <input type="number" name="total_unit_kuarters" id="T" class="form-control form-control-lg bg-light fw-bold" value="<?= $row['total_unit_kuarters'] ?>" readonly>
                            <small class="text-muted">Auto-calc: (G + J)</small>
                        </div>
                        <div class="col-md-4 pt-4 text-center">
                            <div id="validity-box" class="alert py-2 fw-bold">Menyemak Data...</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-warning text-dark fw-bold small text-uppercase">
                        D. Isu Pengoperasian & Penyelenggaraan
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                           <label class="form-label small fw-bold">Isu Pengoperasian (U)</label>
                    <select name="id_kategori_isu[]" id="isu-select" class="tom-select" multiple>
                        <?php 
                        // Tukar string "1,2,3" kepada array [1, 2, 3]
                        $selected_array = !empty($row['selected_issues']) ? explode(',', $row['selected_issues']) : []; 
                        
                        foreach ($kategori_isu as $isu): ?>
                            <option value="<?= $isu['id_kategori_isu'] ?>" 
                                <?= in_array($isu['id_kategori_isu'], $selected_array) ? 'selected' : '' ?>>
                                <?= $isu['keterangan_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Keterangan Isu (V)</label>
                            <textarea name="keterangan_isu" class="form-control" rows="2"><?= $row['keterangan_isu'] ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Status Tindakan & Cadangan (W)</label>
                            <textarea name="status_tindakan" class="form-control" rows="2"><?= $row['status_tindakan'] ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Senarai Kerja Penyelenggaraan (X)</label>
                            <textarea name="senarai_kerja" class="form-control" rows="2"><?= $row['senarai_kerja'] ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Kos Penyelenggaraan (RM) (Y)</label>
                            <div class="input-group">
                                <span class="input-group-text">RM</span>
                                <input type="number" step="0.01" name="kos_rm" class="form-control" value="<?= $row['kos_rm'] ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Jangkaan Tahun Pelaksanaan</label>
                            <input type="text" name="jangkaan_pelaksanaan" class="form-control" value="<?= $row['jangkaan_pelaksanaan'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="1"><?= $row['catatan'] ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="text-center pb-5">
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>


            <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. TomSelect
    new TomSelect("#isu-select", {
        plugins: ['remove_button'],
        maxItems: 5
    });

    // 2. Kalkulasi Automatik
    const inputsHuni = document.querySelectorAll('.calc-huni');
    const inputsTidakHuni = document.querySelectorAll('.calc-tidak-huni');
    
    function calculate() {
        // G = H + I
        let h = parseInt(document.getElementById('H').value) || 0;
        let i = parseInt(document.getElementById('I').value) || 0;
        let totalG = h + i;
        document.getElementById('G').value = totalG;

        // J = K + L + M + N + O + P + Q + R + S
        let totalJ = 0;
        inputsTidakHuni.forEach(input => {
            totalJ += parseInt(input.value) || 0;
        });
        document.getElementById('J').value = totalJ;

        // T = G + J
        let totalT = totalG + totalJ;
        document.getElementById('T').value = totalT;

        // Semakan Kesahan
        const vBox = document.getElementById('validity-box');
        if (totalT > 0) {
            vBox.className = "alert py-2 fw-bold alert-success text-success";
            vBox.innerHTML = "✓ Data Tally";
        } else {
            vBox.className = "alert py-2 fw-bold alert-warning text-dark";
            vBox.innerHTML = "Sila masukkan data";
        }
    }

    // Bind event
    [...inputsHuni, ...inputsTidakHuni].forEach(input => {
        input.addEventListener('input', calculate);
    });

    // Initial run
    calculate();
});
</script>
</main>