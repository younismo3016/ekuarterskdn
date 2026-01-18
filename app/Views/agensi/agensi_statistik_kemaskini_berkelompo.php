<section class="content">
    <main id="main" class="main">

        <form action="<?= base_url('index.php/agensi/simpan_kemaskini') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="bulan" value="<?= $bulan ?>">
            <input type="hidden" name="tahun" value="<?= $tahun ?>">

            <div class="pagetitle">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold">Kemaskini Statistik Bulanan (<?= $bulan ?>/<?= $tahun ?>)</h4>
                    </div>
                    <div>
                        <a href="<?= base_url('index.php/agensi/agensi_statistik_list') ?>" class="btn btn-secondary border shadow-sm">Batal</a>
                        <button type="submit" class="btn btn-primary shadow-sm">Simpan Kemaskini</button>
                    </div>
                </div>
            </div>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari kod atau nama kuarters...">
                    </div>
                    <div id="searchCount" class="small text-muted mt-1"></div>
                </div>
            </div>

            <div class="form-container shadow-sm border bg-white">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle small" id="mainTable">
                      <thead class="text-center bg-light sticky-top">
    <tr>
        <th style="min-width: 200px; background-color: #e9ecef;">KOD & NAMA KUARTERS</th>
        
        <th style="background-color: #cfe2ff; color: #084298;">HUNIAN (F, G, J)</th>
        
        <th style="background-color: #d1e7dd; color: #0f5132;">CADANGAN BAIK (K)</th>
        
        <th style="background-color: #f8d7da; color: #842029;">CADANGAN ROSAK (O)</th>
        
        <th style="background-color: #fff3cd; color: #664d03;">PENYELENGGARAAN (U, Y, X)</th>
        
        <th style="background-color: #e2e3e5; color: #41464b;">LAIN-LAIN / ISU</th>
    </tr>
