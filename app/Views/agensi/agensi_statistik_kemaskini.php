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
                        <h4 class="fw-bold">Kemaskini Laporan Bulanan:  <?= $nama_bulan ?> <?= $tahun ?></h4>
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

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

           <div class="row mb-3 align-items-center">
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari kod atau nama kuarters...">
        </div>
    </div>
    <div class="col-md-8 text-end">
        <div class="d-flex flex-column text-muted" style="line-height: 1.2;">
            <span style="font-size: 0.85rem;">
                <i class="bi bi-clock-history"></i> Kemaskini Terakhir: 
                <strong><?= ($tarikh_terakhir) ? date('d/m/Y h:i A', strtotime($tarikh_terakhir)) : 'Tiada Data'; ?></strong>
            </span>
            <span style="font-size: 0.80rem;">
    Oleh: <strong><?= ucwords(strtolower($oleh)); ?></strong>
</span>
        </div>
    </div>
</div>

            <div class="table-container shadow-sm border rounded">
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
                    <th style="background-color: #ffc107; color: #000;">Status Tindakan Terkini &  Cadangan Penyelesaian (W)</th>
                    <th style="background-color: #ffc107; color: #000;">Senarai Kerja Penyelenggaraan/Pembaikan (X)</th>
                    <th style="background-color: #ffc107; color: #000;">Kos Penyelenggaraan Yang Diperlukan (RM) (Y)</th>
                    <th style="background-color: #ffc107; color: #000;">Jangkaan Tahun Perlaksaan</th>
                    <th style="background-color: #d7c690; color: #000;">Catatan</th>
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
                                 <?php if (!empty($row['nama_kategori_kuarters'])): ?>
                        <span class="badge bg-info text-dark shadow-sm" style="font-size: 11px; font-weight: 600; border-radius: 20px;">
                            <i class="bi bi-house-door-fill me-1"></i> <?= $row['nama_kategori_kuarters'] ?>
                        </span>
                    <?php else: ?>
                        <span class="badge bg-secondary shadow-sm" style="font-size: 11px; font-weight: 600; border-radius: 20px; opacity: 0.8;">
                            <i class="bi bi-exclamation-circle me-1"></i> Tiada Maklumat Kelas
                        </span>
                    <?php endif; ?>
                            </td>

                          <td>
                            <input type="number" 
                                name="report[<?= $index ?>][jumlah_permohonan]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['jumlah_permohonan'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                        </td>

                         <td>
                            <input type="number" 
                                name="report[<?= $index ?>][unit_dihuni]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['unit_dihuni'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                        </td>

                        <td>
                            <input type="number" 
                                name="report[<?= $index ?>][dihuni_baik]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['dihuni_baik'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                        </td>
                        
                         <td>
                            <input type="number" 
                                name="report[<?= $index ?>][dihuni_rosak]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['dihuni_rosak'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                        </td>

                        
                       <td>
                            <input type="text" 
                                class="form-control form-control-sm bg-light fw-bold text-center text-primary" 
                                value="<?= (int)$row['dihuni_baik'] + (int)$row['dihuni_rosak'] ?>" 
                                readonly>
                        </td>
                        <td>
                            <?php 
                                // Logik semakan: G == (H + I)
                                $is_tally = ($row['unit_dihuni'] == ($row['dihuni_baik'] + $row['dihuni_rosak']));
                            ?>
                            <input type="text" 
                                class="form-control form-control-sm fw-bold text-center <?= $is_tally ? 'text-success' : 'text-danger' ?> bg-light" 
                                value="<?= $is_tally ? 'TRUE' : 'FALSE' ?>" 
                                readonly>
                        </td>
                           
                           
                            <td><input type="number" name="report[<?= $index ?>][unit_tidak_dihuni]" class="form-control form-control-sm calc-trigger" value="<?= $row['unit_tidak_dihuni'] ?>"></td>
                           <td>
                                <?php 
                                    // Mengira jumlah keseluruhan cadangan unit
                                    $jumlah_cadangan = (int)$row['baik_diduduki'] + 
                                                    (int)$row['baik_guna_sama'] + 
                                                    (int)$row['baik_tukar_fungsi'] + 
                                                    (int)$row['baik_sewaan'] + 
                                                    (int)$row['rosak_baik_pulih'] + 
                                                    (int)$row['rosak_guna_sama'] + 
                                                    (int)$row['rosak_tukar_fungsi'] + 
                                                    (int)$row['rosak_sewaan'] + 
                                                    (int)$row['rosak_roboh'];
                                ?>
                                <input type="text" 
                                    class="form-control form-control-sm bg-light fw-bold text-center text-primary" 
                                    value="<?= number_format($jumlah_cadangan) ?>" 
                                    readonly>
                            </td>
                           <td>
                            <?php 
                                // 1. Kira jumlah semua cadangan (Baik + Rosak)
                                $total_cadangan = (int)$row['baik_diduduki'] + (int)$row['baik_guna_sama'] + 
                                                (int)$row['baik_tukar_fungsi'] + (int)$row['baik_sewaan'] + 
                                                (int)$row['rosak_baik_pulih'] + (int)$row['rosak_guna_sama'] + 
                                                (int)$row['rosak_tukar_fungsi'] + (int)$row['rosak_sewaan'] + 
                                                (int)$row['rosak_roboh'];

                                // 2. Semak adakah Jumlah Kosong (unit_tidak_dihuni) SAMA dengan Total Cadangan
                                $is_tally = ((int)$row['unit_tidak_dihuni'] == $total_cadangan);
                            ?>
                            
                            <input type="text" 
                                class="form-control form-control-sm fw-bold text-center <?= $is_tally ? 'text-success' : 'text-danger' ?> bg-light" 
                                value="<?= $is_tally ? 'TRUE' : 'FALSE' ?>" 
                                title="Semakan: Unit Kosong vs Jumlah Cadangan"
                                readonly>
                        </td>
                         
                         <td>
                            <input type="number" 
                                name="report[<?= $index ?>][baik_diduduki]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['baik_diduduki'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                        </td>
                            <td>
                            <input type="number" 
                                name="report[<?= $index ?>][baik_guna_sama]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['baik_guna_sama'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                        </td>

                           <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_baik_guna_sama]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_baik_guna_sama'] ?></textarea>
                            </td>
                            
                          <td>
                            <input type="number" 
                                name="report[<?= $index ?>][baik_tukar_fungsi]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['baik_tukar_fungsi'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>
                            
                           
                           
                           
                            <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_baik_tukar_fungsi]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_baik_tukar_fungsi'] ?></textarea>
                            </td>
                           
                           <td>
                            <input type="number" 
                                name="report[<?= $index ?>][baik_sewaan]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['baik_sewaan'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>



                           <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_baik_sewaan]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_baik_sewaan'] ?></textarea>
                            </td>

                          <td>
                            <input type="number" 
                                name="report[<?= $index ?>][rosak_baik_pulih]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['rosak_baik_pulih'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>


                            <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_rosak_baik_pulih]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_rosak_baik_pulih'] ?></textarea>
                            </td>

                               <td>
                            <input type="number" 
                                name="report[<?= $index ?>][rosak_guna_sama]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['rosak_guna_sama'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>

                           
                           
                           
                            <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_rosak_guna_sama]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_rosak_guna_sama'] ?></textarea>
                            </td>

                                <td>
                            <input type="number" 
                                name="report[<?= $index ?>][rosak_tukar_fungsi]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['rosak_tukar_fungsi'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>

                              <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_rosak_tukar_fungsi]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_rosak_tukar_fungsi'] ?></textarea>
                            </td>

                                    <td>
                            <input type="number" 
                                name="report[<?= $index ?>][rosak_sewaan]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['rosak_sewaan'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>

                                <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_rosak_sewaan]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_rosak_sewaan'] ?></textarea>
                            </td>

                                        <td>
                            <input type="number" 
                                name="report[<?= $index ?>][rosak_roboh]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['rosak_roboh'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>
                            
                               <td>
                            <textarea 
                                name="report[<?= $index ?>][ket_rosak_roboh]" 
                                class="form-control form-control-sm wide-input" 
                                rows="1" 
                                style="min-width: 150px;"><?= $row['ket_rosak_roboh'] ?></textarea>
                            </td>

                                       <td>
                            <input type="number" 
                                name="report[<?= $index ?>][total_unit_kuarters]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['total_unit_kuarters'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>

                              <td>
                                <?php 
                                    // Mengira jumlah unit kuarters
                                    $jumlah_unit_kuaters= (int)$row['unit_dihuni'] + 
                                                          (int)$row['unit_tidak_dihuni'];
                                ?>
                                <input type="text" 
                                    class="form-control form-control-sm bg-light fw-bold text-center text-primary" 
                                    value="<?= number_format($jumlah_unit_kuaters) ?>" 
                                    readonly>
                            </td>
                            <td>
                            <?php 
                                // 1. Kira jumlah semua cadangan (Baik + Rosak)
                                 $jumlah_unit_kuaters= (int)$row['unit_dihuni'] + 
                                                          (int)$row['unit_tidak_dihuni'];

                                // 2. Semak adakah Jumlah Kosong (unit_tidak_dihuni) SAMA dengan Total Cadangan
                                $is_tally = ((int)$row['total_unit_kuarters'] == $jumlah_unit_kuaters);
                            ?>
                            
                            <input type="text" 
                                class="form-control form-control-sm fw-bold text-center <?= $is_tally ? 'text-success' : 'text-danger' ?> bg-light" 
                                value="<?= $is_tally ? 'TRUE' : 'FALSE' ?>" 
                                title="Semakan: Unit Kosong vs Jumlah Cadangan"
                                readonly>
                        </td>
                           
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

                             <td><textarea name="report[<?= $index ?>][keterangan_isu]" class="form-control form-control-sm wide-input" rows="1"><?= $row['keterangan_isu'] ?></textarea></td>
                           
                          <td class="wide-input">
                            <textarea 
                                name="report[<?= $index ?>][status_tindakan]" 
                                class="form-control form-control-sm mb-1" 
                                rows="1" 
                                style="min-width: 180px;"><?= $row['status_tindakan'] ?></textarea>
                        </td>
                          <td><textarea name="report[<?= $index ?>][senarai_kerja]" class="form-control form-control-sm wide-input" rows="1"><?= $row['senarai_kerja'] ?></textarea></td>
                            
                                        <td>
                            <input type="number" 
                                name="report[<?= $index ?>][kos_rm]" 
                                class="form-control form-control-sm" 
                                value="<?= $row['kos_rm'] ?>" 
                                min="0"
                                onkeypress="return event.charCode >= 48" 
                                oninput="if(this.value < 0) this.value = 0;"
                                onpaste="return false;">
                          </td>
                       

                           
                            <td class="wide-input">
                                
                                <input type="text" name="report[<?= $index ?>][jangkaan_pelaksanaan]" class="form-control form-control-sm" value="<?= $row['jangkaan_pelaksanaan'] ?>">
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


