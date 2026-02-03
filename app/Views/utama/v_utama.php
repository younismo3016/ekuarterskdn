<!-- Main content -->


<section class="content">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Utama </h1>
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
                    <h4 class="fw-bold text-dark">Dashboard: Status Kuarters</h4>
                    <p class="text-muted small">Status pemantauan kuarters merentasi semua Agensi di bawah KDN.</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm">
                        <span class="text-muted small fw-bold">JUMLAH KUARTERS</span>
                        <h3 class="fw-bold text-dark">124,582</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm" style="border-top-color: #198754;">
                        <span class="text-muted small fw-bold">JUMLAH UNIT DIHUNI</span>
                        <h3 class="fw-bold text-success">110,432</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm" style="border-top-color: #dc3545;">
                        <span class="text-muted small fw-bold">JUMLAH UNIT KOSONG</span>
                        <h3 class="fw-bold text-danger">14,150</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats p-3 shadow-sm" style="border-top-color: #0d6efd;">
                        <span class="text-muted small fw-bold">JUMLAH KOS SELENGGARA</span>
                        <h3 class="fw-bold text-dark">RM 45.8 Juta</h3>
                    </div>
                </div>
            </div>

            <div class="table-responsive shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0 text-primary">Status Penghantaran Laporan Agensi (Januari 2026)</h5>
                    <span class="badge bg-light text-dark border">Data dikemaskini: Hari Ini, 3:05 PM</span>
                </div>
                <table id="example1" class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>Bil</th>
            <th>Jabatan / Agensi</th>
            <th class="text-center">Unit Dihuni</th>
            <th class="text-center">Unit Kosong</th>
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

            if ($status == 'DITERIMA') {
                $badge_class = "bg-success";
                $icon = "bi-check-circle";
            } elseif ($status == 'DRAF') {
                $badge_class = "bg-warning text-dark";
                $icon = "bi-clock-history";
            } elseif ($status == 'BELUM MULA') {
                $badge_class = "bg-danger";
                $icon = "bi-exclamation-triangle";
            }

            
    ?>
            <tr>
                <td width="5%"><?= $bil++ ?>.</td>
                <td class="fw-bold"><?= $row['nama_jabatan'] ?></td>
                
                <td class="text-center"><?= number_format($row['unit_dihuni']) ?></td>
                
                <td class="text-center text-danger"><?= number_format($row['unit_kosong']) ?></td>
                
                <td class="text-center"><?= number_format($row['jumlah_unit']) ?></td>
                
                <td class="text-center">
                    <span class="badge <?= $badge_class ?> p-2">
                        <i class="bi <?= $icon ?> me-1"></i>
                        <?= $status ?>
                        
                    </span>
                </td>
                <td class="text-center">
                    
                   
    <?php if ($status == 'DITERIMA'): ?>
        <button class="btn btn-sm btn-outline-primary" title="Semak Laporan">
            <i class="bi bi-file-earmark-text"></i> Semak
        </button>
    <?php else: ?>
        <button type="button" class="btn btn-sm btn-warning" onclick="hantarPeringatan('<?= $row['nama_jabatan'] ?>')">
            <i class="bi bi-envelope-at"></i> Email Reminder
        </button>
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