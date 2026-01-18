<style>
    /* 1. Tetapan Pembolehubah */
    :root {
        --col-info-width: 300px;
    }

    /* 2. Bekas Utama */
    .table-container {
        overflow: auto;
        max-height: 75vh;
        border: 1px solid #dee2e6;
        background: white;
        position: relative;
    }

    /* 3. Reset Table */
    #mainTable {
        border-collapse: separate; 
        border-spacing: 0;
        width: 100%;
    }

    /* 4. Sticky Header (Baris Atas) */
    #mainTable thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        border-bottom: 2px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* 5. FIX OVERLAP: Kolum Pertama (Header & Body) */
    /* Bahagian Header Kolum 1 */
    #mainTable thead th:nth-child(1) {
        position: sticky;
        left: 0;
        z-index: 30; /* Paling tinggi */
        width: var(--col-info-width);
        min-width: var(--col-info-width);
        max-width: var(--col-info-width);
        border-right: 4px solid #dee2e6;
        /* KOSONGKAN background-color di sini supaya style inline HTML berfungsi */
    }

    /* Bahagian Data (Body) Kolum 1 */
    #mainTable tbody td:nth-child(1) {
        position: sticky;
        left: 0;
        z-index: 20;
        background-color: #f8f9fa !important; /* Warna data tetap kelabu cair */
        width: var(--col-info-width);
        min-width: var(--col-info-width);
        max-width: var(--col-info-width);
        border-right: 4px solid #dee2e6;
        box-shadow: 5px 0 5px -2px rgba(0,0,0,0.15);
    }

    /* 7. Kemasan Sel Data */
    #mainTable tbody td {
        padding: 12px 8px;
        border-bottom: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        background-color: #ffffff;
    }

    .val-text { font-weight: 600; color: #2c3e50; }
    .x-small { font-size: 0.72rem; line-height: 1.2; }
    
    #mainTable tbody tr:hover td {
        background-color: #f1f1f1 !important;
    }

    /* Custom Scrollbar */
    .table-container::-webkit-scrollbar { width: 10px; height: 10px; }
    .table-container::-webkit-scrollbar-track { background: #f1f1f1; }
    .table-container::-webkit-scrollbar-thumb { background: #bbb; border-radius: 5px; }
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

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold ">Paparan Statistik Bagi <?= $nama_bulan ?> <?= $tahun ?></h4>
                    <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i> Mod paparan sahaja. Scroll ke kanan untuk maklumat lanjut.</p>
                </div>
                <div>
                    <a href="<?= base_url('index.php/agensi/agensi_statistik_list') ?>" class="btn btn-secondary shadow-sm px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="input-group shadow-sm border rounded">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control border-0" placeholder="Cari kod atau nama kuarters...">
                </div>
            </div>
        </div>

        <div class="table-container shadow-sm rounded">
            <table class="table align-middle small mb-0" id="mainTable">
                <thead class="text-center text-white">
                    <tr>
                        <th style="background-color: #942eb8;">MAKLUMAT ASAS</th>
                        <th colspan="3" style="background-color: #0d6efd;">I. HUNIAN (F, G, J)</th>
                        <th colspan="4" style="background-color: #198754;">II. UNIT BAIK (K)</th>
                        <th colspan="2" style="background-color: #dc3545;">III. UNIT ROSAK (O)</th>
                        <th style="background-color: #0dcaf0; color: #000;">TOTAL (T)</th>
                        <th colspan="3" style="background-color: #ffc107; color: #000;">IV. PENYELENGGARAAN</th>
                        <th colspan="3" style="background-color: #0fdfa8;">LAIN-LAIN / ISU</th>
                    </tr>
                    <tr class="table-light text-dark">
                        <th>Kod & Nama Kuarters</th>
                        <th>Mohon (F)</th><th>Dihuni (G)</th><th>Kosong (J)</th>
                        <th>Duduk</th><th>Guna</th><th>Fungsi</th><th>Sewaan</th>
                        <th>Pulih</th><th>Roboh</th>
                        <th>Jumlah Unit</th>
                        <th>Kategori</th><th>Kos (RM)</th><th>Kerja</th>
                        <th>Keterangan Isu</th><th>Status/Jangkaan</th><th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($reports)): ?>
                        <?php foreach ($reports as $row): ?>
                        <tr class="report-row">
                            <td class="search-area">
                                <span class="fw-bold text-primary d-block"><?= $row['kod_kuarters'] ?></span>
                                <span class="text-uppercase x-small d-block fw-semibold text-dark"><?= $row['nama_kuarters'] ?></span>
                                <span class="badge bg-light text-secondary border x-small mt-1"><?= $row['jenis_kuarters'] ?></span>
                            </td>

                            <td class="text-center val-text"><?= $row['jumlah_permohonan'] ?></td>
                            <td class="text-center val-text text-primary"><?= $row['unit_dihuni'] ?></td>
                            <td class="text-center val-text"><?= $row['unit_tidak_dihuni'] ?></td>

                            <td class="text-center"><?= $row['baik_diduduki'] ?></td>
                            <td class="text-center"><?= $row['baik_guna_sama'] ?></td>
                            <td class="text-center"><?= $row['baik_tukar_fungsi'] ?></td>
                            <td class="text-center"><?= $row['baik_sewaan'] ?></td>

                            <td class="text-center text-danger fw-bold"><?= $row['rosak_baik_pulih'] ?></td>
                            <td class="text-center text-danger fw-bold"><?= $row['rosak_roboh'] ?></td>

                            <td class="text-center fw-bold bg-light text-dark"><?= $row['total_unit_kuarters'] ?></td>

                            <td class="text-center"><span class="badge bg-warning text-dark"><?= $row['keterangan_kategori'] ?: '-' ?></span></td>
                            <td class="text-end fw-bold"><?= number_format($row['kos_rm'], 2) ?></td>
                            <td><div class="x-small" style="min-width: 150px;"><?= $row['senarai_kerja'] ?: '-' ?></div></td>

                            <td><div class="x-small" style="min-width: 150px;"><?= $row['keterangan_isu'] ?: '-' ?></div></td>
                            <td>
                                <div class="x-small" style="min-width: 120px;">
                                    <strong>Status:</strong> <?= $row['status_tindakan'] ?: '-' ?><br>
                                    <strong>Tarikh:</strong> <?= ($row['jangkaan_pelaksanaan'] != '0000-00-00') ? date('d/m/Y', strtotime($row['jangkaan_pelaksanaan'])) : '-' ?>
                                </div>
                            </td>
                            <td><div class="x-small" style="min-width: 150px;"><?= $row['catatan'] ?: '-' ?></div></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="17" class="text-center py-5 text-muted">Tiada data dijumpai.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FUNGSI CARIAN (SEARCH)
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('.report-row');

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        tableRows.forEach(row => {
            const text = row.querySelector('.search-area').innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
});
</script>