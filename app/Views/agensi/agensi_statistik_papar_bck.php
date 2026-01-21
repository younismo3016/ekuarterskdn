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
                    <h4 class="fw-bold ">Laporan Bulanan: <?= $nama_bulan ?> <?= $tahun ?></h4>
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
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari kod atau nama kuarters...">
                    </div>
                </div>
            </div>

        <div class="table-container shadow-sm rounded">
            <table class="table table-bordered align-middle small mb-0" id="mainTable">
    <thead class="text-center text-white">
        <tr class="table-light text-dark">
            <th style="background-color: #e7cd28; color: #000;">Kod & Nama Kuarters</th>
            <th style="background-color: #e9c5dd; color: #000;">Jum. Mohon (F)</th>
            <th style="background-color: #5d99f2;">Jum.Dihuni (G)</th>
            <th style="background-color: #5d99f2;">Dihuni-Baik (H)</th>
            <th style="background-color: #5d99f2;">Dihuni-Rosak (I)</th>
            <th style="background-color: #5d99f2;">Jumlah Huni (Check)</th>
            <th style="background-color: #5d99f2;">Jumlah Huni (Validity)</th>
            <th style="background-color: #0dcaf0; color: #000;">Jumlah Unit Tidak Dihuni (J)</th>
            <th style="background-color: #0dcaf0; color: #000;">Jumlah Tidak Huni (Check)</th>
            <th style="background-color: #0dcaf0; color: #000;">Jumlah Tidak Huni (Validity)</th>
            <th style="background-color: #51eda5; color: #000;">Jum. Baik Boleh Diduduki (K)</th>
            <th style="background-color: #51eda5; color: #000;">Jum. Baik Cadangan Guna Sama (L)</th>
            <th style="background-color: #51eda5; color: #000;">Keterangan- Baik Guna Sama</th>
            <th style="background-color: #51eda5; color: #000;">Jumlah Baik Cadangan Tukar Fungsi(M)</th>
            <th style="background-color: #51eda5; color: #000;">Keterangan Baik Cadangan Tukar Fungsi</th>
            <th style="background-color: #51eda5; color: #000;">Jumlah Baik Sewaan, Pajakan(N)</th>
            <th style="background-color: #51eda5; color: #000;">Keterangan Baik Sewaan, Pajakan</th>
            <th style="background-color: #f3476c; color: #000;">Jumlah Rosak - Perlu Baik Pulih (O)</th>
            <th style="background-color: #f3476c; color: #000;">Keterangan Rosak - Perlu Baik Pulih</th>
            <th style="background-color: #f3476c; color: #000;">Jumlah Rosak - Cadangan Guna Sama (P)</th>
            <th style="background-color: #f3476c; color: #000;">Keterangan Rosak - Guna Sama (P)</th>
            <th style="background-color: #f3476c; color: #000;">Jumlah Rosak - Cadangan Tukar Fungsi (Q)</th>
            <th style="background-color: #f3476c; color: #000;">Keterangan Rosak - Cadangan Tukar Fungsi</th>
            <th style="background-color: #f3476c; color: #000;">Jumlah Rosak - Cadangan Sewaan/Pajakan (R)</th>
            <th style="background-color: #f3476c; color: #000;">Keterangan Rosak - Cadangan Sewaan/Pajakan</th>
            <th style="background-color: #f3476c; color: #000;">Jumlah Rosak - Cadangan Roboh (S)</th>
            <th style="background-color: #f3476c; color: #000;">Keterangan Rosak - Cadangan Roboh</th>
            <th style="background-color: #c24aee;">Jumlah Unit Kuarters (T)</th>
            <th style="background-color: #c24aee;">Jumlah Kuarters (Check)</th>
            <th style="background-color: #c24aee;">Jumlah Kuarters (Validity)</th>
            <th style="background-color: #ffc107; color: #000;">Isu Pengoperasian (U)</th>
            <th style="background-color: #ffc107; color: #000;">Keterangan Isu (V)</th>
            <th style="background-color: #ffc107; color: #000;">Status Tindakan Terkini & Cadangan Penyelesaian (W)</th>
            <th style="background-color: #ffc107; color: #000;">Senarai Kerja Penyelenggaraan/Pembaikan (X)</th>
            <th style="background-color: #ffc107; color: #000;">Kos Penyelenggaraan (RM) (Y)</th>
            <th style="background-color: #ffc107; color: #000;">Jangkaan Tahun Perlaksaan</th>
            <th style="background-color: #d7c690; color: #000;">Catatan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $index => $row): ?>
        <tr class="report-row">
           <td class="search-area text-start bg-light">
                <span class="fw-bold text-primary"><?= $row['kod_kuarters'] ?></span><br>
                <span class="text-uppercase small fw-semibold"><?= $row['nama_kuarters'] ?></span><br>
                <span class="badge bg-secondary" style="font-size: 9px;"><?= $row['jenis_kuarters'] ?></span>
            </td>

            <td><?= number_format($row['jumlah_permohonan']) ?></td>
            <td><?= number_format($row['unit_dihuni']) ?></td>
            <td><?= number_format($row['dihuni_baik']) ?></td>
            <td><?= number_format($row['dihuni_rosak']) ?></td>
            
            <td class="fw-bold text-primary bg-light">
                <?= (int)$row['dihuni_baik'] + (int)$row['dihuni_rosak'] ?>
            </td>
            
            <?php $huni_tally = ($row['unit_dihuni'] == ($row['dihuni_baik'] + $row['dihuni_rosak'])); ?>
            <td class="fw-bold <?= $huni_tally ? 'text-success' : 'text-danger' ?> bg-light">
                <?= $huni_tally ? 'TRUE' : 'FALSE' ?>
            </td>

            <td><?= number_format($row['unit_tidak_dihuni']) ?></td>
            
            <?php 
                $jumlah_cadangan = (int)$row['baik_diduduki'] + (int)$row['baik_guna_sama'] + 
                                   (int)$row['baik_tukar_fungsi'] + (int)$row['baik_sewaan'] + 
                                   (int)$row['rosak_baik_pulih'] + (int)$row['rosak_guna_sama'] + 
                                   (int)$row['rosak_tukar_fungsi'] + (int)$row['rosak_sewaan'] + 
                                   (int)$row['rosak_roboh'];
            ?>
            <td class="fw-bold text-primary bg-light"><?= number_format($jumlah_cadangan) ?></td>
            
            <?php $cadangan_tally = ((int)$row['unit_tidak_dihuni'] == $jumlah_cadangan); ?>
            <td class="fw-bold <?= $cadangan_tally ? 'text-success' : 'text-danger' ?> bg-light">
                <?= $cadangan_tally ? 'TRUE' : 'FALSE' ?>
            </td>

            <td><?= number_format($row['baik_diduduki']) ?></td>
            <td><?= number_format($row['baik_guna_sama']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_baik_guna_sama'])) ?></td>
            <td><?= number_format($row['baik_tukar_fungsi']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_baik_tukar_fungsi'])) ?></td>
            <td><?= number_format($row['baik_sewaan']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_baik_sewaan'])) ?></td>

            <td><?= number_format($row['rosak_baik_pulih']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_rosak_baik_pulih'])) ?></td>
            <td><?= number_format($row['rosak_guna_sama']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_rosak_guna_sama'])) ?></td>
            <td><?= number_format($row['rosak_tukar_fungsi']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_rosak_tukar_fungsi'])) ?></td>
            <td><?= number_format($row['rosak_sewaan']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_rosak_sewaan'])) ?></td>
            <td><?= number_format($row['rosak_roboh']) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['ket_rosak_roboh'])) ?></td>

            <td><?= number_format($row['total_unit_kuarters']) ?></td>
            <?php $total_kuarters = (int)$row['unit_dihuni'] + (int)$row['unit_tidak_dihuni']; ?>
            <td class="fw-bold text-primary bg-light"><?= number_format($total_kuarters) ?></td>
            <?php $total_tally = ((int)$row['total_unit_kuarters'] == $total_kuarters); ?>
            <td class="fw-bold <?= $total_tally ? 'text-success' : 'text-danger' ?> bg-light">
                <?= $total_tally ? 'TRUE' : 'FALSE' ?>
            </td>

            <td class="text-start">
                <?php 
                    foreach ($kategori_isu as $isu) {
                        if ($row['id_kategori_isu'] == $isu['id_kategori_isu']) {
                            echo $isu['keterangan_kategori'];
                        }
                    }
                ?>
            </td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['keterangan_isu'])) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['status_tindakan'])) ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['senarai_kerja'])) ?></td>
            <td class="text-end"><?= number_format($row['kos_rm'], 2) ?></td>
            <td><?= $row['jangkaan_pelaksanaan'] ?></td>
            <td class="text-start"><?= nl2br(htmlspecialchars($row['catatan'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        </div>
    </main>
</section>

<script>
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