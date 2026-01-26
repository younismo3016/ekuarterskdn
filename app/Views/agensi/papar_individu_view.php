<main id="main" class="main">
    <div class="container-fluid py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0 text-dark">Laporan Terperinci Kuarters</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item small"><a href="#">Statistik</a></li>
                        <li class="breadcrumb-item small active" aria-current="page">Paparan Individu</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-outline-primary shadow-sm px-3">
                    <i class="bi bi-printer me-1"></i> Cetak
                </button>
                <a href="<?= base_url('index.php/agensi/agensi_statistik_papar/' . $bulan . '/' . $tahun) ?>" class="btn btn-secondary shadow-sm px-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header border-0 bg-dark p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning rounded-3 p-3 me-3">
                                <i class="bi bi-building fs-3 text-dark"></i>
                            </div>
                            <div>
                                <h3 class="mb-1 fw-bold text-white text-uppercase"><?= $data['nama_kuarters'] ?></h3>
                                <div class="d-flex gap-3">
                                    <span class="text-white-50 small"><i class="bi bi-hash me-1"></i><?= $data['kod_kuarters'] ?></span>
                                    <span class="text-white-50 small"><i class="bi bi-tag me-1"></i><?= $data['jenis_kuarters'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="p-2 bg-white bg-opacity-10 rounded-pill d-inline-block px-4">
                            <span class="text-white small fw-bold">TEMPOH: <?= $bulan ?> / <?= $tahun ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-4 bg-light bg-opacity-50">
                <div class="row g-4 mb-5">
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small fw-semibold">JUMLAH MOHON</span>
                                    <i class="bi bi-people text-primary"></i>
                                </div>
                                <h3 class="fw-bold mb-0"><?= number_format($data['jumlah_permohonan']) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm rounded-3 border-start border-primary border-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small fw-semibold">UNIT DIHUNI (G)</span>
                                    <i class="bi bi-house-check text-primary"></i>
                                </div>
                                <h3 class="fw-bold mb-0"><?= number_format($data['unit_dihuni']) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm rounded-3 border-start border-info border-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small fw-semibold">TOTAL UNIT (T)</span>
                                    <i class="bi bi-buildings text-info"></i>
                                </div>
                                <h3 class="fw-bold mb-0"><?= number_format($data['total_unit_kuarters']) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <?php $isValid = ((int)$data['total_unit_kuarters'] == ((int)$data['unit_dihuni'] + (int)$data['unit_tidak_dihuni'])); ?>
                        <div class="card h-100 border-0 shadow-sm rounded-3 <?= $isValid ? 'bg-success text-white' : 'bg-danger text-white' ?>">
                            <div class="card-body text-center">
                                <small class="d-block opacity-75 fw-bold">STATUS VALIDASI</small>
                                <h4 class="fw-bold mb-1 mt-1"><?= $isValid ? 'SAH' : 'RALAT' ?></h4>
                                <i class="bi <?= $isValid ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?> fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm h-100 rounded-3">
                            <div class="card-header bg-white py-3">
                                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-pie-chart me-2"></i>Maklumat Unit Dihuni</h6>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                        <span class="text-muted">Kategori Baik (H)</span>
                                        <span class="badge bg-primary-subtle text-primary rounded-pill fs-6"><?= $data['dihuni_baik'] ?></span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                        <span class="text-muted">Kategori Rosak (I)</span>
                                        <span class="badge bg-danger-subtle text-danger rounded-pill fs-6"><?= $data['dihuni_rosak'] ?></span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 bg-light-subtle fw-bold">
                                        <span class="text-dark">JUMLAH SEMAKAN HUNI</span>
                                        <span class="text-primary fs-5"><?= (int)$data['dihuni_baik'] + (int)$data['dihuni_rosak'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm h-100 rounded-3">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-house-exclamation me-2"></i>Unit Tidak Dihuni (J)</h6>
                                <span class="badge bg-dark rounded-pill fs-6"><?= $data['unit_tidak_dihuni'] ?> Unit</span>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr class="small text-uppercase">
                                            <th class="ps-4">Status & Kategori</th>
                                            <th class="text-center">Bilangan</th>
                                            <th class="pe-4">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                        <tr>
                                            <td class="ps-4 fw-bold text-success border-start border-4 border-success">BAIK: Diduduki</td>
                                            <td class="text-center fw-bold"><?= $data['baik_diduduki'] ?></td>
                                            <td class="text-muted pe-4">-</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 fw-bold text-success border-start border-4 border-success">BAIK: Guna Sama</td>
                                            <td class="text-center fw-bold"><?= $data['baik_guna_sama'] ?></td>
                                            <td class="text-muted pe-4 small"><?= $data['ket_baik_guna_sama'] ?: '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 fw-bold text-danger border-start border-4 border-danger">ROSAK: Baik Pulih</td>
                                            <td class="text-center fw-bold text-danger"><?= $data['rosak_baik_pulih'] ?></td>
                                            <td class="text-muted pe-4 small"><?= $data['ket_rosak_baik_pulih'] ?: '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 fw-bold text-danger border-start border-4 border-danger">ROSAK: Roboh</td>
                                            <td class="text-center fw-bold text-danger"><?= $data['rosak_roboh'] ?></td>
                                            <td class="text-muted pe-4 small"><?= $data['ket_rosak_roboh'] ?: '-' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-warning border-0 py-3">
                                <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-tools me-2"></i>Isu Pengoperasian & Penyelenggaraan</h6>
                            </div>
                            <div class="card-body bg-white p-4">
                           <div class="row g-4">
    <div class="col-md-3 text-center border-end">
        <label class="text-muted small d-block mb-1 text-uppercase fw-bold" style="letter-spacing: 1px;">Anggaran Kos</label>
        <div class="py-2">
            <span class="text-secondary small">RM</span>
            <h2 class="text-danger fw-extrabold d-inline mb-0">
                <?= number_format($data['kos_rm'], 2) ?>
            </h2>
        </div>
        <div class="mt-2">
            <span class="badge rounded-pill bg-dark px-3 py-2 small">
                <i class="bi bi-calendar-event me-1 text-warning"></i>
                Pelaksanaan: <?= $data['jangkaan_pelaksanaan'] ?: 'Tiada Rekod' ?>
            </span>
        </div>
    </div>

    <div class="col-md-3 px-4 border-end">
        <label class="text-muted small d-block mb-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Kategori Isu</label>
        <div class="d-flex flex-wrap gap-2">
            <?php if (!empty($senarai_isu)): foreach ($senarai_isu as $isu): ?>
                <div class="d-flex align-items-center bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-2 px-2 py-1">
                    <i class="bi bi-dot fs-4"></i>
                    <span class="small fw-semibold"><?= $isu['nama_kategori_isu'] ?></span>
                </div>
            <?php endforeach; else: ?>
                <span class="text-muted fst-italic small">Tiada kategori isu dipilih</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-3 px-4 border-end">
        <label class="text-muted small d-block mb-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Keterangan Isu</label>
        <div class="p-3 bg-light rounded-3 border-start border-3 border-warning shadow-sm">
            <p class="small text-dark mb-0 lh-base" style="text-align: justify;">
                <?= nl2br(htmlspecialchars($data['keterangan_isu'])) ?: '<span class="text-muted">Tiada keterangan disediakan.</span>' ?>
            </p>
        </div>
    </div>

    <div class="col-md-3 px-4">
        <label class="text-muted small d-block mb-2 text-uppercase fw-bold" style="letter-spacing: 1px;">Status Tindakan</label>
        <div class="p-3 bg-success bg-opacity-10 rounded-3 border border-success border-opacity-25 shadow-sm">
            <p class="small text-success mb-0 fw-medium">
                <i class="bi bi-info-circle-fill me-1"></i>
                <?= nl2br(htmlspecialchars($data['status_tindakan'])) ?: 'Menunggu tindakan selanjutnya.' ?>
            </p>
        </div>
    </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-white border-start border-5 border-secondary rounded shadow-sm">
                    <h6 class="fw-bold small text-secondary text-uppercase mb-2">Catatan Tambahan</h6>
                    <p class="mb-0 small text-dark fst-italic"><?= $data['catatan'] ?: 'Tiada catatan tambahan direkodkan.' ?></p>
                </div>
            </div>

            <div class="card-footer bg-white border-0 py-3 text-center">
                <p class="text-muted mb-0 small"><i class="bi bi-info-circle me-1"></i> Laporan ini dijana oleh sistem pada <?= date('d/m/Y H:i') ?></p>
            </div>
        </div>
    </div>
</main>

<style>
    /* Custom Styling for Dashboard Feel */
    .stat-card {
        padding: 1.5rem;
        transition: transform 0.2s ease, shadow 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .bg-custom-blue { background-color: #f0f7ff; }
    .bg-custom-purple { background-color: #f8f3ff; }
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        font-size: 1.2rem;
        vertical-align: middle;
    }
    @media print {
        .main { margin: 0; padding: 0; }
        .btn, .breadcrumb { display: none !important; }
        .card { border: none !important; box-shadow: none !important; }
        .card-header { background-color: #000 !important; color: #fff !important; -webkit-print-color-adjust: exact; }
    }
</style>