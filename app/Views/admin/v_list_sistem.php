<!-- Main content -->


<section class="content">


<main id="main" class="main">

<div class="pagetitle">
  <h1>Pengurusan Sistem</h1>
  <nav>
 
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">

    <div class="col-lg-10">
    
      <div class="card">
      <form name="carian" action="<?= site_url()?>/admin/list_user" method="post"> 
        <div class="card-body">
          <!-- Add margin-top to create spacing between the form and the card border -->
          <div class="row mt-4">
            <!-- Name input with form-floating -->
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" name="nama_sistem" placeholder="Nama">
                <label for="floatingName">Nama Sistem</label>
              </div>
            </div>

            <!-- No HP input with form-floating -->
            

           
          </div>

          <div class="row">
            <!-- kiri Peranan (Role) dropdown -->
            <div class="col-md-6">
              
              
            </div>
             <!-- kanan  -->
            <!-- <div class="col-md-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingNoHp" name="no_hp" placeholder="No HP">
                <label for="floatingNoHp">No HP</label>
              </div>
            </div> -->

          </div>
          <div class="row">
           
            </div>
            

          
          

          <!-- Button positioned at the bottom -->
          <div class="row">
            <div class="col-md-12 text-end">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-search me-1"></i>Cari
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

</form>


</div>



<section class="section">
  
  <div class="row">
    <div class="col-lg-12">
  
      <div class="card">
      </p>
        <div class="card-body">
        <div class="card-body position-relative">
    <button type="button" class="btn btn-success btn position-absolute top-0 end-0" 
            data-bs-toggle="modal" data-bs-target="#modal-tambah">
        Tambah Sistem <i class="bi bi-plus-circle"></i>
    </button>

    <!-- Other content inside the div -->

</div>
               
          <h4>Senarai Carian</h4>
                  
          <!-- Table with stripped rows -->
          <table id="example1" class="table table-bordered table-striped datatable">
            <thead>
            <tr>
              <th>Bil</th>
              <th>Nama Sistem</th>
              <th>Singkatan</th>
              <th>Seksyen</th>
              <th>Bahagian</th>
              <th width="15%">Aktiviti</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $bil = 1;
            if(isset($list_sistem) && !empty($list_sistem)) {
            foreach ($list_sistem as $row){
            ?>
            <tr>
              <td width="5%"><?= $bil++ ?>.</td>
              <td ><?= $row['nama_sistem'] ?></td>
              <td><?= $row['singkatan_sistem'] ?></td>
              <td><?= $row['id_seksyen'] ?></td>
              <td><?php echo get_bahagian($row['id_bahagian']); ?></td>
              <td>
              <div class="btn-group">
  <button type="button" class="btn btn-default btn-sm">
    <i class="fa fa-sticky-note-o"></i>
  </button>
  <!-- <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" onclick="window.location.href='<?= site_url()?>/admin/user/edit_user/<?= $row['id_nama_sistem']?>';"> -->
  <!-- <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" onclick="window.location.href='<?= site_url(route_to('user.edit', $row['id_nama_sistem'])) ?>';">
    <i class="bi bi-pencil-square"></i>
  </button> -->
  <button type="button" class="btn btn-info btn-m2" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $row['id_nama_sistem']?>">
  <i class="bi bi-pencil-square"></i>
  </button>
  <button type="button" class="btn btn-danger btn-m2" data-bs-toggle="modal" data-bs-target="#modal-delete<?= $row['id_nama_sistem']?>">
    <i class="bi bi-trash"></i>
  </button>
</div>

              </td>
            </tr>
            <?php } ?>
            <?php }else{ ?>
            <tr>
            <td colspan="6" align="center">Tiada Maklumat</td>                                        
            </tr>
            <?php } ?>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

<!-- Modal Dialog Scrollable -->

              <?php 
