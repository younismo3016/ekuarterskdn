<style>
    /* 1. Bekas utama untuk membolehkan scrollbar muncul */
    .table-container {
        overflow-x: auto; /* Scroll ke kanan */
        overflow-y: auto; /* Scroll ke bawah */
        max-height: 75vh; /* Hadkan tinggi supaya header sticky nampak berfungsi */
        border: 1px solid #dee2e6;
        position: relative;
        background: white;
    }

    /* 2. Freeze Kolum Pertama (KOD & NAMA) */
    #mainTable thead th:first-child,
    #mainTable tbody td:first-child {
        position: sticky;
        left: 0;
        z-index: 10;
        background-color: #f8f9fa; 
        border-right: 2px solid #dee2e6;
        min-width: 250px;
        box-shadow: 2px 0 5px rgba(0,0,0,0.05);
    }

    /* 3. Pastikan Header Kekal di Atas (Sticky Header) */
    #mainTable thead th {
        position: sticky;
        top: 0;
        z-index: 11;
        vertical-align: middle;
    }

    /* Header kolum pertama perlukan z-index tertinggi (persimpangan atas & kiri) */
    #mainTable thead th:first-child {
        z-index: 12;
    }

    /* 4. Saiz input supaya jadual memanjang ke kanan */
    .form-control-sm, .form-select-sm {
        min-width: 100px;
    }
    
    .wide-input {
        min-width: 180px;
    }

    /* Custom Scrollbar */
    .table-container::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }
    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .table-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
    }
    .table-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

  <?php 
    $bulan_array = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Mac',
        '04' => 'April', '05' => 'Mei', '06' => 'Jun',
        '07' => 'Julai', '08' => 'Ogos', '09' => 'September',
        '10' => 'Oktober', '11' => 'November', '12' => 'Disember'
    ];
    $nama_bulan = $bulan_array[str_pad($bulan, 2, '0', STR_PAD_LEFT)] ?? $bulan;
?>

<section class="content">
    <main id="main" class="main">

        <form action="<?= base_url('index.php/agensi/simpan_kemaskini') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="bulan" value="<?= $bulan ?>">
            <input type="hidden" name="tahun" value="<?= $tahun ?>">

            <div class="pagetitle">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold">Kemaskini Statistik Bagi  <?= $nama_bulan ?> <?= $tahun ?></h4>
                        <p class="text-muted small mb-0">Scroll ke kanan untuk mengisi maklumat lanjut.</p>
                    </div>
                   
                         <div class="mt-3 text-end pb-5">
   <a href="<?= base_url('index.php/agensi/agensi_statistik_list') ?>" class="btn btn-secondary shadow-sm px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
    
    <button type="submit" class="btn btn-primary shadow-sm px-4 py-2">
    <i class="bi bi-floppy-fill me-2"></i> Simpan Semua Rekod
</button>

    <button type="button" onclick="confirmHantarKDN()" class="btn btn-success shadow-sm px-4">
                        <i class="bi bi-send-check-fill me-1"></i> Hantar Ke KDN
                    </button>
