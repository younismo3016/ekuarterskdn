<!-- Main content -->


<section class="content">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Senarai CR</h1>
      <nav>

      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-10">

          <div class="card">
            
              <form 
      action="<?= site_url('rekod/' . ($act == 'add' ? 'add_rekod_proses' : 'edit_rekod_proses/' . $rekod['id'])) ?>"
      method="post"
      name="myForm"
      onsubmit="return validateForm()">
              <div class="card-body">
                <!-- Add margin-top to create spacing between the form and the card border -->
                <div class="row mt-4">
                  <!-- Name input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingName" value="<?= $act == 'edit' ? esc($rekod['no_fail']) : '' ?>"
                      name="no_fail" placeholder="Nombor Fail">
                      <label for="floatingName">Nombor Fail</label>
                    </div>
                  </div>

                  <!-- No HP input with form-floating -->
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <textarea
                        class="form-control"
                        placeholder="Perkara/Tajuk"
                        id="floatingperkara"
                        name="perkara"
                        style="height: 100px"><?= $act == 'edit' ? esc($rekod['perkara']) : '' ?></textarea>

                      <label for="floatingperkara">Perkara/Tajuk</label>
                    </div>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatinglokasi"
                       name="lokasi" placeholder="Lokasi" value="<?= $act == 'edit' ? esc($rekod['lokasi']) : '' ?>">
                      <label for="floatinglokasi">Lokasi</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingNoHp" 
                      name="bil_lampiran" placeholder="Bilangan Lampiran" value="<?= $act == 'edit' ? esc($rekod['bil_lampiran']) : '' ?>">
                      <label for="floatingNoHp">Bilangan Lampiran</label>
                    </div>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input
                          type="date"
                          class="form-control"
                          id="floating_tarikh_daripada"
                          name="tarikh_daripada"
                          placeholder="Tarikh Dari" value="<?= $act == 'edit' ? esc($rekod['tarikh_daripada']) : '' ?>">

                        <label for="floating_tarikh_daripada">Tarikh Daripada</label>
                      </div>
                    </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingNoHp" name="kotak" placeholder="Kotak">
                      <label for="floatingNoHp">Kotak</label>
                    </div>
                    
                    
                  </div>

                  <div class="row mt-4">
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input
                          type="date"
                          class="form-control"
                          id="floating_tarikh_daripada"
                          name="tarikh_kepada"
                          placeholder="Tarikh Dari" value="<?= $act == 'edit' ? esc($rekod['tarikh_kepada']) : '' ?>">

                        <label for="floating_tarikh_daripada">Tarikh Kepada</label>
                        
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input
                          type="text"
                          class="form-control"
                          id="floating_tarikh_daripada"
                          name="tarikh_kepada"
                          placeholder="Tarikh Dari"
                          disabled 
                          value="daripada <?= $act == 'edit' ? esc($rekod['tarikh_daripada']) : '' ?> /kepada <?= $act == 'edit' ? esc($rekod['tarikh_kepada']) : '' ?>">

                        <label for="floating_tarikh_daripada">Rujukan tarikh</label>
                        
                      </div>
                    </div>


                    
                  </div>
                  

                  </div>
                  





                  <!-- Button positioned at the bottom -->
                  <div class="row">
                    <div class="col-md-12 text-end">
                      
                      <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>Hantar
                      </button>
                      <input type="hidden" id="id" name="id" value="<?= $act == 'edit' ? esc($rekod['id']) : '' ?>">
                      <input type="hidden" id="id_user" name="id_user" value="<?= session()->get('id_user') ?>">
                    </div>
                  </div>

              

                
              </div>
          </div>
    </section>

    </form>

        <div class="row mt-3">
  <div class="col-md-12 text-end">
    <form action="<?= base_url('rekod/upload_rekod_proses') ?>" method="post" enctype="multipart/form-data">
      <input type="file" name="fail_excel" accept=".xlsx,.xls" required>
      <button type="submit" class="btn btn-success">
        <i class="bi bi-upload me-1"></i> Upload Excel
      </button>
    </form>
  </div>
</div>



    </div>
























  </main>