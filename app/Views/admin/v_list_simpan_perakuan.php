<!-- Main content -->

<section class="content">
<form name="carian" action="<?= site_url()?>/admin/list_simpan_perakuan" method="post">
<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Carian Surat</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
   
        <div class="box-body">
          <div class="row">
    
            <div class="col-md-6">
              <div class="form-group">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                  <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" placeholder="Nama Pemohon">
              </div>
          
              <div class="form-group">
                  <label for="exampleInputEmail1">Kategori Pemohon</label>
                  
                  <select id="id_kategori_pemohon" name="id_kategori_pemohon" class="form-control select2" style="width: 100%;">
                    <option value="">--Sila Pilih--</option>                             
                              <?php foreach($list_kategori_pemohon as $row):?>
							      <option value= "<?= $row['id_kategori_pemohon']  ?>"><?= $row['kategori_pemohon'] ?></option>  
											
									          <?php endforeach;?>
                 
                 </select>
              </div>
           
            </div>
          
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <button type="submit" class="btn btn-success btn-sm" >Cari</button> 
        
        </div>
      </div>



      
 <?php $rayuan_baru_ids = session()->get('rayuan_baru_ids') ?? []; 


?> 

  <div class="row">

  </form>
  
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
      <div class="box box-success">
        <div class="box-header">

        <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-tambah">Tambah</button> -->
            </P>
          <h3 class="box-title">Senarai Kertas Perakuan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form action="<?php echo url_to('rayuan_baru.download'); ?>" method="POST">
        
          <button type="submit"   value="kira" class="btn btn-success">Cetak Perakuan</button>
        
        </p> 
        </p> 
          
          
          

          <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                    <table class="table table-bordered">
                    
                <tr>
                  
                  <td>No Surat Rujukan Perakuan<code>*</code></td>
                  
                  <td>
                  <input type="text" class="form-control " required name ="no_kertas_perakuan" id="no_kertas_perakuan" 
                  onChange="javascript:this.value=this.value.toUpperCase();" placeholder="No Surat Rujukan Perakuan">
                 </td>
                  <td>KSU<code>*</code></td>
                  <td>
                <select id="ksu" name="ksu" class="form-control select2" style="width: 100%;">
                    <option value="">--Sila Pilih--</option>                             
                              <?php foreach($list_ksu as $row):?>
							      <option value= "<?= $row['name_ksu']  ?>"><?= $row['name_ksu'] ?></option>  
											
									          <?php endforeach;?>
                 
                 </select>
                  

                </td>
                  
                </tr>
                
                
             

                <tr>
                <td>Di Semak Oleh<code>*</code></td>
                  
                  <td>
                 
                  <select id="disemak_oleh" name="disemak_oleh" class="form-control select2" style="width: 100%;">
                    <option value="">--Sila Pilih--</option>                             
                              <?php foreach($list_penyemak as $row):?>
							      <option value= "<?= $row['name_penyemak']  ?>"><?= $row['name_penyemak'] ?></option>  
											
									          <?php endforeach;?>
                 
                 </select>
                 </td>
                  <td>Disahkan Oleh<code>*</code></td>
                  <td>
                  <select id="disahkan_oleh" name="disahkan_oleh" class="form-control select2" style="width: 100%;">
                    <option value="">--Sila Pilih--</option>                             
                              <?php foreach($list_pengesah as $row):?>
							      <option value= "<?= $row['name_pengesah']  ?>"><?= $row['name_pengesah'] ?></option>  
											
									          <?php endforeach;?>
                 
                 </select>

                </td>
                </tr>
                <tr>
                <td>Yb Menteri<code>*</code></td>
                  
                  <td>

                  <select id="yb_menteri" name="yb_menteri" class="form-control select2" style="width: 100%;">
                    <option value="">--Sila Pilih--</option>                             
                              <?php foreach($list_menteri as $row):?>
							      <option value= "<?= $row['name_menteri']  ?>"><?= $row['name_menteri'] ?></option>  
											
									          <?php endforeach;?>
                 
                 </select>
                  <!-- <input type="text" class="form-control " required name ="yb_menteri" id="yb_menteri" 
                  onChange="javascript:this.value=this.value.toUpperCase();" placeholder="Yb Menteri"> -->
                 </td>
                  <!-- <td>Tarikh Kertas Perakuan<code>*</code></td>
                  <td>
                  <input type="date" class="date_picker form-control" required 
                  id="tarikh_perakuan" name="tarikh_perakuan" 
                  value=""> 
                 

                </td> -->
                </tr>
               <div>
                  
      </div>
                   
                	    
                 
                  
                </tr>
                
              </table>
              

            </p> 

            

          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Bil</th>
              <th>pilih <input type="checkbox" name="pilih_senarai" id="pilih_senarai" class=""></th>
              <th  width="20%">Nama Pemohon Rayuan</th>
              <th width="20%">No fail jim</th>
              <th width="15%">No Kertas Perakuan</th>
              <th width="15%">Status Rayuan</th>
			  <th width="15%">Kategori Pas</th>
			  <th width="10%">Keputusan</th>
              <th width="15%">Tindakan</th>
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
              <td>

              <?php if (!empty($row['id_rayuan'])) { ?>
                <input  type="checkbox" name="senarai_id_surat_masuk[]" id="senarai_id_surat_masuk[]"class="pilih_rayuan" value="<?php echo $row['id_rayuan']; ?>" 
              
                
                <?php 
                
                if (in_array($row['id_rayuan'], $rayuan_baru_ids)) {
                  echo 'checked';
                }
                ?>
                >
              <?php } ?>
              </td>

              <td><?= $row['nama_pemohon'] ?>
              </td>
              
              <td><?= (!empty($row['no_fail_jim'])) ? $row['no_fail_jim'] : "-" ?>  </td>
              <td >
                <?= (!empty($row['no_kertas_perakuan'])) ? $row['no_kertas_perakuan'] : "-" ?>
              
			  <td>
              <?php echo get_status_rayuan($row['status_rayuan']); ?>
              </td>
              <td >
                <?= $row['cat_pas'] ?>
              </td>
              <td >
                <?= $row['keputusan'] ?>
              </td>
              <td>
                <div class="btn-group">
                  
                 
                 
                  <?php if($row['id_add']=='2'){ ?>

                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" 
                          data-target="#modal-kemaskini<?= $row['id_rayuan']?>">
                          <i class="fa fa-edit"></i></button> -->
                                          
                         
                          <button title="Syor Penilai" type="button" class="btn btn-primary btn-sm"
                          onclick="window.location.href='<?= site_url()?>/admin/syor_penilai/<?= $row['id_surat_masuk']?>';">
                          <i class="fa  fa-legal"></i></button>                     
                                          
                  <?php }else{ ?>

                    <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" 
                          data-target="#modal-add<?= $row['id_surat_masuk']?>">
                          <i class="fa fa-plus-square"></i></button>
                          -->
                                 
                                         
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
		
        </form>	
 

<?php 
foreach ($surat_masuk as $row){
?>


<?php if($row['id_add']=='2'){ ?>
  
  <div class="modal fade" id="modal-kemaskini<?= $row['id_rayuan']?>">
            
<?php }else{ ?>

  <div class="modal fade" id="modal-add<?= $row['id_surat_masuk']?>">
                    
<?php }  ?>

  


<div class="modal-dialog ">
    <div class="modal-content">
      
			

    <?php if($row['id_add']=='2'){ ?>
  
      <?php echo form_open('Admin/edit_rayuan/'.$row['id_rayuan']);?>
    
            <?php }else{ ?>

              <?php echo form_open('Admin/add_rayuan');?>
 
    <?php }  ?>
		
		<div class="modal-header">
        
         <!--  =========================================================================== -->
        
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
              
              <input type="date" data-date-format="yyyy-mm-dd" value="<?= $row['jim_cantum']?>" class="form-control pull-right" 
              value="" id="jim_cantum" name="jim_cantum">
            </div>
                  </td>
                  
                </tr>
                <tr>
                 
                  <td>Kategori Pemohon</td>
                  <td>
                  <select id="kategori_pemohon" name="kategori_pemohon"class="form-control select2" style="width: 100%;">

                  <option value="" >-Sila Pilih-</option>
                  <option value="1" <?php if($row['id_kategori_pemohon']=='1'){echo"selected"; }?>>ketegori_pemohon1</option>
                  <option value="2" <?php if($row['id_kategori_pemohon']=='2'){echo"selected"; }?>>ketegori_pemohon2</option>
                  <option value="3" <?php if($row['id_kategori_pemohon']=='3'){echo"selected"; }?>>ketegori_pemohon3</option>
                  
                </select>
                  </td>
                  <td>Jenis PAS</td>
                  <td>
                  <select id="jenis_pas" name="jenis_pas"class="form-control select2" style="width: 100%;">

                  <option value="" >-Sila Pilih-</option>
                  <option value="1" <?php if($row['id_jenis_pas']=='1'){echo"selected"; }?>>jenis_pas1</option>
                  <option value="2" <?php if($row['id_jenis_pas']=='2'){echo"selected"; }?>>jenis_pas2</option>
                  <option value="3" <?php if($row['id_jenis_pas']=='3'){echo"selected"; }?>>jenis_pas3</option>
                 </td>
                  
                </tr>
                <tr>
                  
                  <td>No Rujukan Fail KDN</td>
                  <td>
                  <input type="text" class="form-control" value="<?= $row['no_ruj_kdn']?>" name ="no_ruj_kdn" id="no_ruj_kdn" 
                  placeholder="No Rujukan Fail KDN">
                  </td>
                  
                  
                </tr>
                <tr>
                 
                  
                 
                  
                </tr>
                
              </table>
         <!--  <span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Sistem Mata</h4>          
        

        <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseA<?= $row['id_surat_masuk']?>">
                      1.Umur
                      </a>
                    </h4>
                  </div>
                  <div id="collapseA<?= $row['id_surat_masuk']?>" class="panel-collapse collapse in">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                
                  <label>Tarikh Lahir</label>
                  <br>
                  <input type="text" class="date_picker1 form-control" 
                  id="tarikh_lahir_<?= $row['id_surat_masuk']?>" name="tarikh_lahir_<?= $row['id_surat_masuk']?>" 
                  value="<?php echo set_value('tarikh_lahir','');?>"> 
                  <br>
            
                  <label>umur</label>
          
                  <input type="text" class="col-sm-4 col-md-2" id="umur_sebenar_<?= $row['id_surat_masuk']?>" 
                  name="umur_sebenar_<?= $row['id_surat_masuk']?>" value="" readonly>
           </td>
               
                  <td>
                   
            
                      
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                        
         <select id="umur" name="umur"class="form-control select2" style="width: 100%;">

             <option value="" >-Sila Pilih-</option>
             <option value="10"<?php if($row['umur']=='10'){echo"selected"; }?> >Bawah 35 tahun</option>
             <option value="5"<?php if($row['umur']=='5'){echo"selected"; }?>>Lebih 35 </option>
                  
        </select>
                
             
                  
                
                
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
                <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse13<?= $row['id_surat_masuk']?>">
                        2.Kelayakan Akademik
                      </a>
                    </h4>
                  </div>
                  <div id="collapse13<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                
                <tr>
                  
                  <td> 
                  <select id="kel_akademik" name="kel_akademik"class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="10" <?php if($row['kel_akademik']=='10'){echo"selected"; }?>>Phd bidang kritikal</option>
                  <option value="6"<?php if($row['kel_akademik']=='6'){echo"selected"; }?> >Phd bidang tidak kritikal</option>
                  <option value="7"<?php if($row['kel_akademik']=='7'){echo"selected"; }?>>Sarjana/Profesional bidang kritikal</option>
                  <option value="4"<?php if($row['kel_akademik']=='4'){echo"selected"; }?>>Sarjana/Profesional bidang tidak kritikal</option>
                  <option value="5" <?php if($row['kel_akademik']=='5'){echo"selected"; }?>>Sarjana Muda bidang kritikal</option>
                  <option value="2"<?php if($row['kel_akademik']=='2'){echo"selected"; }?>>Sarjana Muda bidang tidak kritikal</option>
                  <option value="1"<?php if($row['kel_akademik']=='1'){echo"selected"; }?> >Diploma bidang kritikal</option>
                  <option value="0"<?php if($row['kel_akademik']=='0'){echo"selected"; }?>>Diploma bidang tidak kritikal</option>
                 
                </select>                  <div class="form-group">
                
                  
              </div> 
                  
                
                
                </td>
                <td>
                  
                  <textarea class="form-control pull-right" rows="3" 
                  name ="catatan_akademik" id="catatan_akademik" value =""  placeholder="Catatan....."><?= $row['catatan_akademik']?></textarea>
                
                </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse14<?= $row['id_surat_masuk']?>">
                        3.Kemahiran Bahasa Malaysia
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
                  <option value="1" <?php if($row['kem_bahasa']=='1'){echo"selected"; }?> > 1</option>
                  <option value="2" <?php if($row['kem_bahasa']=='2'){echo"selected"; }?> > 2</option>
                  <option value="3" <?php if($row['kem_bahasa']=='3'){echo"selected"; }?> > 3</option>
                  <option value="4" <?php if($row['kem_bahasa']=='4'){echo"selected"; }?> > 4</option>
                  <option value="5" <?php if($row['kem_bahasa']=='5'){echo"selected"; }?> > 5</option>
                  <option value="6" <?php if($row['kem_bahasa']=='6'){echo"selected"; }?> > 6</option>
                  <option value="7" <?php if($row['kem_bahasa']=='7'){echo"selected"; }?> > 7</option>
                  <option value="8"<?php if($row['kem_bahasa']=='8'){echo"selected"; }?> > 8</option>
                  <option value="9" <?php if($row['kem_bahasa']=='9'){echo"selected"; }?> > 9</option>
                  <option value="10" <?php if($row['kem_bahasa']=='10'){echo"selected"; }?> >10</option>
                 
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                  <div class="form-group">
                      0-4 lemah</br>
                      5-9 Sederhana</br>
                      10 Baik
                    </div>
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




                

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse15<?= $row['id_surat_masuk']?>">
                        4.Tempoh Menetap Di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse15<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <label>Tarikh Menetap</label>
                  <br>
                  <input type="text" class="date_picker2 form-control" 
                  id="tarikh_menetap_<?= $row['id_surat_masuk']?>" name="tarikh_menetap_<?= $row['id_surat_masuk']?>" 
                  value="<?php echo set_value('tarikh_menetap','');?>"> 
                  <br>
            
                  <label>tahun</label>
          
                  <input type="text" class="col-sm-4 col-md-2" id="menetap_sebenar_<?= $row['id_surat_masuk']?>" 
                  name="menetap_sebenar_<?= $row['id_surat_masuk']?>" value="" readonly>
                  
                
                
                </td>
                
                  <td>
                  <textarea class="form-control pull-right" rows="3" 
                  name ="cttn_tem_menetap" id="cttn_tem_menetap" value =""  placeholder="Catatan....."><?= $row['cttn_tem_menetap']?></textarea>
                 
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  
                  <div class="form-group">
                
                <select name="tem_menetap" id="tem_menetap" class="form-control select2" style="width: 100%;">
                  <option value="">-Sila Pilih-</option>
                  <option value="2" <?php if($row['tem_menetap']=='2'){echo"selected"; }?> >3 tahun hingga 4 tahun</option>
                  <option value="5" <?php if($row['tem_menetap']=='5'){echo"selected"; }?>>5 tahun hingga 9 tahun</option>
                  <option value="7" <?php if($row['tem_menetap']=='7'){echo"selected"; }?>>10 tahun hingga 14 tahun</option>
                  <option value="10" <?php if($row['tem_menetap']=='10'){echo"selected"; }?>>15 tahun dan keatas</option>
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

                  <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse16<?= $row['id_surat_masuk']?>">
                       5.Tempoh Perkahwinan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse16<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  <label>Tarikh Kahwin</label>
                  <br>
                  <input type="text" class="date_picker3 form-control" 
                  id="tarikh_kahwin_<?= $row['id_surat_masuk']?>" name="tarikh_kahwin_<?= $row['id_surat_masuk']?>" 
                  value="<?php echo set_value('tarikh_kahwin','');?>"> 
                  <br>
            
                  <label>tahun</label>
          
                  <input type="text" class="col-sm-4 col-md-2" id="kahwin_sebenar_<?= $row['id_surat_masuk']?>" 
                  name="kahwin_sebenar_<?= $row['id_surat_masuk']?>" value="" readonly>
                </td>
                
                  <td>
                  
</td>
                  
                 
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select name="tem_kahwin" id="tem_kahwin" class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="2" <?php if($row['tem_kahwin']=='2'){echo"selected"; }?>>3 hingga 4 tahun warganegara</option>
                  <option value="1" <?php if($row['tem_kahwin']=='1'){echo"selected"; }?>>3 hingga 4 tahun PR</option>
                  <option value="4" <?php if($row['tem_kahwin']=='4'){echo"selected"; }?>>5 hingga 9 tahun warganegara</option>
                  <option value="3" <?php if($row['tem_kahwin']=='3'){echo"selected"; }?>>5 hingga 9 tahun PR</option>
                  <option value="6" <?php if($row['tem_kahwin']=='6'){echo"selected"; }?>>10 hingga 14 tahun warganegara</option>
                  <option value="5" <?php if($row['tem_kahwin']=='5'){echo"selected"; }?>>10 hingga 14 tahun PR</option>
                  <option value="10" <?php if($row['tem_kahwin']=='10'){echo"selected"; }?>>15 tahun keatas warganegara</option>
                  <option value="7" <?php if($row['tem_kahwin']=='7'){echo"selected"; }?>>15 tahun keatas PR</option>
                  
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

                  <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse17<?= $row['id_surat_masuk']?>">
                        6.Hubungan Kekeluargaan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse17<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                6.1 Suami<select name="hub_keluarga1" id="hub_keluarga1" class="form-control select2" style="width: 100%;">
                <option value="" >-sila pilih-</option>
                  <option value="2" <?php if($row['hub_keluarga1']=='2'){echo"selected"; }?>>Suami Warganegara</option>
                  <option value="1" <?php if($row['hub_keluarga1']=='1'){echo"selected"; }?>>Suami  PR</option>
                 
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                6.2 Bapa<div class="form-group">
                
                <select name="hub_keluarga2" id="hub_keluarga2" class="form-control select2" style="width: 100%;">
                <option value="" >-sila pilih-</option>
                  
                  <option value="2" <?php if($row['hub_keluarga2']=='2'){echo"selected"; }?>>Bapa kandung Warganegara</option>
                  <option value="1" <?php if($row['hub_keluarga2']=='1'){echo"selected"; }?>>Bapa kandung PR</option>
              
                </select>
              </div> 
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                6.3 Ibu kandung<select  name="hub_keluarga3" id="hub_keluarga3" class="form-control select2" style="width: 100%;">
                <option value="" >-sila pilih-</option>
                  
                  <option value="2" <?php if($row['hub_keluarga3']=='2'){echo"selected"; }?>>Ibu kandung Warganegara</option>
                  <option value="1" <?php if($row['hub_keluarga3']=='2'){echo"selected"; }?>>Ibu kandung PR</option>
              
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
                  
                 6.4 <input type="number" class="form-control" name="hub_keluarga4" id="hub_keluarga4"
                   placeholder="Bilangan Isteri Warganegara"  title="Bilangan Isteri Warganegara">
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                6.5 <input type="number" class="form-control" name="hub_keluarga5" id="hub_keluarga5"
                   placeholder="Bilangan Isteri PR" title="Bilangan Isteri PR">
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                 6.6 <input type="number" class="form-control" name="hub_keluarga6" id="hub_keluarga6"
                   placeholder="Bilangan adik beradik Warganegara" title="Bilangan adik beradik Warganegara">
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                6.7 <input type="number" class="form-control" name="hub_keluarga7" id="hub_keluarga7"
                   placeholder="Bilangan adik beradik PR" title="Bilangan adik beradik PR">
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  6.8<input type="number" class="form-control" name="hub_keluarga8" id="hub_keluarga8"
                  placeholder="Bilangan anak kandung warganegara" title="Bilangan anak kandung warganegara"> 
                
                
                
                </td>
                  <td>
                  6.9<input type="number" class="form-control" name="hub_keluarga9" id="hub_keluarga9"
                   placeholder="Bilangan anak kandung PR" title="Bilangan anak kandung PR">
              </div> 
                 </td>
                  
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <textarea class="form-control pull-right" rows="3" 
                  name ="cttn_hub_keluarga" id="cttn_hub_keluarga" value =""  placeholder="Catatan....."><?= $row['cttn_hub_keluarga']?></textarea>
                
                
                </td>
                  <td>
                  
                 </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                  </div>


                  <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse18<?= $row['id_surat_masuk']?>">
                        7.Tempoh Pengalaman Bekerja di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse18<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  <label>Tarikh Mula Kerja</label>
                  <br>
                  <input type="text" class="date_picker4 form-control" 
                  id="tarikh_kerja_<?= $row['id_surat_masuk']?>" name="tarikh_kerja_<?= $row['id_surat_masuk']?>" 
                  value="<?php echo set_value('tarikh_kerja','');?>"> 
                  <br>
            
                  <label>tahun</label>
          
                  <input type="text" class="col-sm-4 col-md-2" id="kerja_sebenar_<?= $row['id_surat_masuk']?>" 
                  name="kerja_sebenar_<?= $row['id_surat_masuk']?>" value="" readonly>
                
                
                </td>
                
                  <td>
         
                  
                 </td>
                    </tr>
                    
                
                    <tr>
                  
                  <td> 
                  <div class="form-group">
                
                <select name="tem_pengalaman" id="tem_pengalaman" class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="1" <?php if($row['tem_pengalaman']=='1'){echo"selected"; }?>>1 tahun</option>
                  <option value="2" <?php if($row['tem_pengalaman']=='2'){echo"selected"; }?>>2 tahun</option>
                  <option value="3" <?php if($row['tem_pengalaman']=='3'){echo"selected"; }?>>3 tahun</option>
                  <option value="4" <?php if($row['tem_pengalaman']=='4'){echo"selected"; }?>>4 tahun</option>
                  <option value="5" <?php if($row['tem_pengalaman']=='5'){echo"selected"; }?>>Lebih 5 tahun</option>
                 
                </select>
              </div> 
                  
                
                
                </td>
                  <td>
                  <textarea class="form-control pull-right" rows="3" 
                  name ="cttn_tem_pengalaman" id="cttn_tem_pengalaman" value =""  placeholder="Catatan....."><?= $row['cttn_tem_pengalaman']?></textarea>
                 </td>
                  
                  
                </tr>
               
                
                
              </table>
                    </div>
                  </div>
                  </div>



                  <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse19<?= $row['id_surat_masuk']?>">
                        8.1 Nilai Pelaburan di Malaysia
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
                  
                <div class="form-group">
                
                <select id="nilai_pelaburan1" name="nilai_pelaburan1" class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="1" <?php if($row['nilai_pelaburan1']=='1'){echo"selected"; }?> >RM300k hingga RM600k</option>
                  <option value="2" <?php if($row['nilai_pelaburan1']=='2'){echo"selected"; }?>>RM600k hingga RM900k</option>
                  <option value="3" <?php if($row['nilai_pelaburan1']=='3'){echo"selected"; }?>>RM900k hingga RM1.2juta</option>
                  <option value="4" <?php if($row['nilai_pelaburan1']=='5'){echo"selected"; }?>>RM1.2juta hingga RM1.5juta</option>
                  <option value="5" <?php if($row['nilai_pelaburan1']=='5'){echo"selected"; }?>>Lebih RM1.5juta </option>
                 
                 
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                <td> 
                  
                   Pelaburan dalam bidang hartanah
                
                
                </td>
                  <td> 
                  
                  <div class="form-group">
                
                <select id="nilai_pelaburan2" name="nilai_pelaburan2" class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="1" <?php if($row['nilai_pelaburan2']=='1'){echo"selected"; }?> > RM500k hingga RM1juta</option>
                  <option value="2" <?php if($row['nilai_pelaburan2']=='2'){echo"selected"; }?>> RM1juta hingga RM1.5juta</option>
                  <option value="3" <?php if($row['nilai_pelaburan2']=='3'){echo"selected"; }?>> RM1.5juta hingga RM2juta</option>
                  <option value="4" <?php if($row['nilai_pelaburan2']=='4'){echo"selected"; }?>> RM2juta hingga RM2.5juta</option>
                  <option value="5" <?php if($row['nilai_pelaburan2']=='5'){echo"selected"; }?>> Lebih RM2.5juta </option>
                 
                 
                </select>
              </div> 
                
                
                </td>
                  <td>
                  
                 </td>
                  
                  
                </tr>
                <tr>
                <td> 
                  
                   Duit Simpanan(Fix Deposit)
                
                
                </td>
                  <td> 
                  
                  <div class="form-group">
                
                <select id="nilai_pelaburan3" name="nilai_pelaburan3" class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="1" <?php if($row['nilai_pelaburan3']=='1'){echo"selected"; }?>> RM100k hingga RM200k</option>
                  <option value="2" <?php if($row['nilai_pelaburan3']=='2'){echo"selected"; }?>> RM200k hingga RM300k</option>
                  <option value="3" <?php if($row['nilai_pelaburan3']=='3'){echo"selected"; }?>> RM300k hingga RM400k</option>
                  <option value="4" <?php if($row['nilai_pelaburan3']=='4'){echo"selected"; }?>> RM400k hingga RM500k</option>
                  <option value="5" <?php if($row['nilai_pelaburan3']=='5'){echo"selected"; }?>> Lebih RM500k </option>
                 
                 
                </select>
              </div> 
                
                
                </td>
                  <td>
                  
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
                
                <select id="nilai_pelaburan4" name="nilai_pelaburan4" class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="3" <?php if($row['nilai_pelaburan4']=='3'){echo"selected"; }?>>30 hingga 50 pekerja</option>
                  <option value="7" <?php if($row['nilai_pelaburan4']=='7'){echo"selected"; }?>>51 hingga 100 pekerja</option>
                  <option value="10" <?php if($row['nilai_pelaburan4']=='10'){echo"selected"; }?>>Lebih 100 pekerja</option>
                  


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



                  <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse20<?= $row['id_surat_masuk']?>">
                        8.2 Pengiktirafan Kepakaran
                      </a>
                    </h4>
                  </div>
                  <div id="collapse20<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    
                <tr>
                <td> 
                  
                   Tempoh pengalaman <br>sebagai pakar dalam <br>bidang diiktiraf dalam Malaysia
                
                
                </td>
                  <td> 
                  
                  <div class="form-group">
                
                <select name="kepakaran1" id="kepakaran1" class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                 <option value="2" <?php if($row['kepakaran1']=='2'){echo"selected"; }?>>3 Tahun hingga 4 Tahun</option>
                  <option value="5" <?php if($row['kepakaran1']=='5'){echo"selected"; }?>>5 Tahun hingga 9 Tahun</option>
                  <option value="7" <?php if($row['kepakaran1']=='7'){echo"selected"; }?>>10 Tahun hingga 14 Tahun</option>
                  <option value="10" <?php if($row['kepakaran1']=='10'){echo"selected"; }?>>15 Tahun dan keatas</option>
                  
                 
                </select>
              </div> 
                
                
                </td>
                  <td>
                  <textarea class="form-control pull-right" rows="3" 
                  name ="cttn_kepakaran1" id="cttn_kepakaran1" value =""  placeholder="Catatan....."><?= $row['cttn_kepakaran1']?></textarea>
                 </td>
                  
                  
                </tr>
                <tr>
                <td> 
                  Jenis institusi
                
                
                </td>
                  <td> 
                  
                  <div class="form-group">
                
                <select name="kepakaran2" id="kepakaran2" class="form-control select2" style="width: 100%;">
                <option value="">-Sila Pilih-</option>
                  <option value="10" <?php if($row['kepakaran2']=='10'){echo"selected"; }?>>Awam</option>
                  <option value="5" <?php if($row['kepakaran2']=='5'){echo"selected"; }?>>Swasta</option>
                  
              
                  
                 
                </select>
              </div> 
                
                
                </td>
                  <td>
                  <textarea class="form-control pull-right" rows="3" 
                  name ="cttn_kepakaran2" id="cttn_kepakaran2" value =""  placeholder="Catatan....."><?= $row['cttn_kepakaran2']?></textarea>
                 </td>
                  
                  
                </tr>
               
                <tr>
                  
                  <td> 
                  
                 Perakuan kepakaran
                
                
                </td>
                <td> 
                  
                <select name="kepakaran3" id="kepakaran3"
                 class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                 <option value="5" <?php if($row['kepakaran3']=='5'){echo"selected"; }?>>Ya</option>
                  <option value="0" <?php if($row['kepakaran3']=='0'){echo"selected"; }?>>Tidak</option>
                  
                  
                 
                </select>
                
                
                </td>
                
                  <td>
                  <textarea class="form-control pull-right" rows="3" 
                  name ="cttn_kepakaran3" id="cttn_kepakaran3" value =""  placeholder="Catatan....."><?= $row['cttn_kepakaran3']?></textarea>
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                
              </table>
                    </div>
                  </div>
                  </div>


                  <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse21<?= $row['id_surat_masuk']?>">
                        9.Pembatalan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse21<?= $row['id_surat_masuk']?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select name="pembatalan" id="pembatalan"class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="1" <?php if($row['pembatalan']=='1'){echo"selected"; }?>>Jenayah</option>
                  <option value="2" <?php if($row['pembatalan']=='2'){echo"selected"; }?>>Pemalsuan Dokumen/ Fakta</option>
                  <option value="3" <?php if($row['pembatalan']=='3'){echo"selected"; }?>>Kesalahan Undang-undang</option>
                  <option value="4" <?php if($row['pembatalan']=='4'){echo"selected"; }?>>Lain-lain</option>
                 
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                  <textarea class="form-control pull-right" rows="3" 
                  name ="catatan_batal" id="catatan_batal" value =""  placeholder="Catatan....."><?= $row['catatan_batal']?></textarea>
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                
               
                
                
              </table>
                    </div>
                  </div>
                  </div>

                  <!-- <div class="panel box box-success">
                  <div class="box-header with-border">
                  <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse22=id_suratmasuk
                        10.Syor Jawatankuasa Penilai
                      </a>
                    </h4>
                  </div>
                  <div id="collapse22==id_suratmasuk" class="panel-collapse collapse">
                    <div class="box-body">
                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <textarea class="form-control pull-right" rows="3" 
                  name ="catatan_batal" id="catatan_batal" value =""  placeholder="Catatan....."></textarea> 
                
                
                </td>
                
                  <td>
                  
                 </td>
                                   
                  
                </tr>
                
               
                
                
              </table>
                    </div>
                  </div>
                  </div> -->
                  
                  

     

        <!-- =============================== ========================== -->
		<div class="modal-footer">
        
      
                      <?php if($row['id_add']=='2'){ ?>
                
                        <button type="submit" class="btn btn-primary">Kemaskini</button>
                          
                    <?php }else{ ?>

                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <input type="hidden" name="id_surat_masuk" id="id_surat_masuk" value="<?= $row['id_surat_masuk']?>">
                                  
                  <?php }  ?>
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

  
  <!-- /.row -->
</section>
<!-- /.content -->

<?php } ?>

    <!-- /.modal-content -->
  

<!-- /.modal -->
<!-- /.Edit Modal -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    
    <!-- /.col -->


 
  <!-- /.row -->
</section>
<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(700, function()  {
      $(this).remove();
    });
    }, 7000);
</script>


<script type='text/javascript'>
$(window).load(function(){
$(document).ready(function () {
    $('#pilih_senarai').click(function () {
         var checked = $(this).is(':checked');
        
        $('.senarai_id_surat_masuk').each(function () {
            var checkBox = $(this);
            console.debug(checkBox);
            if (checked) {
                checkBox.prop('checked', true);                
            }
            else {
                checkBox.prop('checked', false);                
            }
        });
        
    });
});

});