</thead>
                        <tbody>
                            <?php foreach ($reports as $index => $row): ?>
                            <tr>
                              <td class="bg-light search-area">
                                <input type="hidden" name="report[<?= $index ?>][id_report]" value="<?= $row['id_report'] ?>">
                                <input type="hidden" name="report[<?= $index ?>][id_kuarters]" value="<?= $row['id_kuarters'] ?>">
                                
                                <a href="<?= base_url('index.php/agensi/kemaskini_individu/'.$row['id_kuarters'].'/'.$bulan.'/'.$tahun) ?>" class="fw-bold text-primary">
                                    <?= $row['kod_kuarters'] ?>
                                </a><br>
                                
                                <small><?= $row['nama_kuarters'] ?></small><br>
                                <span class="badge bg-secondary"><?= $row['jenis_kuarters'] ?></span>
                            </td>

                                <td>
                                    <label>Jum. Permohonan (F):</label>
                                    <input type="number" name="report[<?= $index ?>][jumlah_permohonan]" class="form-control form-control-sm mb-1" value="<?= $row['jumlah_permohonan'] ?>">
                                    
                                    <label>Dihuni (G): [Baik | Rosak]</label>
                                    <div class="input-group input-group-sm mb-1">
                                        <input type="number" name="report[<?= $index ?>][unit_dihuni]" class="form-control calc-trigger" placeholder="Total G" value="<?= $row['unit_dihuni'] ?>">
                                        <input type="number" name="report[<?= $index ?>][dihuni_baik]" class="form-control" placeholder="Baik" value="<?= $row['dihuni_baik'] ?>">
                                        <input type="number" name="report[<?= $index ?>][dihuni_rosak]" class="form-control" placeholder="Rosak" value="<?= $row['dihuni_rosak'] ?>">
                                    </div>

                                    <label>Kosong (J):</label>
                                    <input type="number" name="report[<?= $index ?>][unit_tidak_dihuni]" class="form-control form-control-sm calc-trigger" value="<?= $row['unit_tidak_dihuni'] ?>">
                                </td>

                                <td>
                                    <label>Diduduki:</label>
                                    <input type="number" name="report[<?= $index ?>][baik_diduduki]" class="form-control form-control-sm mb-1" value="<?= $row['baik_diduduki'] ?>">
                                    
                                    <label>Guna Sama / Ket:</label>
                                    <div class="d-flex gap-1 mb-1">
                                        <input type="number" name="report[<?= $index ?>][baik_guna_sama]" class="form-control form-control-sm w-25" value="<?= $row['baik_guna_sama'] ?>">
                                        <input type="text" name="report[<?= $index ?>][ket_baik_guna_sama]" class="form-control form-control-sm" placeholder="Ket..." value="<?= $row['ket_baik_guna_sama'] ?>">
                                    </div>

                                    <label>Tukar Fungsi / Ket:</label>
                                    <div class="d-flex gap-1 mb-1">
                                        <input type="number" name="report[<?= $index ?>][baik_tukar_fungsi]" class="form-control form-control-sm w-25" value="<?= $row['baik_tukar_fungsi'] ?>">
                                        <input type="text" name="report[<?= $index ?>][ket_baik_tukar_fungsi]" class="form-control form-control-sm" placeholder="Ket..." value="<?= $row['ket_baik_tukar_fungsi'] ?>">
                                    </div>

                                    <label>Sewaan / Ket:</label>
                                    <div class="d-flex gap-1">
                                        <input type="number" name="report[<?= $index ?>][baik_sewaan]" class="form-control form-control-sm w-25" value="<?= $row['baik_sewaan'] ?>">
                                        <input type="text" name="report[<?= $index ?>][ket_baik_sewaan]" class="form-control form-control-sm" placeholder="Ket..." value="<?= $row['ket_baik_sewaan'] ?>">
                                    </div>
                                </td>

                                <td>
                                    <label>Baik Pulih / Ket:</label>
                                    <div class="d-flex gap-1 mb-1">
                                        <input type="number" name="report[<?= $index ?>][rosak_baik_pulih]" class="form-control form-control-sm w-25" value="<?= $row['rosak_baik_pulih'] ?>">
                                        <input type="text" name="report[<?= $index ?>][ket_rosak_baik_pulih]" class="form-control form-control-sm" placeholder="Ket..." value="<?= $row['ket_rosak_baik_pulih'] ?>">
                                    </div>

                                    <label>Roboh / Ket:</label>
                                    <div class="d-flex gap-1">
                                        <input type="number" name="report[<?= $index ?>][rosak_roboh]" class="form-control form-control-sm w-25" value="<?= $row['rosak_roboh'] ?>">
                                        <input type="text" name="report[<?= $index ?>][ket_rosak_roboh]" class="form-control form-control-sm" placeholder="Ket..." value="<?= $row['ket_rosak_roboh'] ?>">
                                    </div>
                                </td>

                                <td>
                                    <label class="fw-bold">TOTAL UNIT (T):</label>
                                    <input type="number" name="report[<?= $index ?>][total_unit_kuarters]" class="form-control form-control-sm mb-1 bg-info bg-opacity-10 fw-bold" value="<?= $row['total_unit_kuarters'] ?>" readonly>

                                    <label>Kat. Isu (U):</label>
                                    <select name="report[<?= $index ?>][id_kategori_isu]" class="form-select form-select-sm">
                                        <option value="">Pilih...</option>
                                        <?php foreach ($kategori_isu as $isu): ?>
                                            <option value="<?= $isu['id_kategori_isu'] ?>" <?= ($row['id_kategori_isu'] == $isu['id_kategori_isu']) ? 'selected' : '' ?>>
                                                <?= $isu['keterangan_kategori'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <label>Kos RM (Y):</label>
                                    <input type="number" name="report[<?= $index ?>][kos_rm]" class="form-control form-control-sm mb-1" value="<?= $row['kos_rm'] ?>">

                                    <label>Kerja (X):</label>
                                    <textarea name="report[<?= $index ?>][senarai_kerja]" class="form-control form-control-sm" rows="2"><?= $row['senarai_kerja'] ?></textarea>
                                </td>

                                <td>
                                    <label>Keterangan Isu:</label>
                                    <textarea name="report[<?= $index ?>][keterangan_isu]" class="form-control form-control-sm mb-1"><?= $row['keterangan_isu'] ?></textarea>
                                    
                                    <label>Status Tindakan:</label>
                                    <input type="text" name="report[<?= $index ?>][status_tindakan]" class="form-control form-control-sm mb-1" value="<?= $row['status_tindakan'] ?>">
                                    
                                    <label>Jangkaan Pelaksanaan:</label>
                                    <input type="date" name="report[<?= $index ?>][jangkaan_pelaksanaan]" class="form-control form-control-sm mb-1" value="<?= $row['jangkaan_pelaksanaan'] ?>">

                                    <label>Catatan:</label>
                                    <input type="text" name="report[<?= $index ?>][catatan]" class="form-control form-control-sm" value="<?= $row['catatan'] ?>">
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </main>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. FUNGSI CARIAN (SEARCH) ---
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#mainTable tbody tr');
    const searchCount = document.getElementById('searchCount');

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        let visibleCount = 0;

        tableRows.forEach(row => {
            // Kita cari di dalam td pertama (Kod & Nama)
            const text = row.querySelector('.search-area').innerText.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        if (filter !== "") {
            searchCount.innerText = `Menjumpai ${visibleCount} rekod.`;
        } else {
            searchCount.innerText = "";
        }
    });


    // --- 2. FUNGSI PENGIRAAN AUTOMATIK (G + J = T) ---
    const calcInputs = document.querySelectorAll('.calc-trigger');

    calcInputs.forEach(input => {
        input.addEventListener('input', function() {
            const row = this.closest('tr');
            
            let unitDihuni = parseFloat(row.querySelector('input[name*="unit_dihuni"]').value) || 0;
            let unitKosong = parseFloat(row.querySelector('input[name*="unit_tidak_dihuni"]').value) || 0;

            // Pastikan nilai tidak negatif
            if (unitDihuni < 0) row.querySelector('input[name*="unit_dihuni"]').value = 0;
            if (unitKosong < 0) row.querySelector('input[name*="unit_tidak_dihuni"]').value = 0;

            // Kemaskini TOTAL (T)
            const totalField = row.querySelector('input[name*="total_unit_kuarters"]');
            totalField.value = unitDihuni + unitKosong;
        });
    });


    // --- 3. VALIDASI SEBELUM HANTAR (SUBMIT) ---
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Set nilai kosong ke 0 untuk input number bagi mengelakkan error database
        let numberInputs = form.querySelectorAll('input[type="number"]');
        numberInputs.forEach(input => {
            if (input.value === "" && !input.readOnly) {
                input.value = 0;
            }
        });

        if (!confirm('Adakah anda pasti untuk mengemaskini semua rekod yang dipaparkan secara pukal?')) {
            e.preventDefault();
        }
    });
});
</script>