</div>
                        
                   
                </div>
            </div>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari kod atau nama kuarters...">
                    </div>
                </div>
            </div>

            <div class="table-container shadow-sm border rounded">
                <table class="table table-bordered align-middle small mb-0" id="mainTable">
                    <thead class="text-center text-white">
                        <tr>
                            <th style="background-color: #942eb8;">MAKLUMAT ASAS</th>
                            <th colspan="3" style="background-color: #0d6efd;">I. HUNIAN (F, G, J)</th>
                            <th colspan="4" style="background-color: #198754;">II. CADANGAN BAIK (K)</th>
                            <th colspan="2" style="background-color: #dc3545;">III. CADANGAN ROSAK (O)</th>
                            <th style="background-color: #0dcaf0; color: #000;">TOTAL (T)</th>
                            <th colspan="3" style="background-color: #ffc107; color: #000;">IV. PENYELENGGARAAN (U, Y, X)</th>
                            <th colspan="3" style="background-color: #0fdfa8;">LAIN-LAIN / ISU</th>
                        </tr>
                        <tr class="table-light text-dark">
                            <th>Kod & Nama Kuarters</th>
                            <th>Mohon (F)</th>
                            <th>Dihuni (G)</th>
                            <th>Kosong (J)</th>
                            <th>Diduduki</th>
                            <th>Guna Sama</th>
                            <th>Tukar Fungsi</th>
                            <th>Sewaan</th>
                            <th>Baik Pulih</th>
                            <th>Roboh</th>
                            <th>Jumlah Unit</th>
                            <th>Kategori (U)</th>
                            <th>Kos (Y)</th>
                            <th>Kerja (X)</th>
                            <th>Keterangan Isu</th>
                            <th>Status/Jangkaan</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reports as $index => $row): ?>
                        <tr>
                            <td class="search-area bg-light">
                                <input type="hidden" name="report[<?= $index ?>][id_report]" value="<?= $row['id_report'] ?>">
                                <input type="hidden" name="report[<?= $index ?>][id_kuarters]" value="<?= $row['id_kuarters'] ?>">
                                
                                <a href="<?= base_url('index.php/agensi/kemaskini_individu/'.$row['id_kuarters'].'/'.$bulan.'/'.$tahun) ?>" class="fw-bold text-decoration-none">
                                    <?= $row['kod_kuarters'] ?>
                                </a><br>
                                <span class="text-uppercase small fw-semibold"><?= $row['nama_kuarters'] ?></span><br>
                                <span class="badge bg-secondary" style="font-size: 9px;"><?= $row['jenis_kuarters'] ?></span>
                            </td>

                            <td><input type="number" name="report[<?= $index ?>][jumlah_permohonan]" class="form-control form-control-sm" value="<?= $row['jumlah_permohonan'] ?>"></td>
                            <td><input type="number" name="report[<?= $index ?>][unit_dihuni]" class="form-control form-control-sm calc-trigger" value="<?= $row['unit_dihuni'] ?>"></td>
                            <td><input type="number" name="report[<?= $index ?>][unit_tidak_dihuni]" class="form-control form-control-sm calc-trigger" value="<?= $row['unit_tidak_dihuni'] ?>"></td>

                            <td><input type="number" name="report[<?= $index ?>][baik_diduduki]" class="form-control form-control-sm" value="<?= $row['baik_diduduki'] ?>"></td>
                            <td><input type="number" name="report[<?= $index ?>][baik_guna_sama]" class="form-control form-control-sm" value="<?= $row['baik_guna_sama'] ?>"></td>
                            <td><input type="number" name="report[<?= $index ?>][baik_tukar_fungsi]" class="form-control form-control-sm" value="<?= $row['baik_tukar_fungsi'] ?>"></td>
                            <td><input type="number" name="report[<?= $index ?>][baik_sewaan]" class="form-control form-control-sm" value="<?= $row['baik_sewaan'] ?>"></td>

                            <td><input type="number" name="report[<?= $index ?>][rosak_baik_pulih]" class="form-control form-control-sm" value="<?= $row['rosak_baik_pulih'] ?>"></td>
                            <td><input type="number" name="report[<?= $index ?>][rosak_roboh]" class="form-control form-control-sm" value="<?= $row['rosak_roboh'] ?>"></td>

                            <td><input type="number" name="report[<?= $index ?>][total_unit_kuarters]" class="form-control form-control-sm bg-info bg-opacity-10 fw-bold" value="<?= $row['total_unit_kuarters'] ?>" readonly title="G + J"></td>

                            <td>
                                <select name="report[<?= $index ?>][id_kategori_isu]" class="form-select form-select-sm wide-input">
                                    <option value="">Pilih...</option>
                                    <?php foreach ($kategori_isu as $isu): ?>
                                        <option value="<?= $isu['id_kategori_isu'] ?>" <?= ($row['id_kategori_isu'] == $isu['id_kategori_isu']) ? 'selected' : '' ?>>
                                            <?= $isu['keterangan_kategori'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="number" name="report[<?= $index ?>][kos_rm]" class="form-control form-control-sm" value="<?= $row['kos_rm'] ?>"></td>
                            <td><textarea name="report[<?= $index ?>][senarai_kerja]" class="form-control form-control-sm wide-input" rows="1"><?= $row['senarai_kerja'] ?></textarea></td>

                            <td><textarea name="report[<?= $index ?>][keterangan_isu]" class="form-control form-control-sm wide-input" rows="1"><?= $row['keterangan_isu'] ?></textarea></td>
                            <td class="wide-input">
                                <input type="text" name="report[<?= $index ?>][status_tindakan]" class="form-control form-control-sm mb-1" placeholder="Status" value="<?= $row['status_tindakan'] ?>">
                                <input type="date" name="report[<?= $index ?>][jangkaan_pelaksanaan]" class="form-control form-control-sm" value="<?= $row['jangkaan_pelaksanaan'] ?>">
                            </td>
                            <td><textarea name="report[<?= $index ?>][catatan]" class="form-control form-control-sm wide-input" rows="1"><?= $row['catatan'] ?></textarea></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
       
        </form>
    </main>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmHantarKDN() {
    Swal.fire({
        title: 'Hantar ke KDN?',
        text: "Pastikan semua maklumat statistik adalah tepat. Selepas dihantar, rekod mungkin tidak boleh diubah.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hantar Sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tukar URL di bawah ke fungsi controller hantar anda
            window.location.href = "<?= base_url('index.php/agensi/hantar_ke_kdn/'.$bulan.'/'.$tahun) ?>";
        }
    })
}


document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. FUNGSI CARIAN (SEARCH) ---
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#mainTable tbody tr');

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        tableRows.forEach(row => {
            const text = row.querySelector('.search-area').innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });

    // --- 2. FUNGSI PENGIRAAN AUTOMATIK (G + J = T) ---
    const calcInputs = document.querySelectorAll('.calc-trigger');
    calcInputs.forEach(input => {
        input.addEventListener('input', function() {
            const row = this.closest('tr');
            let unitDihuni = parseFloat(row.querySelector('input[name*="unit_dihuni"]').value) || 0;
            let unitKosong = parseFloat(row.querySelector('input[name*="unit_tidak_dihuni"]').value) || 0;
            
            // Kemaskini TOTAL (T)
            const totalField = row.querySelector('input[name*="total_unit_kuarters"]');
            totalField.value = unitDihuni + unitKosong;
        });
    });

    
    



    
});
</script>