<style>
    /* 1. Container Utama */
    .table-container {
        overflow: auto;
        max-height: 75vh;
        border: 1px solid #dee2e6;
        background: #ffffff;
        position: relative;
    }

    #mainTable {
        border-collapse: separate; 
        border-spacing: 0;
        width: 100%;
    }

    /* 2. TETAPAN HEADER (STICKY TOP) */
    #mainTable thead tr th {
        position: sticky;
        background-color: inherit;
        box-shadow: inset -1px -1px 0 #dee2e6, inset 0 1px 0 #dee2e6;
        border: none !important;
        padding: 5px;
        vertical-align: middle;
        text-align: center;
        line-height: 1.2;
    }

    #mainTable thead tr:nth-child(1) th { top: 0; z-index: 120; height: 40px; }
    #mainTable thead tr:nth-child(2) th { top: 40px; z-index: 110; height: 40px; }
    #mainTable thead tr:nth-child(3) th { top: 80px; z-index: 100; height: 35px; }

    /* 3. KOD & NAMA KUARTERS (STICKY LEFT) */
    /* Header Kolum Pertama */
    #mainTable thead tr:nth-child(1) th:first-child {
        left: 0;
        z-index: 200 !important;
        background-color: #e7cd28 !important;
    }

    /* Body Kolum Pertama (FREEZE) */
    #mainTable tbody td.search-area {
        position: sticky !important;
        left: 0;
        z-index: 50;
        background-color: #f8f9fa !important;
        /* Box shadow di sebelah kanan untuk kesan depth semasa scroll */
        box-shadow: inset -1px -1px 0 #dee2e6, 2px 0 5px rgba(0,0,0,0.1) !important;
    }

    /* 4. KEMASAN DATA */
    #mainTable td {
        box-shadow: inset -1px -1px 0 #dee2e6;
        border: none !important;
        padding: 8px;
    }

    .x-small-text { font-size: 0.72rem; line-height: 1.2; white-space: normal !important; min-width: 200px; }
    .x-small { font-size: 0.72rem; min-width: 150px; }

    #mainTable tbody tr:hover td {
        background-color: #f1f8ff !important;
    }

    /* Kesan warna latar bila tetikus berada di atas sel */
    .search-area:hover {
        background-color: #f0f7ff !important;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
</style>

<section class="content">
    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold">Laporan Bulanan: <?= $nama_bulan ?> <?= $tahun ?></h4>
                    <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i> Mod paparan sahaja. Kolum 'Kod & Nama' akan kekal di kiri semasa skrol.</p>
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
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari kod atau nama kuarters...">
                </div>
            </div>
        </div>

        <div class="table-container shadow-sm rounded">
            <table class="table table-bordered align-middle small mb-0" id="mainTable">
                <thead class="text-center align-middle">
                    <tr class="table-dark">
                        <th rowspan="3" style="background-color: #e7cd28; color: #000; min-width: 280px; width: 280px;">Kod & Nama Kuarters</th>
                        <th rowspan="3" style="background-color: #e9c5dd; color: #000;">Jum. Mohon (F)</th>
                        <th colspan="5" style="background-color: #5d99f2; color: #fff;">MAKLUMAT UNIT DIHUNI</th>
                        <th colspan="3" style="background-color: #0dcaf0; color: #000;">UNIT TIDAK DIHUNI (J)</th>
                        <th colspan="7" style="background-color: #51eda5; color: #000;">KATEGORI: BAIK (TIDAK DIHUNI)</th>
                        <th colspan="10" style="background-color: #f3476c; color: #fff;">KATEGORI: ROSAK (TIDAK DIHUNI)</th>
                        <th colspan="3" style="background-color: #c24aee; color: #fff;">RUMUSAN KUARTERS (T)</th>
                        <th colspan="6" style="background-color: #ffc107; color: #000;">ISU PENGOPERASIAN & PENYELENGGARAAN</th>
                        <th rowspan="3" style="background-color: #d7c690; color: #000;">Catatan</th>
                    </tr>

                    <tr class="table-light text-dark small">
                        <th rowspan="2" style="background-color: #dae8fc;">Jum. (G)</th>
                        <th rowspan="2" style="background-color: #dae8fc;">Baik (H)</th>
                        <th rowspan="2" style="background-color: #dae8fc;">Rosak (I)</th>
                        <th colspan="2" style="background-color: #dae8fc;">Semakan Huni</th>
                        <th colspan="2" style="background-color: #c1f0fb;">Semakan J</th>
                        <th rowspan="2" style="background-color: #c1f0fb;">J</th>
                        <th rowspan="2" style="background-color: #d1f7e4;">Diduduki (K)</th>
                        <th colspan="2" style="background-color: #d1f7e4;">Guna Sama (L)</th>
                        <th colspan="2" style="background-color: #d1f7e4;">Tukar Fungsi (M)</th>
                        <th colspan="2" style="background-color: #d1f7e4;">Sewa/Pajak (N)</th>
                        <th colspan="2" style="background-color: #fbd5dd;">Baik Pulih (O)</th>
                        <th colspan="2" style="background-color: #fbd5dd;">Guna Sama (P)</th>
                        <th colspan="2" style="background-color: #fbd5dd;">Tukar Fungsi (Q)</th>
                        <th colspan="2" style="background-color: #fbd5dd;">Sewa/Pajak (R)</th>
                        <th colspan="2" style="background-color: #fbd5dd;">Roboh (S)</th>
                        <th rowspan="2" style="background-color: #f3e1fa;">Unit (T)</th>
                        <th rowspan="2" style="background-color: #f3e1fa;">Check</th>
                        <th rowspan="2" style="background-color: #f3e1fa;">Valid</th>
                        <th rowspan="2" style="background-color: #fff3cd;">Isu (U)</th>
                        <th rowspan="2" style="background-color: #fff3cd;">Keterangan (V)</th>
                        <th rowspan="2" style="background-color: #fff3cd;">Status (W)</th>
                        <th rowspan="2" style="background-color: #fff3cd;">Kerja (X)</th>
                        <th rowspan="2" style="background-color: #fff3cd;">Kos (Y)</th>
                        <th rowspan="2" style="background-color: #fff3cd;">Tahun</th>
                    </tr>

                    <tr class="table-light text-dark" style="font-size: 0.7rem;">
                        <th style="background-color: #dae8fc;">Check</th><th style="background-color: #dae8fc;">Valid</th>
                        <th style="background-color: #c1f0fb;">Check</th><th style="background-color: #c1f0fb;">Valid</th>
                        <th style="background-color: #d1f7e4;">Jum</th><th style="background-color: #d1f7e4;">Ket</th>
                        <th style="background-color: #d1f7e4;">Jum</th><th style="background-color: #d1f7e4;">Ket</th>
                        <th style="background-color: #d1f7e4;">Jum</th><th style="background-color: #d1f7e4;">Ket</th>
                        <th style="background-color: #fbd5dd;">Jum</th><th style="background-color: #fbd5dd;">Ket</th>
                        <th style="background-color: #fbd5dd;">Jum</th><th style="background-color: #fbd5dd;">Ket</th>
                        <th style="background-color: #fbd5dd;">Jum</th><th style="background-color: #fbd5dd;">Ket</th>
                        <th style="background-color: #fbd5dd;">Jum</th><th style="background-color: #fbd5dd;">Ket</th>
                        <th style="background-color: #fbd5dd;">Jum</th><th style="background-color: #fbd5dd;">Ket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($reports)): foreach ($reports as $row): ?>
                    <tr class="report-row">
                        <td class="search-area p-0"> 
                            <div class="p-3 position-relative"> <a href="<?= site_url("agensi/papar_individu/{$row['id_kuarters']}/{$row['bulan']}/{$row['tahun']}") ?>" 
                                   class="text-decoration-none stretched-link">
                                    <span class="fw-bold text-primary">
                                        <i class="bi bi-search small me-1"></i><?= $row['kod_kuarters'] ?>
                                    </span><br>
                                    <span class="text-uppercase small fw-semibold text-dark">
                                        <?= $row['nama_kuarters'] ?>
                                    </span><br>
                                    <?php if (!empty($row['nama_kategori_kuarters'])): ?>
                                        <span class="badge bg-info text-dark shadow-sm" style="font-size: 11px; font-weight: 600; border-radius: 20px;">
                                            <i class="bi bi-house-door-fill me-1"></i> <?= $row['nama_kategori_kuarters'] ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary shadow-sm" style="font-size: 11px; font-weight: 600; border-radius: 20px; opacity: 0.8;">
                                            <i class="bi bi-exclamation-circle me-1"></i> Tiada Maklumat Kelas
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </td>
                        
                        <td class="text-center"><?= number_format($row['jumlah_permohonan']) ?></td>
                        <td class="text-center"><?= number_format($row['unit_dihuni']) ?></td>
                        <td class="text-center"><?= number_format($row['dihuni_baik']) ?></td>
                        <td class="text-center"><?= number_format($row['dihuni_rosak']) ?></td>
                        <td class="text-center bg-light"><?= (int)$row['dihuni_baik'] + (int)$row['dihuni_rosak'] ?></td>
                        <td class="text-center bg-light">
                            <?php if ($row['unit_dihuni'] == ($row['dihuni_baik'] + $row['dihuni_rosak'])): ?>
                                <span class="badge rounded-pill bg-success px-3">TRUE</span>
                            <?php else: ?>
                                <span class="badge rounded-pill bg-danger px-3">FALSE</span>
                            <?php endif; ?>
                        </td>

                        <?php 
                            $jumlah_cadangan = (int)$row['baik_diduduki'] + (int)$row['baik_guna_sama'] + 
                                               (int)$row['baik_tukar_fungsi'] + (int)$row['baik_sewaan'] + 
                                               (int)$row['rosak_baik_pulih'] + (int)$row['rosak_guna_sama'] + 
                                               (int)$row['rosak_tukar_fungsi'] + (int)$row['rosak_sewaan'] + 
                                               (int)$row['rosak_roboh'];
                        ?>
                        <td class="text-center bg-light"><?= number_format($jumlah_cadangan) ?></td>
                        <td class="text-center bg-light">
                            <?php if ((int)$row['unit_tidak_dihuni'] == $jumlah_cadangan): ?>
                                <span class="badge rounded-pill bg-success px-3">TRUE</span>
                            <?php else: ?>
                                <span class="badge rounded-pill bg-danger px-3">FALSE</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center fw-bold bg-light"><?= number_format($row['unit_tidak_dihuni']) ?></td>

                        <td class="text-center"><?= number_format($row['baik_diduduki']) ?></td>
                        <td class="text-center"><?= number_format($row['baik_guna_sama']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_baik_guna_sama'])) ?></td>
                        <td class="text-center"><?= number_format($row['baik_tukar_fungsi']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_baik_tukar_fungsi'])) ?></td>
                        <td class="text-center"><?= number_format($row['baik_sewaan']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_baik_sewaan'])) ?></td>

                        <td class="text-center"><?= number_format($row['rosak_baik_pulih']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_rosak_baik_pulih'])) ?></td>
                        <td class="text-center"><?= number_format($row['rosak_guna_sama']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_rosak_guna_sama'])) ?></td>
                        <td class="text-center"><?= number_format($row['rosak_tukar_fungsi']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_rosak_tukar_fungsi'])) ?></td>
                        <td class="text-center"><?= number_format($row['rosak_sewaan']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_rosak_sewaan'])) ?></td>
                        <td class="text-center"><?= number_format($row['rosak_roboh']) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['ket_rosak_roboh'])) ?></td>

                        <td class="text-center fw-bold"><?= number_format($row['total_unit_kuarters']) ?></td>
                        <td class="text-center bg-light"><?= (int)$row['unit_dihuni'] + (int)$row['unit_tidak_dihuni'] ?></td>
                        <td class="text-center bg-light">
                            <?php if ((int)$row['total_unit_kuarters'] == ((int)$row['unit_dihuni'] + (int)$row['unit_tidak_dihuni'])): ?>
                                <span class="badge rounded-pill bg-success" style="width: 60px; font-size: 0.65rem;">TRUE</span>
                            <?php else: ?>
                                <span class="badge rounded-pill bg-danger" style="width: 60px; font-size: 0.65rem;">FALSE</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-start">
                            <?php if (!empty($row['nama_kategori_isu'])): 
                                $items = explode(', ', $row['nama_kategori_isu']);
                                foreach ($items as $item): ?>
                                    <span class="badge bg-info text-dark mb-1"><?= $item ?></span>
                                <?php endforeach; 
                            else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['keterangan_isu'])) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['status_tindakan'])) ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['senarai_kerja'])) ?></td>
                        <td class="text-end"><?= number_format($row['kos_rm'], 2) ?></td>
                        <td class="text-center"><?= $row['jangkaan_pelaksanaan'] ?></td>
                        <td class="text-start x-small"><?= nl2br(htmlspecialchars($row['catatan'])) ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="40" class="text-center py-4">Tiada data dijumpai.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</section>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('.report-row');
        rows.forEach(row => {
            let text = row.querySelector('.search-area').textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>