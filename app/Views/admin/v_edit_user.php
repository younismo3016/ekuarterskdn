


<main id="main" class="main">


<div class="pagetitle">
  <h1>Form Elements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Elements</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
   
  <?php 
foreach ($pengguna as $row){
?>
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Floating labels Form</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="nama_penuh" name="nama_penuh" value='<?= $row['nama_penuh']  ?>' placeholder="Your Name">
                    <label for="floatingName">Nama</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" value='<?= $row['email']  ?>' placeholder="Your Email">
                    <label for="floatingEmail">Emel</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value='<?= $row['no_hp']  ?>' placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Address</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-12">
                  <div class="form-floating mb-3">
                        <select id="floatingLevel" name="level" class="form-select">
                    <option value="">--Sila Pilih--</option>                             
                    <option value="1">Admin</option>
                    <option value="2">Urusetia</option>  
                    <option value="3">Pengguna</option>  
                      </select>
                            <label for="floatingLevel">Peranan</label>
                        </div>
                  </div>
                </div>
               
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingZip" placeholder="Zip">
                    <label for="floatingZip">Zip</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
  </div>
</section>
<?php } ?>
</main><!-- End #main -->

<link rel="stylesheet" href="<?= site_url() ?>/template/plugins/bs-stepper/css/bs-stepper.min.css">

<!-- <h1>Ini Halaman Home</h1>
<h1><?php if (session()->get('level') == 1) {
            echo 'Admin';
            } else if (session()->get('level') == 2) {
            echo 'User';
            } else {
            echo 'Pelangan';
            } 
    ?>
</h1> -->
<?php 
foreach ($pengguna as $row){
?>    
<div class="box box-success">
<div class="nav-tabs-custom">

<form action="<?= site_url() ?>/Admin/edit_user_proses/<?= $row['id_user']  ?>" method="post" accept-charset="utf-8" id="myForm" name="myForm">

<div class="row">
          
                      
                    


            <!-- /.tab-content -->
            <?php echo form_close(); ?>    

          </div>
                </form>
            <!-- /.box-body -->
        
          <!-- /.box -->
          
              
          <?php } ?> 
          
          

          


         