<script>
function semakTally(element) {
    // 1. Cari baris (tr) di mana input berada
    const row = element.closest('tr');
    
    // 2. Dapatkan nilai Unit Kosong (J)
    // Kita cari input yang mengandungi kata kunci 'unit_tidak_dihuni' dalam namanya
    const unitKosongInput = row.querySelector('input[name*="[unit_tidak_dihuni]"]');
    const unit_kosong = parseInt(unitKosongInput ? unitKosongInput.value : 0) || 0;
    
    // 3. Senarai semua field cadangan untuk dijumlahkan
    const fields = [
        'baik_diduduki', 'baik_guna_sama', 'baik_tukar_fungsi', 'baik_sewaan',
        'rosak_baik_pulih', 'rosak_guna_sama', 'rosak_tukar_fungsi', 'rosak_sewaan', 'rosak_roboh'
    ];
    
    let sum_cadangan = 0;
    fields.forEach(f => {
        const input = row.querySelector(`input[name*="[${f}]"]`);
        if (input) {
            sum_cadangan += parseInt(input.value) || 0;
        }
    });

    // 4. Cari kotak status (Pastikan ada class 'status-tally')
    const statusBox = row.querySelector('.status-tally');
    
    if (statusBox) {
        if (unit_kosong === sum_cadangan && unit_kosong > 0) {
            statusBox.value = 'TRUE';
            statusBox.style.color = 'green';
            statusBox.classList.remove('text-danger');
            statusBox.classList.add('text-success');
        } else {
            statusBox.value = 'FALSE';
            statusBox.style.color = 'red';
            statusBox.classList.remove('text-success');
            statusBox.classList.add('text-danger');
        }
    }
}
</script>