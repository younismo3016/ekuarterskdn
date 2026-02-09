<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>


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


<style>
/* Mengecilkan font keseluruhan TomSelect */
.ts-wrapper.custom-sm .ts-control {
    font-size: 11px !important;
    min-height: 31px !important; /* Saiz input Bootstrap sm */
    padding: 2px 8px !important;
    border-radius: 4px !important;
}

/* Mencantikkan 'Pills' (Item yang dipilih) */
.ts-wrapper.custom-sm .ts-control .item {
    font-size: 10px !important;
    background: #e7f3ff !important; /* Warna biru lembut */
    color: #0d6efd !important;      /* Warna teks biru */
    border: 1px solid #cfe2ff !important;
    border-radius: 3px !important;
    padding: 0 5px !important;
    margin: 1px 3px 1px 0 !important;
}

/* Menyelaraskan dropdown menu */
.ts-dropdown.custom-sm {
    font-size: 11px !important;
}

/* Efek fokus yang lebih kemas */
.ts-wrapper.custom-sm.focus .ts-control {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15) !important;
    border-color: #86b7fe !important;
}

.header-kecil th {
    font-size: 14px;
    padding: 6px 4px; /* rapatkan sikit */
    white-space: nowrap; /* elak teks turun baris */
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
<form method="get" class="row mb-3">
    <input type="hidden" name="bulan" value="<?= $bulan ?>">
    <input type="hidden" name="tahun" value="<?= $tahun ?>">
  
</form>
        <form action="<?= base_url('index.php/agensi/simpan_kemaskini') ?>" method="POST" id="formSimpan">
            <?= csrf_field() ?>
            <input type="hidden" name="bulan" value="<?= $bulan ?>">
            <input type="hidden" name="tahun" value="<?= $tahun ?>">

            <div class="pagetitle">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
    <h4 class="fw-bold">Kemaskini Laporan Bulanan: <?= $nama_bulan ?> <?= $tahun ?></h4>
    <p class="text-muted small mb-0">
        <i class="bi bi-info-circle me-1"></i> Scroll ke kanan untuk mengisi maklumat lanjut.
    </p>
    
  
</div>

                    
                   
                         <div class="mt-3 text-end pb-5">
  
    
    <button type="submit" class="btn btn-primary shadow-sm px-4 py-2">
    <i class="bi bi-floppy-fill me-2"></i> Simpan Draf
</button>

    <button type="button" onclick="confirmHantarKDN()" class="btn btn-success shadow-sm px-4">
                        <i class="bi bi-send-check-fill me-1"></i> Hantar Laporan
                    </button>
</div>
                        
                   
                </div>
            </div>

<div class="row mb-3 mt-4 align-items-center">
    <div class="col-md-6">
        <div class="input-group shadow-sm">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" 
                   form="formCarian" 
                   name="q" 
                   id="inputCarian"
                   class="form-control" 
                   placeholder="Cari kod atau nama kuarters..." 
                   value="<?= esc($keyword) ?>">
            
            <button type="submit" form="formCarian" class="btn btn-primary">
                <i class="bi bi-search me-1"></i> Cari
            </button>

            <a href="<?= base_url('index.php/agensi/agensi_statistik_kemaskini/' . $bulan . '/' . $tahun) ?>" 
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </a>
        </div>
    </div>

    <div class="col-md-6 text-end">
        <div class="d-flex flex-column text-muted" style="line-height: 1.4;">
            <span style="font-size: 0.85rem;">
                <i class="bi bi-clock-history"></i> Kemaskini Terakhir: 
                <strong><?= ($tarikh_terakhir) ? date('d/m/Y h:i A', strtotime($tarikh_terakhir)) : 'Tiada Data'; ?></strong>
            </span>
            <span style="font-size: 0.80rem;">
                Oleh: <strong><?= !empty($oleh) ? ucwords(strtolower($oleh)) : 'Tiada Data'; ?></strong>
            </span>
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

   



            <div class="table-container shadow-sm border rounded">
                <table class="table table-bordered align-middle small mb-0" id="mainTable">
              <thead class="text-center text-white">
              
               <tr class="table-light text-dark     ">

                    <th style="background-color: #e7cd28; color: #000;">KOD, NAMA KUARTERS & KELAS</th>
                    <th style="background-color: #e9c5dd; color: #000;">F.JUMLAH PERMOHONAN KUARTERS</th>
                    <th style="background-color: #5d99f2;">G. JUMLAH UNIT DIHUNI</th>
                    <th style="background-color: #5d99f2;">H. DIHUNI (KEADAAN BAIK)</th>
                    <th style="background-color: #5d99f2;">I. DIHUNI (ADA KEROSAKAN)</th>
                    <th style="background-color: #5d99f2;">Jumlah Huni (Check)</th>
                    <th style="background-color: #5d99f2;">Jumlah Huni (Validity)</th>

                    <th style="background-color: #0dcaf0; color: #000;">J. JUMLAH UNIT TIDAK DIHUNI</th>
                    <th style="background-color: #0dcaf0; color: #000;">Jumlah Tidak Huni (Check)</th>
                    <th style="background-color: #0dcaf0; color: #000;">Jumlah Tidak Huni (Validity)</th>
                    <th style="background-color: #51eda5; color: #000;">K. BAIK - BOLEH DIDUDUKI (UNIT)</th>
                    <th style="background-color: #51eda5; color: #000;">L. BAIK - CADANGAN GUNA SAMA (UNIT)</th>
                    <th style="background-color: #51eda5; color: #000;">KETERANGAN BAIK-GUNA SAMA</th>
                    <th style="background-color: #51eda5; color: #000;">M. BAIK - CADANGAN TUKAR FUNGSI (UNIT)</th>
                    <th style="background-color: #51eda5; color: #000;">KETERANGAN BAIK-TUKAR FUNGSI</th>
                    <th style="background-color: #51eda5; color: #000;">N. BAIK - CADANGAN SEWAAN/PAJAKAN/ SEWA-BELI (UNIT)</th>
                    <th style="background-color: #51eda5; color: #000;">KETERANGAN BAIK-SEWAAN/PAJAKAN</th>
                    
                    <th style="background-color: #f3476c; color: #000;">O. ROSAK - PERLU BAIK PULIH (UNIT)</th>
                    <th style="background-color: #f3476c; color: #000;">KETERANGAN ROSAK-KERJA BAIK PULIH </th>
                    <th style="background-color: #f3476c; color: #000;">P. ROSAK - CADANGAN GUNA SAMA (UNIT)</th>
                    <th style="background-color: #f3476c; color: #000;">KETERANGAN ROSAK-GUNA SAMA</th>
                    
                    <th style="background-color: #f3476c; color: #000;">Q. ROSAK - CADANGAN TUKAR FUNGSI (UNIT)</th>
                    <th style="background-color: #f3476c; color: #000;">KETERANGAN ROSAK-TUKAR FUNGSI</th>

                    <th style="background-color: #f3476c; color: #000;">R. ROSAK - CADANGAN SEWAAN/PAJAKAN/ SEWA-BELI (UNIT)</th>
                    <th style="background-color: #f3476c; color: #000;">KETERANGAN ROSAK-SEWAAN/PAJAKAN</th>

                    <th style="background-color: #f3476c; color: #000;">S. ROSAK - CADANGAN ROBOH (UNIT)</th>
                    <th style="background-color: #f3476c; color: #000;">KETERANGAN ROSAK-ROBOH</th>

                    <th style="background-color: #c24aee;">T. JUMLAH UNIT KUARTERS</th>
                    <th style="background-color: #c24aee;">Jumlah Kuarters (Check)</th>
                    <th style="background-color: #c24aee;">Jumlah Kuarters (Validity)</th>

                    <th style="background-color: #ffc107; color: #000;">U. ISU PENGOPERASIAN</th>
                    <th style="background-color: #ffc107; color: #000;">V. KETERANGAN ISU</th>
                    <th style="background-color: #ffc107; color: #000;">W. STATUS TINDAKAN TERKINI DAN CADANGAN PENYELESAIAN</th>
                    <th style="background-color: #ffc107; color: #000;">X. SENARAI KERJA PENYELENGGARAAN/ PEMBAIKAN</th>
                    <th style="background-color: #ffc107; color: #000;">Y. KOS PENYELENGGARAAN KUARTERS YANG DIPERLUKAN (RM)</th>
                    <th style="background-color: #ffc107; color: #000;">Z. JANGKAAN TAHUN PELAKSANAAN </th>
                    <th style="background-color: #d7c690; color: #000;">CATATAN</th>
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
                                class="form-control form-control-sm custom-textarea-sm" 
                                rows="1" 
                                placeholder="Catatan..."
                                style="min-width: 150px; overflow:hidden; transition: height 0.2s;"
                                onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                onmouseleave="this.style.height = '31px';" 
                            ><?= $row['ket_baik_guna_sama'] ?></textarea>
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
                                    placeholder="Catatan..."
                                    style="min-width: 150px; overflow:hidden; transition: height 0.1s ease;"
                                    onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                    onmouseleave="this.style.height = '31px';"
                                ><?= $row['ket_baik_tukar_fungsi'] ?></textarea>
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
                                placeholder="Catatan..."
                                style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                onblur="this.style.height = '31px';"
                            ><?= $row['ket_baik_sewaan'] ?></textarea>
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
                                placeholder="Catatan..."
                                style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                onblur="this.style.height = '31px';"
                            ><?= $row['ket_rosak_baik_pulih'] ?></textarea>
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
                                placeholder="Catatan..."
                                style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                onblur="this.style.height = '31px';"
                            ><?= $row['ket_rosak_guna_sama'] ?></textarea>
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
                                    placeholder="Catatan..."
                                    style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                    onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                    onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                    onblur="this.style.height = '31px';"
                                ><?= $row['ket_rosak_tukar_fungsi'] ?></textarea>
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
                                    placeholder="Catatan..."
                                    style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                    onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                    onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                    onblur="this.style.height = '31px';"
                                ><?= $row['ket_rosak_sewaan'] ?></textarea>
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
                                    placeholder="Catatan..."
                                    style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                    onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                    onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                    onblur="this.style.height = '31px';"
                                ><?= $row['ket_rosak_roboh'] ?></textarea>
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
                    <div class="tom-select-wrapper">
                        <select name="report[<?= $index ?>][id_kategori_isu][]" 
                                class="tom-select custom-sm" 
                                multiple 
                                placeholder="Pilih isu...">
                            <?php 
                            $selected_values = explode(',', $row['id_kategori_isu'] ?? ''); 
                            ?>
                            <?php foreach ($kategori_isu as $isu): ?>
                                <option value="<?= $isu['id_kategori_isu'] ?>" 
                                    <?= (in_array($isu['id_kategori_isu'], $selected_values)) ? 'selected' : '' ?>>
                                    <?= $isu['keterangan_kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
</td>

                            <td>
                                <textarea 
                                    name="report[<?= $index ?>][keterangan_isu]" 
                                    class="form-control form-control-sm wide-input" 
                                    rows="1" 
                                    placeholder="Catatan..."
                                    style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                    onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                    onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                    onblur="this.style.height = '31px';"
                                ><?= $row['keterangan_isu'] ?></textarea>
                            </td>
                           
                         <td class="wide-input">
                            <textarea 
                                name="report[<?= $index ?>][status_tindakan]" 
                                class="form-control form-control-sm mb-1" 
                                rows="1" 
                                placeholder="Status..."
                                style="min-width: 180px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                                onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                                onblur="this.style.height = '31px';"
                            ><?= $row['status_tindakan'] ?></textarea>
                        </td>
                          <td>
                        <textarea 
                            name="report[<?= $index ?>][senarai_kerja]" 
                            class="form-control form-control-sm wide-input" 
                            rows="1" 
                            placeholder="Senarai kerja..."
                            style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
                            onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                            onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
                            onblur="this.style.height = '31px';"
                        ><?= $row['senarai_kerja'] ?></textarea>
                    </td>
                            
                               <td>
    <input type="number" 
        name="report[<?= $index ?>][kos_rm]" 
        class="form-control form-control-sm" 
        value="<?= $row['kos_rm'] ?>" 
        min="0"
        step="0.01" 
        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46" 
        oninput="if(this.value < 0) this.value = 0;"
        onpaste="return true;">
</td>
                       

                        <td class="wide-input">
    <?php 
    // 1. Ambil data asal dari DB
    $val_db = isset($row['jangkaan_pelaksanaan']) ? trim((string)$row['jangkaan_pelaksanaan']) : '';
    
    // 2. Tentukan Tahun Rujukan (Tahun semasa)
    $tahun_sekarang = (int)date("Y");
    
    // 3. Tentukan julat (5 tahun ke belakang, 10 tahun ke depan)
    $tahun_mula = $tahun_sekarang - 5;
    $tahun_akhir = $tahun_sekarang + 10;
    ?>

    <select name="report[<?= $index ?>][jangkaan_pelaksanaan]" class="form-control form-control-sm">
        <option value="">-- Pilih Tahun --</option>

        <?php 
        for ($y = $tahun_mula; $y <= $tahun_akhir; $y++) {
            // Semak jika tahun ini adalah yang tersimpan dalam DB
            $selected = ($val_db == (string)$y) ? 'selected' : '';
            echo "<option value='$y' $selected>$y</option>";
        } 
        ?>
    </select>
</td>
                            <td>
    <textarea 
        name="report[<?= $index ?>][catatan]" 
        class="form-control form-control-sm wide-input" 
        rows="1" 
        placeholder="Catatan..."
        style="min-width: 150px; overflow:hidden; transition: height 0.1s ease; resize: none;"
        onmouseenter="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
        onmouseleave="if(document.activeElement !== this) { this.style.height = '31px'; }"
        onblur="this.style.height = '31px';"
    ><?= $row['catatan'] ?></textarea>
</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
       
        </form>

        <form method="get" id="formCarian" action="">
            <input type="hidden" name="bulan" value="<?= $bulan ?>">
            <input type="hidden" name="tahun" value="<?= $tahun ?>">
        </form>

<div class="d-flex justify-content-between align-items-center mt-3 mb-5">
    <div class="text-muted small">
        <?php 
            if ($totalRows > 0) {
                $start = ($page - 1) * 10 + 1;
                $end = min($page * 10, $totalRows);
                echo "Paparan $start hingga $end daripada $totalRows rekod";
            } else {
                echo "Paparan 0 hingga 0 daripada 0 rekod";
            }
        ?>
    </div>

    <?php if ($totalPages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm mb-0">
            
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= base_url('index.php/agensi/agensi_statistik_kemaskini/'.$bulan.'/'.$tahun.'?page='.($page-1).'&q='.$keyword) ?>">
                    Sebelum
                </a>
            </li>

            <?php 
            // Kita hadkan paparan nombor jika terlalu banyak (cth: tunjuk 2 sebelum dan 2 selepas page semasa)
            $start_loop = max(1, $page - 2);
            $end_loop = min($totalPages, $page + 2);
            
            for ($i = $start_loop; $i <= $end_loop; $i++): ?>
                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= base_url('index.php/agensi/agensi_statistik_kemaskini/'.$bulan.'/'.$tahun.'?page='.$i.'&q='.$keyword) ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= base_url('index.php/agensi/agensi_statistik_kemaskini/'.$bulan.'/'.$tahun.'?page='.($page+1).'&q='.$keyword) ?>">
                    Selepas
                </a>
            </li>

        </ul>
    </nav>
    <?php endif; ?>
</div>

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
</script>



<script>

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


<script>
document.querySelectorAll('.tom-select.custom-sm').forEach((el) => {
    new TomSelect(el, {
        plugins: {
            remove_button: {
                title: 'Padam isu ini',
            }
        },
        maxItems: 5, // Hadkan jika perlu supaya layout tidak pecah
        render: {
            option: function(data, escape) {
                return `<div><span class="small">${escape(data.text)}</span></div>`;
            },
            item: function(data, escape) {
                return `<div>${escape(data.text)}</div>`;
            }
        }
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const rowsPerPage = 10;
    const maxPageButtons = 5;

    const table = document.getElementById('mainTable');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const pagination = document.getElementById('pagination');
    const paginationInfo = document.getElementById('paginationInfo');
    const searchInput = document.getElementById('searchInput');

    const url = new URL(window.location.href);
    let keyword = url.searchParams.get('q') || '';
    let currentPage = parseInt(url.searchParams.get('page')) || 1;

    searchInput.value = keyword;

    let filteredRows = [];

    function applySearch() {
        filteredRows = rows.filter(row =>
            row.querySelector('.search-area')
               .innerText.toLowerCase()
               .includes(keyword.toLowerCase())
        );
    }

    function updateURL() {
        url.searchParams.set('q', keyword);
        url.searchParams.set('page', currentPage);
        window.history.replaceState({}, '', url);
    }

    function showPage(page) {
        currentPage = page;
        updateURL();

        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach(r => r.style.display = 'none');
        filteredRows.slice(start, end).forEach(r => r.style.display = '');

        renderPagination();
        updateInfo();
    }

    function renderPagination() {
        pagination.innerHTML = '';
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        if (totalPages <= 1) return;

        addBtn('First', currentPage > 1, () => showPage(1));
        addBtn('Prev', currentPage > 1, () => showPage(currentPage - 1));

        let start = Math.max(1, currentPage - Math.floor(maxPageButtons / 2));
        let end = start + maxPageButtons - 1;

        if (end > totalPages) {
            end = totalPages;
            start = Math.max(1, end - maxPageButtons + 1);
        }

        for (let i = start; i <= end; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a href="#" class="page-link">${i}</a>`;
            li.onclick = e => {
                e.preventDefault();
                showPage(i);
            };
            pagination.appendChild(li);
        }

        addBtn('Next', currentPage < totalPages, () => showPage(currentPage + 1));
        addBtn('Last', currentPage < totalPages, () => showPage(totalPages));
    }

    function addBtn(label, enabled, action) {
        const li = document.createElement('li');
        li.className = `page-item ${!enabled ? 'disabled' : ''}`;
        li.innerHTML = `<a href="#" class="page-link">${label}</a>`;
        li.onclick = e => {
            e.preventDefault();
            if (enabled) action();
        };
        pagination.appendChild(li);
    }

    function updateInfo() {
        const total = filteredRows.length;
        const start = total ? (currentPage - 1) * rowsPerPage + 1 : 0;
        const end = Math.min(currentPage * rowsPerPage, total);
        paginationInfo.innerText =
            `Papar ${start} – ${end} daripada ${total} rekod`;
    }

    // 🔍 SEARCH (UPDATE URL)
    searchInput.addEventListener('input', function () {
        keyword = this.value;
        currentPage = 1;
        applySearch();
        showPage(1);
    });

    // INIT
    applySearch();

    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    if (currentPage > totalPages) currentPage = 1;

    showPage(currentPage);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.adaperubahan = false;
    const formSimpan = document.getElementById('formSimpan');

    // 1. Pantau perubahan data (Input/Select)
    formSimpan.addEventListener('change', function(e) {
        if (e.target.getAttribute('form') === 'formCarian') return;
        window.adaperubahan = true;
    });

    formSimpan.addEventListener('input', function(e) {
        if (e.target.getAttribute('form') === 'formCarian') return;
        window.adaperubahan = true;
    });

    // 2. Logik Navigasi (Hanya untuk Pagination, Reset, dan Cari)
    // Kita gunakan class spesifik .page-link (pagination) dan butang Cari
    const elemenNavigasi = document.querySelectorAll('.page-link, .btn-outline-secondary, button[form="formCarian"]');

    elemenNavigasi.forEach(elemen => {
        elemen.addEventListener('click', function(e) {
            
            // Pengecualian: Jika elemen ini berada di dalam Tom Select, abaikan!
            if (this.closest('.ts-wrapper') || this.closest('.ts-dropdown')) {
                return; 
            }

            if (window.adaperubahan) {
                e.preventDefault();
                const targetUrl = this.getAttribute('href');

                Swal.fire({
                    title: 'Data Belum Disimpan!',
                    text: "Terdapat perubahan pada laporan. Adakah anda ingin simpan dahulu sebelum berpindah?",
                    icon: 'warning',
                    showCancelButton: true,
                    showDenyButton: true,
                    confirmButtonColor: '#0d6efd',
                    denyButtonColor: '#6c757d',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: '<i class="bi bi-floppy-fill"></i> Simpan & Teruskan',
                    denyButtonText: 'Teruskan Tanpa Simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.adaperubahan = false;
                        formSimpan.submit(); 
                    } 
                    else if (result.isDenied) {
                        window.adaperubahan = false;
                        if (this.tagName === 'A' && targetUrl) {
                            window.location.href = targetUrl;
                        } else {
                            document.getElementById('formCarian').submit();
                        }
                    }
                });
            }
        });
    });

    formSimpan.addEventListener('submit', function() {
        window.adaperubahan = false;
    });
});

// 3. Fungsi Hantar Ke KDN (Pastikan ia tidak trigger amaran perubahan)
function confirmHantarKDN() {
    Swal.fire({
        title: 'Hantar ke KDN?',
        text: "Pastikan semua maklumat statistik adalah tepat. Selepas dihantar, rekod tidak boleh diubah.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hantar Sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Matikan amaran supaya proses redirect berjalan lancar
            window.adaperubahan = false; 
            window.location.href = "<?= base_url('index.php/agensi/hantar_ke_kdn/'.$bulan.'/'.$tahun) ?>";
        }
    })
}
</script>