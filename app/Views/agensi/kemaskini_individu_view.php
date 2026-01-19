<main id="main" class="main">
    <div class="pagetitle mb-4">
        <h4>Kemaskini Terperinci: <strong><?= $row['kod_kuarters'] ?></strong></h4>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Statistik</li>
                <li class="breadcrumb-item active"><?= $row['nama_kuarters'] ?></li>
            </ol>
        </nav>
    </div>

    <form action="<?= base_url('index.php/agensi/simpan_individu') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="id_report" value="<?= $row['id_report'] ?>">
        <input type="hidden" name="bulan" value="<?= $bulan ?>">
        <input type="hidden" name="tahun" value="<?= $tahun ?>">

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">I. Maklumat Hunian (F, G, J)</div>
                    <div class="card-body pt-3">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Permohonan (F)</label>
                            <input type="number" name="jumlah_permohonan" class="form-control" value="<?= $row['jumlah_permohonan'] ?>">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Unit Dihuni (G)</label>
                                <input type="number" id="unit_dihuni" name="unit_dihuni" class="form-control bg-light" value="<?= $row['unit_dihuni'] ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Dihuni (Baik)</label>
                                <input type="number" name="dihuni_baik" class="form-control dihuni-calc" value="<?= $row['dihuni_baik'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Dihuni (Rosak)</label>
                                <input type="number" name="dihuni_rosak" class="form-control dihuni-calc" value="<?= $row['dihuni_rosak'] ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unit Kosong (J)</label>
                            <input type="number" id="unit_tidak_dihuni" name="unit_tidak_dihuni" class="form-control" value="<?= $row['unit_tidak_dihuni'] ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold text-danger">TOTAL UNIT (T)</label>
                            <input type="number" id="total_unit" name="total_unit_kuarters" class="form-control fw-bold bg-warning bg-opacity-10" value="<?= $row['total_unit_kuarters'] ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">II. Cadangan Unit Baik (K)</div>
                    <div class="card-body pt-3">
                        <label class="form-label">Baik & Diduduki</label>
                        <input type="number" name="baik_diduduki" class="form-control mb-2" value="<?= $row['baik_diduduki'] ?>">
                        
                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Guna Sama</label><input type="number" name="baik_guna_sama" class="form-control" value="<?= $row['baik_guna_sama'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_baik_guna_sama" class="form-control" rows="1"><?= $row['ket_baik_guna_sama'] ?></textarea></div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Tukar Fungsi</label><input type="number" name="baik_tukar_fungsi" class="form-control" value="<?= $row['baik_tukar_fungsi'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_baik_tukar_fungsi" class="form-control" rows="1"><?= $row['ket_baik_tukar_fungsi'] ?></textarea></div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Sewaan</label><input type="number" name="baik_sewaan" class="form-control" value="<?= $row['baik_sewaan'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_baik_sewaan" class="form-control" rows="1"><?= $row['ket_baik_sewaan'] ?></textarea></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white">III. Cadangan Unit Rosak (O)</div>
                    <div class="card-body pt-3">
                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Baik Pulih</label><input type="number" name="rosak_baik_pulih" class="form-control" value="<?= $row['rosak_baik_pulih'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_rosak_baik_pulih" class="form-control" rows="1"><?= $row['ket_rosak_baik_pulih'] ?></textarea></div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Guna Sama</label><input type="number" name="rosak_guna_sama" class="form-control" value="<?= $row['rosak_guna_sama'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_rosak_guna_sama" class="form-control" rows="1"><?= $row['ket_rosak_guna_sama'] ?></textarea></div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Tukar Fungsi</label><input type="number" name="rosak_tukar_fungsi" class="form-control" value="<?= $row['rosak_tukar_fungsi'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_rosak_tukar_fungsi" class="form-control" rows="1"><?= $row['ket_rosak_tukar_fungsi'] ?></textarea></div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Sewaan</label><input type="number" name="rosak_sewaan" class="form-control" value="<?= $row['rosak_sewaan'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_rosak_sewaan" class="form-control" rows="1"><?= $row['ket_rosak_sewaan'] ?></textarea></div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-4"><label class="small">Roboh</label><input type="number" name="rosak_roboh" class="form-control" value="<?= $row['rosak_roboh'] ?>"></div>
                            <div class="col-8"><label class="small">Keterangan</label><textarea name="ket_rosak_roboh" class="form-control" rows="1"><?= $row['ket_rosak_roboh'] ?></textarea></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark">IV. Isu & Penyelenggaraan (U, Y, X)</div>
                    <div class="card-body pt-3">
                        <div class="mb-2">
                            <label class="form-label">Kategori Isu (U)</label>
                            <select name="id_kategori_isu" class="form-select">
                                <option value="">Pilih...</option>
                                <?php foreach($kategori_isu as $isu): ?>
                                    <option value="<?= $isu['id_kategori_isu'] ?>" <?= ($row['id_kategori_isu'] == $isu['id_kategori_isu']) ? 'selected' : '' ?>><?= $isu['keterangan_kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Kos RM (Y)</label>
                            <input type="number" name="kos_rm" class="form-control" value="<?= $row['kos_rm'] ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Senarai Kerja (X)</label>
                            <textarea name="senarai_kerja" class="form-control" rows="2"><?= $row['senarai_kerja'] ?></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Keterangan Isu</label>
                            <textarea name="keterangan_isu" class="form-control" rows="2"><?= $row['keterangan_isu'] ?></textarea>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="small">Status Tindakan</label>
                                <textarea name="status_tindakan" class="form-control" rows="1"><?= $row['status_tindakan'] ?></textarea>
                            </div>
                            <div class="col-6">
                                <label class="small">Jangkaan Pelaksanaan</label>
                                <input type="date" name="jangkaan_pelaksanaan" class="form-control" value="<?= $row['jangkaan_pelaksanaan'] ?>">
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="2"><?= $row['catatan'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center pb-5">
            <a href="javascript:history.back()" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary px-5 shadow">Simpan Kemaskini</button>
        </div>
    </form>
</main>