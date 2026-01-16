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
            <div class="col-md-6">
              <div class="form-group">
                <label>Warganegara</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
             
                <label>Tarikh Terima Dari:</label>

                <div class="input-group date ">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
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
               <input type="text" class="form-control pull-right" id="datepicker_2">
             </div>
             <!-- /.input group -->
        
           </div>
           <!-- /.form-group -->



            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                  <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" placeholder="Enter email">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">No Rujukan JIM</label>
                  <input type="text" class="form-control" name ="no_ruj_jim" id="no_ruj_jim" placeholder="Enter email">
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
              <th width="10%">Tarikh Terima</th>
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
              <td><?= (!empty($row['tarikh_terima_unitE'])) ? $row['tarikh_terima_unitE'] : "-" ?></td>
              <td>
                  
              </td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-sticky-note-o"></i></button>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?= $row['id_surat_masuk']?>"><i class="fa fa fa-edit"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?= $row['id_surat_masuk']?>"><i class="fa fa-trash"></i></button>
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
		
		
		
          
        <!-- Edit Modal -->
<?php 
foreach ($surat_masuk as $row){
?>
<div class="modal fade" id="modal-edit<?= $row['id_surat_masuk']?>">
  <div class="modal-dialog ">
    <div class="modal-content">
      
		
		
		<div class="modal-header">
        
         <!--  <span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Kemaskini Surat</h4>
      </div>
      

      <div class="modal-body">
      
      <?php echo form_open('Admin/edit_surat/'.$row['id_surat_masuk']);?>
          
        <div class="form-group">

        <!-- /.box-header -->
       
        <div class="row">
        <div class="col-md-9">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Kiraan Mata</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      Umur
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
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
                   
                  








                
                  <input type="text" class="form-control pull-right" placeholder="Umur" id="datepicker_5" name="jim_cantum">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Kelayakan Akademik
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                
                <tr>
                  
                  <td> 
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Phd bidang kritikal</option>
                  <option value="" >Phd bidang tidak kritikal</option>
                  <option>Sarjana/Profesional bidang kritikal</option>
                  <option>Sarjana/Profesional bidang tidak kritikal</option>
                  <option >Sarjana Muda bidang kritikal</option>
                  <option >Sarjana Muda bidang tidak kritikal</option>
                  <option >Diploma bidang kritikal</option>
                  <option >Diploma bidang tidak kritikal</option>
                 
                </select>
              </div> 
                  
                
                
                </td>
                <td>
                  
                  <textarea class="form-control pull-right" rows="3" name ="alamat" id="alamat" value =""  placeholder="Catatan....."></textarea>
                
                </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Kemahiran Bahasa Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Lemah 1</option>
                  <option value="">Lemah 2</option>
                  <option value="">Lemah 3</option>
                  <option value="">Sederhana 4</option>
                  <option value="">Sederhana 5</option>
                  <option value="">Sederhana 6</option>
                  <option value="">Sederhana 7</option>
                  <option value="">Sederhana 8</option>
                  <option value="">Sederhana 9</option>
                  <option value="">Baik</option>
                 
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                        Tempoh Menetap Di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse4" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                       Tempoh Perkahwinan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse5" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                        Hubungan Kekeluargaan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse6" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Suami Warganegara</option>
                  <option value="">Isteri Warganegara</option>
                  <option value="">Suami PR</option>
                  <option value="">Isteri PR</option>
                  <option value="">Ibu Warganegara</option>
                  <option value="">Bapa Kandung Warganegara</option>
                  <option value="">Ibu PR</option>
                  <option value="">Bapa Kandung PR</option>
                  <option value="">Setiap anak kandung warganegara</option>
                  <option value="">Setiap anak kandung PR</option>
                  <option value="">Setiap adik-beradik kandung warganegara</option>
                  <option value="">Setiap adik-beradik kandung PR</option>
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                        Tempoh Pengalaman Bekerja di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse7" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>
                </div> 




                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                        Nilai Pelaburan di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse8" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>
                </div>  

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                        Pengiktirafan Kepakaran
                      </a>
                    </h4>
                  </div>
                  <div id="collapse9" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>
                </div> 

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                        Pembatalan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse10" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>
                </div> 

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                        Syor Jawatan Kuasa Penilai
                      </a>
                    </h4>
                  </div>
                  <div id="collapse11" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>
                </div> 

                
              <!--  -->

              </div>
            </div>
	    <div class="form-group">
			<label>Nombor Fail</label>
              <div>
                    <input type="text" class="form-control" name="no_fail" id="no_fail" 
                    value="<?php if(!empty($no_fail)){echo $no_fail;}?>"  placeholder="Nombor Fail">
              </div>
        </div>



        <div class="form-group">
                    <label>Nama Penaja</label>
              <div >
                    <input type="text" class="form-control" name="nama_penaja" id="nama_penaja" 
                    value="<?php if(!empty($nama_penaja)){echo $nama_penaja;}?>" placeholder="Nama Penaja">
              </div>
        </div>

        <div class="form-group">
                    <label>No KP Penaja</label>
              <div >
                    <input type="text" class="form-control" name="no_kp_penaja" id="no_kp_penaja" 
                    value="<?php if(!empty($nama_penaja)){echo $nama_penaja;}?>"  placeholder="No KP Penaja">
              </div>
        </div>

        <div class="form-group">
                    <label>Alamat</label>
              <div >
                    <input type="text" class="form-control" name="alamat1" id="alamat1"
                    value="<?php if(!empty($alamat1)){echo $alamat1;}?>"  placeholder="Alamat">
              </div>
        </div>

        <div class="form-group">
                    <label>Lokasi</label>
              <div >
                    <input type="text" class="form-control" name="lokasi" id="lokasi" 
                    value="<?php if(!empty($lokasi)){echo $lokasi;}?>"  placeholder="lokasi">
              </div>
        </div>
        <div class="form-group">
                    <label>Negara Asal</label>
              <div >
                    <input type="text" class="form-control" name="negara_asal" id="negara_asal" 
                    value="<?php if(!empty($negara_asal)){echo $negara_asal;}?>"  placeholder="Negara Asal">
              </div>
        </div>

        <div class="form-group">
                    <label>Catatan</label>
              <div >
                    <input type="text" class="form-control" name="catatan" id="catatan" 
                    value="<?php if(!empty($catatan)){echo $catatan;}?>"  placeholder="catatan">
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
                     <input type="text" name="tarikh_terima_unitE" value="<?= $row['tarikh_terima_unitE']?>"   class="form-control pull-right" id="datepicker_6">
              </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
             
                <label>Tarikh Surat:</label>
              <div class="input-group date">
                  <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
               </div>
                     <input type="text" name="tarikh_surat" 
                     value="<?= $row['tarikh_surat']?>"  class="form-control pull-right" id="datepicker_7">
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
               <input type="text" name="tarikh_surat_akuan" value="<?= $row['tarikh_surat_akuan']?>"  class="form-control pull-right" id="datepicker_8">
             </div>
             <!-- /.input group -->
        
           </div>
           <!-- /.form-group -->

           <!-- /.form-group -->
           <div class="form-group">
             
           <label for="exampleInputEmail1">Diterima Daripada</label>
                  <input type="text" class="form-control" name="diterima_drpd" id="diterima_drpd"
                  value="<?= $row['diterima_drpd']?>"  placeholder="Diterima Daridapa">
             <!-- /.input group -->
        
           </div>
           <!-- /.form-group -->



              <!-- ====================================split here===================================== -->


            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
              <label for="exampleInputEmail1">Negara Asal</label>
                  <input type="text" class="form-control" name="perkara_rayuan" id="perkara_rayuan"
                  value="<?= $row['perkara_rayuan']?>" placeholder="Perkara Rayuan">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Jantina</label>
                  <input type="text" class="form-control" name="no_ruj_jim" id="no_ruj_jim" 
                  value="<?= $row['no_ruj_jim']?>"  placeholder="No Rujukan">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Kategori</label>
                  <input type="text" class="form-control" name="warganegara" id="warganegara"
                  value="<?= $row['warganegara']?>" placeholder="Warganegara">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <input type="text" class="form-control" name="status" id="status"
                  value="<?= $row['status']?>"  placeholder="Status">
              </div>
              <!-- /.form-group -->

        <!-- ===============================Split heree ========================== -->
		<div class="modal-footer">
        <button type="submit" class="btn btn-primary">Kemaskini</button>
      </div>
        
    		</div>
 
          <!-- /.row -->
        
        <!-- /.box-body -->
        
    <?php echo form_close(); ?>
    <!-- /.modal-content -->
<!-- /.modal -->
<!-- /.Edit Modal -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  </div>
  </div>
  </div>

  <!-- /.row -->
</section>
<!-- /.content -->

<?php } ?>

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
<div class="modal fade" id="modal-delete<?= $row['id_surat_masuk']?>">
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
        <a <a href="<?= site_url('Admin/hapus_user/'.$row['id_surat_masuk'])?>" class="btn btn-danger">Delete</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<!-- /.modal -->
<!-- /.Modal Delete -->












<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(700, function()  {
      $(this).remove();
    });
    }, 7000);
</script>
