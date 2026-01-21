<main id="main" class="main">
    <div class="pagetitle mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1">Paparan Terperinci: <strong><?= $row['kod_kuarters'] ?></strong></h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">Statistik</li>
                    <li class="breadcrumb-item active"><?= $row['nama_kuarters'] ?></li>
                    <li class="breadcrumb-item active text-primary small"><?= $bulan ?>/<?= $tahun ?></li>
                </ol>
            </nav>
        </div>
        
        <div class="d-print-none d-flex gap-2">
            <button onclick="window.print()" class="btn btn-outline-dark btn-sm shadow-sm">
                <i class="bi bi-printer me-1"></i> Cetak
            </button>
            <a href="javascript:history.back()" class="btn btn-secondary btn-sm shadow-sm px-3">
                <i class="bi bi-arrow-left-short"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4 border-0 h-100">
                <div class="card-header bg-primary text-white py-3">I. Maklumat Hunian (F, G, J)</div>
                <div class="card-body pt-3">
                    <div class="mb-3">
                        <label class="small text-muted d-block">Jumlah Permohonan (F)</label>
                        <div class="fw-bold fs-5 text-dark border-bottom pb-1"><?= $row['jumlah_permohonan'] ?: '0' ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-center border-end">
                            <label class="small text-muted d-block">Unit Dihuni (G)</label>
                            <div class="fw-bold text-primary fs-5"><?= $row['unit_dihuni'] ?: '0' ?></div>
                        </div>
                        <div class="col-md-4 text-center border-end">
                            <label class="small text-muted d-block">Dihuni (Baik)</label>
                            <div class="fw-bold text-success fs-5"><?= $row['dihuni_baik'] ?: '0' ?></div>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="small text-muted d-block">Dihuni (Rosak)</label>
                            <div class="fw-bold text-danger fs-5"><?= $row['dihuni_rosak'] ?: '0' ?></div>
                        </div>
                    </div>
                    <div class="mb-3 text-center p-2 bg-light rounded border">
                        <label class="small text-muted d-block text-uppercase">Unit Kosong (J)</label>
                        <div class="fw-bold fs-4 text-dark"><?= $row['unit_tidak_dihuni'] ?: '0' ?></div>
                    </div>
                    <div class="mb-2 p-2 bg-warning bg-opacity-10 border border-warning rounded text-center">
                        <label class="form-label fw-bold text-danger mb-0 small">TOTAL UNIT (T)</label>
                        <div class="h4 fw-bold mb-0"><?= $row['total_unit_kuarters'] ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm mb-4 border-0 h-100">
                <div class="card-header bg-success text-white py-3">II. Cadangan Unit Baik (K)</div>
                <div class="card-body pt-3">
                    <div class="mb-2 border-bottom pb-2">
                        <label class="small text-muted d-block">Baik & Diduduki</label>
                        <div class="fw-bold fs-5"><?= $row['baik_diduduki'] ?: '0' ?></div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless small mb-0 mt-2">
                            <?php $items = ['guna_sama' => 'Guna Sama', 'tukar_fungsi' => 'Tukar Fungsi', 'sewaan' => 'Sewaan']; ?>
                            <?php foreach($items as $key => $label): ?>
                            <tr class="border-bottom">
                                <th width="35%" class="py-2 text-muted"><?= $label ?></th>
                                <td width="15%" class="py-2">: <span class="badge bg-light text-dark border"><?= $row['baik_'.$key] ?></span></td>
                                <td class="py-2 text-muted small italic"><?= $row['ket_baik_'.$key] ?: '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm mb-4 border-0 mt-lg-0 mt-4 h-100">
                <div class="card-header bg-danger text-white py-3">III. Cadangan Unit Rosak (O)</div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless small mb-0">
                            <?php 
                            $rosak_fields = [
                                'baik_pulih' => 'Baik Pulih',
                                'guna_sama'  => 'Guna Sama',
                                'tukar_fungsi'=> 'Tukar Fungsi',
                                'sewaan'      => 'Sewaan',
                                'roboh'       => 'Roboh'
                            ];
                            foreach($rosak_fields as $key => $label): ?>
                            <tr class="border-bottom">
                                <th width="35%" class="py-2 text-muted"><?= $label ?></th>
                                <td width="15%" class="py-2">: <span class="badge bg-light text-dark border"><?= $row['rosak_'.$key] ?></span></td>
                                <td class="py-2 text-muted small italic"><?= $row['ket_rosak_'.$key] ?: '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm mb-4 border-0 mt-lg-0 mt-4 h-100">
                <div class="card-header bg-warning text-dark py-3 fw-bold">IV. Isu & Penyelenggaraan (U, Y, X)</div>
                <div class="card-body pt-3">
                    <div class="row mb-3">
                        <div class="col-6 border-end">
                            <label class="small text-muted d-block text-uppercase">Kategori Isu (U)</label>
                            <div class="fw-bold text-dark">
                                <?php 
                                    $kategori_nama = 'Tiada Maklumat';
                                    foreach($kategori_isu as $isu) {
                                        if($row['id_kategori_isu'] == $isu['id_kategori_isu']) $kategori_nama = $isu['keterangan_kategori'];
                                    }
                                    echo $kategori_nama;
                                ?>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <label class="small text-muted d-block text-uppercase">Kos RM (Y)</label>
                            <div class="fw-bold fs-5 text-primary">RM <?= number_format($row['kos_rm'], 2) ?></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted d-block">Senarai Kerja (X)</label>
                        <div class="p-2 bg-light border-start border-3 border-primary rounded-end small"><?= nl2br($row['senarai_kerja'] ?: '-') ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small text-muted d-block text-uppercase">Status Tindakan</label>
                            <div class="small fw-bold"><?= $row['status_tindakan'] ?: '-' ?></div>
                        </div>
                        <div class="col-6 text-end">
                            <label class="small text-muted d-block text-uppercase">Jangkaan Pelaksanaan</label>
                            <div class="small fw-bold"><i class="bi bi-calendar-event me-1"></i><?= $row['jangkaan_pelaksanaan'] ?: '-' ?></div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="small text-muted d-block">Catatan</label>
                        <div class="p-2 bg-warning bg-opacity-10 border border-warning-light rounded small"><?= $row['catatan'] ?: 'Tiada catatan.' ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-5"></div>
</main>

<style>
    @media print {
        #main { margin-top: 0 !important; padding: 0 !important; }
        .card { border: 1px solid #ddd !important; box-shadow: none !important; }
        .card-header { background-color: #f8f9fa !important; color: #000 !important; border-bottom: 2px solid #333 !important; }
        .badge { border: 1px solid #000 !important; color: #000 !important; }
    }
    .italic { font-style: italic; }
</style>