foreach ($list_sistem as $row){
?>
              <div class="modal fade" id="modal-edit<?= $row['id_nama_sistem']?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskinni Pengguna</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <?php echo form_open('Admin/edit_sistem/'.$row['id_nama_sistem']);?> 

    <div class="col-md-12">
        <!-- Name input with form-floating -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nama_sistem" name="nama_sistem" value="<?= $row['nama_sistem']  ?>" placeholder="Nama Sistem">
            <label for="floatingName">Nama Sistem</label>
        </div>
        
        <!-- Email input with form-floating -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="singkatan_sistem" name="singkatan_sistem" value="<?= $row['singkatan_sistem']  ?>" placeholder="Email">
            <label for="floatingEmail">Singkatan Nama Sistem</label>
        </div>
        
        <!-- No HP input with form-floating -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="id_seksyen" name="id_seksyen" value="<?= $row['id_seksyen']  ?>" placeholder="Seksyen">
            <label for="floatingNoHp">Seksyen</label>
        </div>

        


       

        <div class="form-control mb-3">
            <label for="floatingLevel">Seksyen</label>
        <select id="id_seksyen" name="id_seksyen" class="form-control" style="width: 100%;">
                                                
                    <?php foreach($list_seksyen as $seksyen): ?>
            <option value="<?= $seksyen['singkatan_seksyen'] ?>" 
                <?= ($row['id_seksyen'] == $seksyen['singkatan_seksyen']) ? 'selected' : '' ?>>
                <?= $seksyen['nama_seksyen'] ?>
            </option>
        <?php endforeach; ?>
                 
                 </select>
                 
        </div>

        <div class="form-control mb-3">
            <label for="floatingLevel">Bahagian</label>
        <select id="id_bahagian" name="id_bahagian" class="form-control" style="width: 100%;">
                                                
                    <?php foreach($list_bahagian as $bahagian): ?>
            <option value="<?= $bahagian['id_bahagian'] ?>" 
                <?= ($row['id_bahagian'] == $bahagian['id_bahagian']) ? 'selected' : '' ?>>
                <?= $bahagian['nama_bahagian'] ?>
            </option>
        <?php endforeach; ?>
                 
                 </select>
                 
        </div>
        

   
             
    </div>
    
    <!-- Modal footer with submit button -->
    

    
</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
              <?php echo form_close(); ?>
              <?php } ?>

              <div class="modal fade" id="modal-tambah" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Sistem</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
    <?php echo form_open('Admin/add_user'); ?>

    <div class="col-md-12">
        <!-- Name input with form-floating -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nama_sistem" name="nama_sistem" value="" placeholder="Nama Sistem">
            <label for="floatingName">Nama Sistem</label>
        </div>
        
        <!-- Email input with form-floating -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="singkatan_sistem" name="singkatan_sistem" value="" placeholder="Singkatan Sistem">
            <label for="floatingEmail">Singkatan Sistem</label>
        </div>
        
        <div class="form-control mb-3">
            <label for="floatingLevel">Seksyen</label>
        <select id="id_seksyen" name="id_seksyen" class="form-control" style="width: 100%;">
                                                
                    <?php foreach($list_seksyen as $seksyen): ?>
                      <option value="">--Sila Pilih--</option>
            <option value="<?= $seksyen['singkatan_seksyen'] ?>" 
                <?= ($row['id_seksyen'] == $seksyen['singkatan_seksyen']) ? 'selected' : '' ?>>
                <?= $seksyen['nama_seksyen'] ?>
            </option>
        <?php endforeach; ?>
                 
                 </select>
                 
        </div>

        <!-- Bahagian (Role) dropdown -->
        

         <!-- Seksyen (Role) dropdown -->
         

        <!-- Peranan (Role) dropdown -->
        <div class="form-floating mb-3">
        <select id="floatingLevel" name="level" class="form-select">
    <option value="">--Sila Pilih--</option>                             
    <option value="1">Admin</option>
    <option value="2">Urusetia</option>  
    <option value="3">Pengguna</option>  
</select>
            <label for="floatingLevel">Peranan</label>
        </div>

        
        
        <!-- Password input with form-floating -->
            
    </div>
    
    <!-- Modal footer with submit button -->
    

    
</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>



             


</main>




