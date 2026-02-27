<!-- Main content -->


<section class="content">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard: Status Kuarters </h1>
      <nav>

      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        

    </section>

    </form>


    </div>



    <section class="section">

    
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    
                    <p class="text-muted small">Status pemantauan kuarters merentasi semua Agensi di bawah KDN.</p>
                </div>
            </div>
 <?php
    foreach ($list_dashboard as $row1) {
    ?>
            <div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-stats p-3 shadow-sm">
            <span class="text-muted small fw-bold">JUMLAH KUARTERS</span>
            <h3 class="fw-bold text-dark">
                
                <?= number_format($row1['total_kuarters'] ?? 0); ?>
            </h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stats p-3 shadow-sm" style="border-top-color: #198754;">
            <span class="text-muted small fw-bold">JUMLAH UNIT DIHUNI</span>
            <h3 class="fw-bold text-success">
                <?= number_format($row1['total_huni'] ?? 0); ?>
            </h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stats p-3 shadow-sm" style="border-top-color: #dc3545;">
            <span class="text-muted small fw-bold">UNIT KOSONG (BAIK)</span>
            <h3 class="fw-bold text-danger">
                <?= number_format($row1['total_kosong_baik'] ?? 0); ?>
            </h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-stats p-3 shadow-sm" style="border-top-color: #0d6efd;">
            <span class="text-muted small fw-bold">UNIT KOSONG (ROSAK)</span>
            <h3 class="fw-bold text-danger">
                <?= number_format($row1['total_kosong_rosak'] ?? 0); ?>
            </h3>
        </div>
    </div>
</div>
<?php } ?>
            <div class="table-responsive shadow-sm">
                <?php
    $bulan_angka = date('n'); // Hasil: 1 hingga 12 (Contoh: 2)
    $tahun_angka = date('Y'); // Hasil: 2026
    // --- 1. Tetapan Bulan & Tahun Semasa (Bahasa Melayu) ---
    $bulan_melayu = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
        5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember'
    ];
    $paparan_bulan_tahun = $bulan_melayu[date('n')] . ' ' . date('Y');

    // --- 2. Logik Tarikh Kemaskini Data ---
    $db_date = $tarikh_terkini ?? date('Y-m-d H:i:s'); // Guna current time jika DB null
    $timestamp = strtotime($db_date);
    
    // Semak jika tarikh sama dengan hari ini
    $is_today = (date('Ymd') == date('Ymd', $timestamp));
    
    // Format paparan: "Hari Ini, 3:05 PM" atau "04/02/2026, 3:05 PM"
    $label_tarikh = $is_today ? "Hari Ini" : date('d/m/Y', $timestamp);
    $label_masa   = date('g:i A', $timestamp);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0 text-primary">Status Penghantaran Laporan Agensi (<?= $paparan_bulan_tahun; ?>)</h5>
    
    <span class="badge bg-light text-dark border">
        Data dikemaskini: <?= $label_tarikh . ', ' . $label_masa; ?>
    </span>
</div>
                <table id="example1" class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>Bil</th>
            <th>Jabatan / Agensi</th>
            <th class="text-center">Unit Dihuni</th>
            <th class="text-center">Unit Kosong (Baik)</th>
            <th class="text-center">Unit Kosong (Rosak)</th>
            <th class="text-center">Jumlah Unit</th>
            <th class="text-center">Status </th>
            <th class="text-center">Tindakan</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $bil = 1;
    if (isset($list_agensi) && !empty($list_agensi)) {
        foreach ($list_agensi as $row) {
            // Padankan dengan 'status_laporan' dari hasil query anda
           $status = $row['status_hantar']; 
            
            $badge_class = "bg-secondary";
            $icon = "bi-question-circle";

            if ($status == 'Hantar') {
                $badge_class = "bg-success";
                $icon = "bi-check-circle";
            } elseif ($status == 'Draf') {
                $badge_class = "bg-warning text-dark";
                $icon = "bi-clock-history";
            } elseif ($status == 'Belum Mula') {
                $badge_class = "bg-danger";
                $icon = "bi-exclamation-triangle";
            }

            
    ?>
            <tr>
                <td width="5%"><?= $bil++ ?>.</td>
                <td class="left"><?= $row['nama_jabatan'] ?></td>
                
                <td class="text-center"><?= number_format($row['unit_dihuni']) ?></td>
                
                <td class="text-center text-danger"><?= number_format($row['unit_kosong_baik']) ?></td>
                
                <td class="text-center text-danger"><?= number_format($row['unit_kosong_rosak']) ?></td>
                
                <td class="text-center"><?= number_format($row['jumlah_unit']) ?></td>
                
                <td class="text-center">
                   
        <span class="badge <?= $badge_class ?> p-2">
            <i class="bi <?= $icon ?> me-1"></i>
            <?= $status ?> 
            </span>

    
                </td>
                <td class="text-center">
                    
                   
    <?php if ($status == 'Hantar'): ?>
       
        <a href="<?= site_url('utama/update_status/' . $row['id_agensi_induk'] . '/' . $bulan_angka . '/' . $tahun_angka) ?>" 
   class="btn-reset" 
   style="text-decoration: none;">
    <button type="button" class="btn btn-sm btn-outline-warning" title="Reset Status">
        <i class="bi bi-arrow-clockwise"></i>
    </button>
</a>
        
    <?php else: ?>
        <!-- <button type="button" class="btn btn-sm btn-warning" title="Email Reminder" onclick="hantarPeringatan('<?= $row['nama_jabatan'] ?>')">
            <i class="bi bi-envelope-at"></i> 
        </button> -->
        
    <?php endif; ?>

   




                </td>
            </tr>
    <?php 
        } 
    } else { 
    ?>
        <tr>
            <td colspan="7" align="center">Tiada Maklumat Dipaparkan</td>
        </tr>
    <?php } ?>
</tbody>
</table>
            </div>
            
        
    </section>














    <!-- buka modal 2 -->

    


    <!-- tutup modal -->





  </main>