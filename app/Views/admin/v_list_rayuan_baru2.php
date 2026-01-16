<!-- Main content -->
<section class="content">
<form name="carian" action="<?= site_url()?>/admin/list_rayuan_baru" method="post">
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Carian Surat</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            
              <!-- /.form-group -->
              
              <!-- /.form-group -->



          <!-- /.form-group -->
         
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                  <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" placeholder="Nama Pemohon">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">No Rujukan JIM</label>
                  <input type="text" class="form-control" name ="no_fail_jim" id="no_fail_jim" placeholder="No Fail Jim">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <button type="submit" class="btn btn-success btn-sm" >Cari</button> 
        
        </div>
      </div>
</form>


      


  <div class="row">


  
    <div class="col-xs-12">
   
      <br><br>
          <?php 
              if (session()->getFlashdata('pesan')){
                  echo '<div class="alert alert-success" role="alert">';
                  echo session()->getFlashdata('pesan');
                  echo '</div>';
              }
          ?>
          <?php 
              if (session()->getFlashdata('hapus')){
                  echo '<div class="alert alert-danger" role="alert">';
                  echo session()->getFlashdata('hapus');
                  echo '</div>';
              }
          ?>   
      <div class="box">
        <div class="box-header">

        <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-tambah">Tambah</button> -->
            </P>
          <h3 class="box-title">Senarai Surat</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Bil</th>
              <th>Nama Pemohon Rayuan</th>
              <th width="10%">No fail jim</th>
              <th width="28%">Status</th>
              <th width="25%">Tindakan</th>
            </tr>
            </thead>
            <tbody>













            <?php 
            $bil = 1;
            if(isset($surat_masuk) && !empty($surat_masuk)) {
            foreach ($surat_masuk as $row){
            ?>
            <tr>
              <td width="5%"><?= $bil++ ?>.</td>
              <td width="32%"><?= $row['nama_pemohon'] ?>
              </td>
              <td><?= (!empty($row['no_fail_jim'])) ? $row['no_fail_jim'] : "-" ?>  </td>
              <td>
              <?= (!empty($row['id_surat_masuk'])) ? $row['id_surat_masuk'] : "-" ?>  
              </td>
              <td>
                <div class="btn-group">
                  
                 
                 
                  <?php if($row['id_add']=='2'){ ?>

                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" 
                          data-target="#modal-kemaskini<?= $row['id_surat_masuk']?>">
                          <i class="fa fa-edit"></i></button>
                                          
                         
                                          
                                          
                  <?php }else{ ?>

                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" 
                          data-target="#modal-add<?= $row['id_surat_masuk']?>">
                          <i class="fa fa-plus-square"></i></button>
                         
                                    
                                         
                  <?php }  ?>

                                   
                 
                  <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?= $row['id_surat_masuk']?>"><i class="fa fa-trash"></i></button> -->
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
        </div>
		
		
 


<!-- ============================= buka modal kemaskini===================================== -->
<?php 
foreach ($surat_masuk as $row){
?>        






  
                      
     
  <?php if($row['id_add']=='2'){ ?>

    <div class="modal fade" id="modal-kemaskini<?= $row['id_surat_masuk']?>">
                      
     
                      
                      
<?php }else{ ?>

  <div class="modal fade" id="modal-add<?= $row['id_surat_masuk']?>">
     
                
                     
<?php }  ?>                    
                      

  <div class="modal-dialog ">
    <div class="modal-content">
      
    <?php echo form_open('Admin/edit_rayuan/'.$row['id_rayuan']);?>	
		
		<div class="modal-header">
    <table class="table table-bordered">
                
                <tr>
                  
                <td>Nama Penaja</td>
                  <td>
                  <?= (!empty($row['nama_pemohon'])) ? $row['nama_pemohon'] : "-" ?>
                 </td>
                 <td>JIm Cantum </td>
                  <td>
                  
                  <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              
              <input type="date" data-date-format="yyyy-mm-dd" class="form-control pull-right" id="jim_cantum" name="jim_cantum">
            </div>
                  </td>
                  
                </tr>
                <tr>
                 
                  <td>Kategori Pemohon</td>
                  <td>
                  <input type="text" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="No Kp Penaja tanpa sengkang">
                  </td>
                  <td>PAS</td>
                  <td>
                  <input type="text" class="form-control" name ="negara_asal" id="negara_asal" placeholder="Negara Asal">
                 </td>
                  
                </tr>
                <tr>
                  
                  <td>No Rujukan Fail</td>
                  <td>
                  <input type="text" class="form-control" name ="warganegara" id="warganegara" placeholder="Warganegara">
                  </td>
                  
                  
                </tr>
                <tr>
                 
                  
                 
                  
                </tr>
                
              </table>
         <!--  <span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Sistem Mata</h4>
        
      </div>
      

      <div class="modal-body">
      
      
          
        <div class="form-group">

        <!-- /.box-header -->
       
        <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
          
                    </script>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseA<?= $row['id_surat_masuk']?>">
                      Umurss
                      </a>
                    </h4>
                  </div>
                  <div id="collapseA<?= $row['id_surat_masuk']?>" class="panel-collapse collapse in">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  
                      
                  <input type=date id = DOB> 

                  <span id = "message" style="color:red"> </span> 

                      <!-- Choose a date and enter in input field -->
                      <button type="reset" onclick = "ageCalculator()"> Calculate age </button>     

                  <h5 style="color:32A80F" id="result" ></h5>
                   
                </td>
                
                  <td>
                   
            
                      
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Suami Warganegara bawah 35 tahun</option>
                  <option value="">Isteri Warganegara bawah 35 tahun</option>
                  <option value="">Suami Warganegara atas atau samadengan 35 tahun</option>
                  <option value="">Isteri Warganegara atas atau samadengan 35 tahun</option>
                  <option disabled="disabled">Anak Kandung/Tiri/Angkat warganera/PR/Lain-lain</option>
                  <option value="">Besar dari 18 tahun</option>
                  <option value="">Kecil dari 18 tahun</option>
                 
                </select>
              </div> 
                  
                
                
                </td>
                  <td>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse13<?= $row['id_surat_masuk']?>">
                        Kelayakan Akademik
                      </a>
                    </h4>
                  </div>
                  <div id="collapse13<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                
                <tr>
                  
                  <td> 
                  <div class="form-group">
                
                <select id="kel_akademik" name="kel_akademik"class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Phd bidang kritikal</option>
                  <option value="" >Phd bidang tidak kritikal</option>
                  <option value="">Sarjana/Profesional bidang kritikal</option>
                  <option value="">Sarjana/Profesional bidang tidak kritikal</option>
                  <option value="" >Sarjana Muda bidang kritikal</option>
                  <option value="">Sarjana Muda bidang tidak kritikal</option>
                  <option value="" >Diploma bidang kritikal</option>
                  <option value="">Diploma bidang tidak kritikal</option>
                 
                </select>
              </div> 
                  
                
                
                </td>
                <td>
                  
                  <textarea class="form-control pull-right" rows="3" 
                  name ="catatan_akademik" id="catatan_akademik" value =""  placeholder="Catatan....."></textarea>
                
                </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse14<?= $row['id_surat_masuk']?>">
                        Kemahiran Bahasa Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse14<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select id="kem_bahasa" name="kem_bahasa"class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" > 1</option>
                  <option value=""> 2</option>
                  <option value=""> 3</option>
                  <option value=""> 4</option>
                  <option value=""> 5</option>
                  <option value=""> 6</option>
                  <option value=""> 7</option>
                  <option value=""> 8</option>
                  <option value=""> 9</option>
                  <option value="">10</option>
                 
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                      0-4 lemah</br>
                      5-9 Sederhana</br>
                      10 Baik
                  
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  
                
                
                </td>
                  <td>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 </td>
                  
                  
                </tr>
               
                
                
              </table>



                    </div>
                  </div>
                </div>




                <script>
                      function tempohMenetap() {
                          var userinput = document.getElementById("TM").value;
                          var dob = new Date(userinput);
                          if(userinput==null || userinput=='') {
                            document.getElementById("message").innerHTML = "**Choose a date please!";  
                            return false; 
                          } else {
                          
                          //calculate month difference from current date in time
                          var month_diff = Date.now() - dob.getTime();
                          
                          //convert the calculated difference in date format
                          var age_dt = new Date(month_diff); 
                          
                          //extract year from date    
                          var year = age_dt.getUTCFullYear();
                          
                          //now calculate the age of the user
                          var age = Math.abs(year - 1970);
                          
                          //display the calculated age
                          return document.getElementById("tempoh").innerHTML =  
                                  "Age is: " + age + " years. ";
                          }
                      }
                    </script>

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse15<?= $row['id_surat_masuk']?>">
                        Tempoh Menetap Di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse15<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                  <option value="">-Sila Pilih-</option>
                  <option value="">3 tahun hingga 5 tahun</option>
                  <option value="">5 tahun hingga 10 tahun</option>
                  <option value="">10 tahun hingga 15 tahun</option>
                  <option value="">15 tahun keatas</option>
                </select>
              </div> 
                
                
                </td>
                
                  <td>

                  <input type=date id = TM> 

                  <span id = "message" style="color:red"> </span> 

                      <!-- Choose a date and enter in input field -->
                      <button type="reset" onclick = "tempohMenetap()"> kira tempoh </button>     

                  <h5 style="color:32A80F" id="tempoh" ></h5>
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  
                
                
                </td>
                  <td>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 </td>
                  
                  
                </tr>
               
                
                
              </table>


                    </div>
                  </div>
                </div>

                

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse16<?= $row['id_surat_masuk']?>">
                       Tempoh Perkahwinan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse16<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >3 hingga 5 tahun warganegara</option>
                  <option value="">3 hingga 5 tahun PR</option>
                  <option value="">5 hingga 10 tahun warganegara</option>
                  <option value="">5 hingga 10 tahun PR</option>
                  <option value="">10 hingga 15 tahun warganegara</option>
                  <option value="">10 hingga 15 tahun PR</option>
                  <option value="">15 tahun keatas warganegara</option>
                  <option value="">15 tahun keatas PR</option>
                  
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                  
</td>
                  
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  
                
                
                </td>
                  <td>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 </td>
                  
                  
                </tr>
               
                
                
              </table>


                    </div>
                  </div>
                </div>
                
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse17<?= $row['id_surat_masuk']?>">
                        Hubungan Kekeluargaan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse17<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Suami-</option>
                  <option value="" >Suami Warganegara</option>
                  <option value="">Suami  PR</option>
                 
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Bapa Kandung-</option>
                  
                  <option value="">Bapa kandung Warganegara</option>
                  <option value="">Bapa kandung PR</option>
              
                </select>
              </div> 
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Ibu Kandung-</option>
                  
                  <option value="">Ibu kandung Warganegara</option>
                  <option value="">Ibu kandung PR</option>
              
                </select>
              </div> 
                
                  
                  
              
                
                
                
                </td>
                
                  <td>
                 
                  
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan Isteri Warganegara"  title="Bilangan Isteri Warganegara">
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan Isteri PR" title="Bilangan Isteri PR">
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan adik beradik Warganegara" title="Bilangan adik beradik Warganegara">
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan adik beradik PR" title="Bilangan adik beradik PR">
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                  placeholder="Bilangan anak kandung warganegara" title="Bilangan anak kandung warganegara"> 
                
                
                
                </td>
                  <td>
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan anak kandung PR" title="Bilangan anak kandung PR">
              </div> 
                 </td>
                  
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  
                
                
                </td>
                  <td>
                  
                 </td>
                  
                  
                </tr>
               
                
                
              </table>


                    </div>
                  </div>
                </div>

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse18<?= $row['id_surat_masuk']?>">
                        Tempoh Pengalaman Bekerja di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse18<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  <div class="form-group">
                
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker_5" name="datepicker_5">
                </div>
              </div> 
                  
                
                
                </td>
                
                  <td>
         
                  <input type="number" class="form-control pull-right" placeholder="Umur" id="datepicker_5" name="jim_cantum">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Suami Warganegara bawah 35 tahun</option>
                  <option>Isteri Warganegara bawah 35 tahun</option>
                  <option>Suami Warganegara atas atau samadengan 35 tahun</option>
                  <option>Isteri Warganegara atas atau samadengan 35 tahun</option>
                  <option disabled="disabled">Anak Kandung/Tiri/Angkat warganera/PR/Lain-lain</option>
                  <option>Besar dari 18 tahun</option>
                  <option>Kecil dari 18 tahun</option>
                 
                </select>
              </div> 
                  
                
                
                </td>
                  <td>
                  <textarea class="form-control pull-right" rows="3" 
                  name ="alamat" id="alamat" value =""  placeholder="Catatan....."></textarea>
                 </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                </div> 




                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse19<?= $row['id_surat_masuk']?>">
                        Nilai Pelaburan di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse19<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  Pelaburan dalam bidang perniagaan
                
                
                </td>
                <td> 
                  
                  1 Mata Untuk setiap RM300,000</br>
                  *(maksimum 5 mata)
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                  min="1" max="5" placeholder="Bilangan anak kandung warganegara">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                <td> 
                  
                   Pelaburan dalam bidang hartanah
                
                
                </td>
                  <td> 
                  
                  1 Mata Untuk setiap RM500,000</br>
                  *(maksimum 5 mata)
                
                
                </td>
                  <td>
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                  min="1" max="5" placeholder="Bilangan adik beradik warganegara">
              </div> 
                 </td>
                  
                  
                </tr>
                <tr>
                <td> 
                  Menyediakan peluang pekerjaan</br>
                  kepada warganegara Malaysia</br>
                  (sertakan no KWSP)
                
                
                </td>
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >30 hingga 50 pekerja</option>
                  <option value="" >51 hingga 100 pekerja</option>
                  <option value="" >Lebih 100 pekerja</option>
                  


                  <!-- <option value="" >3 Tahun hingga 5 Tahun</option>
                  <option value="" >5 Tahun hingga 10 Tahun</option>
                  <option value="" >10 Tahun hingga 15 Tahun</option>
                  <option value="" >Lebih 15 Tahun</option> -->
                  
                 
                </select>
              </div> 
                
                
                </td>
                  <td>
                  
                 </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                </div>  

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse20<?= $row['id_surat_masuk']?>">
                        Pengiktirafan Kepakaran
                      </a>
                    </h4>
                  </div>
                  <div id="collapse20<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    
                <tr>
                <td> 
                  
                   Tempoh pengalaman sebagai pakar dalam bidang diiktiraf dalam Malaysia
                
                
                </td>
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                 <option value="" >3 Tahun hingga 5 Tahun</option>
                  <option value="" >5 Tahun hingga 10 Tahun</option>
                  <option value="" >10 Tahun hingga 15 Tahun</option>
                  <option value="" >Lebih 15 Tahun</option>
                  
                 
                </select>
              </div> 
                
                
                </td>
                  <td>
                  
                 </td>
                  
                  
                </tr>
                <tr>
                <td> 
                  Jenis institusi
                
                
                </td>
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Awam</option>
                  <option value="" >Swasta</option>
                  
              
                  
                 
                </select>
              </div> 
                
                
                </td>
                  <td>
                  
                 </td>
                  
                  
                </tr>
               
                <tr>
                  
                  <td> 
                  
                 Perakuan kepakaran
                
                
                </td>
                <td> 
                  
                <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                  min="1" max="5" placeholder="Bilangan anak kandung warganegara">
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                
              </table>
                    </div>
                  </div>
                </div> 

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse21<?= $row['id_surat_masuk']?>">
                        Pembatalan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse21<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Jenayah</option>
                  <option value="">Pemalsuan Dokumen/ Fakta</option>
                  <option value="">Kesalahan Undang-undang</option>
                 
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                 
                
                
                </td>
                  <td>
                  
              </div> 
                 </td>
                  
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                 
                
                
                </td>
                  <td>
                  
                 </td>
                  
                  
                </tr>
               
                
                
              </table>


                    </div>
                  </div>
                </div>

                

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse22<?= $row['id_surat_masuk']?>">
                        Syor Jawatan Kuasa Penilai
                      </a>
                    </h4>
                  </div>
                  <div id="collapse22<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <textarea class="form-control pull-right" rows="3" 
                  name ="alamat" id="alamat" value =""  placeholder="Catatan....."></textarea>
                    </div>
                  </div>
                </div> 

                
              <!--  -->

              </div>
            </div>
	    
              <!-- /.form-group -->

       
		<div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <input type="hidden" value="<?= (!empty($row['id_surat_masuk'])) ? $row['id_surat_masuk'] : "-" ?>" >
        
      </div>
        
    

      
        
    <?php echo form_close(); ?>
 
     
  
    </section>
</div>


</div>
</div>

<?php } ?>

<!-- ============================================tutup modal kemaskini -->


                    



<!-- Tambah Modal -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        
         <!--  <span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Daftar Surat</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('Admin/add_surat');?>
          
        <div class="form-group">

        <!-- /.box-header -->
        <div class="form-group">
                    <label>Nama Pemohon Rayuan</label>
              <div >
                    <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" placeholder="nama">
              </div>
        </div>



        <div class="form-group">
                    <label>Perkara</label>
              <div >
                    <input type="text" class="form-control" name="perkara" id="perkara" placeholder="perkara">
              </div>
        </div>

        <div class="form-group">
                    <label>Minit KPSU</label>
              <div >
                    <input type="text" class="form-control" name="minit_kpsu" id="minit_kpsu" placeholder="minit_kpsu">
              </div>
        </div>

        <div class="form-group">
                    <label>Minit PSU</label>
              <div >
                    <input type="text" class="form-control" name="minit_psu" placeholder="Minit PSU">
              </div>
        </div>

        <div class="form-group">
                    <label>Catatan</label>
              <div >
                    <input type="text" class="form-control" name="catatan" id="catatan" placeholder="catatan">
              </div>
        </div>


          <div class="row">

          
            <div class="col-md-6">

              <div class="form-group">
                 <label>Tarikh Terima Unit E:</label>
              <div class="input-group date">
                  <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
               </div>
                     <input type="text" name="tarikh_terima_unitE"  class="form-control pull-right" id="datepicker_3">
              </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
             
                <label>Tarikh Surat:</label>
              <div class="input-group date">
                  <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
               </div>
                     <input type="text" name="tarikh_surat"  class="form-control pull-right" id="datepicker_4">
              </div>
                <!-- /.input group -->
           
              </div>
              <!-- /.form-group -->



          <!-- /.form-group -->
          <div class="form-group">
             
             <label>Tarikh Terima Hingga:</label>

             <div class="input-group date">
               <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
               </div>
               <input type="text" name="tarikh_surat_akuan"  class="form-control pull-right" id="datepicker_5">
             </div>
             <!-- /.input group -->
        
           </div>
           <!-- /.form-group -->

           <!-- /.form-group -->
           <div class="form-group">
             
           <label for="exampleInputEmail1">Diterima Daripada</label>
                  <input type="text" class="form-control" name="diterima_drpd" id="diterima_drpd" placeholder="Diterima Daridapa">
             <!-- /.input group -->
        
           </div>
           <!-- /.form-group -->



              <!-- ====================================split here===================================== -->


            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
              <label for="exampleInputEmail1">Perkara Rayuan</label>
                  <input type="text" class="form-control" name="perkara_rayuan" id="perkara_rayuan" placeholder="Perkara Rayuan">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">No Rujukan</label>
                  <input type="text" class="form-control" name="no_ruj_jim" id="no_ruj_jim" placeholder="No Rujukan">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Warganegara</label>
                  <input type="text" class="form-control" name="warganegara" id="warganegara" placeholder="Warganegara">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <input type="text" class="form-control" name="status" id="status" placeholder="Status">
              </div>
              <!-- /.form-group -->

        <!-- ===============================Split heree ========================== -->


            </div>
            <!-- /.col -->

          <!-- /.row -->
        
        <!-- /.box-body -->

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    
    <?php echo form_close(); ?>
    </div>
      <!-- /.box -->
     </div>
   </div>
		 </div>
	   
  <!-- /.row -->






<!-- Modal Delete -->
<?php 
foreach ($surat_masuk as $row){
?>
<div class="modal fade" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= $row['nama_pemohon']?></h4>
      </div>
      <div class="modal-body">
        <p>Adakah anda mahu ingin hapus data ini&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <a href="<?= site_url('Admin/hapus_user/'.$row['id_surat_masuk'])?>" class="btn btn-danger">Delete</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<!-- /.modal -->
<!-- /.Modal Delete -->




</section>







<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(700, function()  {
      $(this).remove();
    });
    }, 7000);
</script>
