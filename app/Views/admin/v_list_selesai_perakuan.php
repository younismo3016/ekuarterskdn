<!-- Main content -->

<section class="content">
<form name="carian" action="<?= site_url()?>/admin/list_selesai_perakuan" method="post">
<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Carian Perakuan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
   
        <div class="box-body">
          <div class="row">
    
            <div class="col-md-6">
              
          
              <div class="form-group">
                  <label for="exampleInputEmail1">No Kertas Perakuan</label>
                  <input type="text" class="form-control" name ="no_kertas_perakuan" id="no_kertas_perakuan" placeholder="no_kertas_perakuan">
              </div>

               <!-- <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pemohon</label>
                  <input type="text" class="form-control" name ="nama_pemohon" id="nama_pemohon" placeholder="Nama Pemohon">
              </div>-->
           
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
          <h3 class="box-title">Senarai Selesai Kertas Perakuan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form action="<?php echo url_to('rayuan_baru.download'); ?>" method="POST">
        
        
        </p> 
        </p> 
          
          
          

          <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                    <!-- <table class="table table-bordered">
                    
                <tr>
                  
                  <td>No Surat Rujukan Perakuan<code>*</code></td>
                  
                  <td>
                  <input type="text" class="form-control " required name ="no_kertas_perakuan" id="no_kertas_perakuan" 
                  onChange="javascript:this.value=this.value.toUpperCase();" placeholder="No Surat Rujukan Perakuan">
                 </td>
                  <td>Tarikh Kertas Perakuan<code>*</code></td>
                  <td>

                  <input type="date" class="date_picker form-control" required 
                  id="tarikh_perakuan" name="tarikh_perakuan" 
                  value=""> 

                </td>
                  
                </tr>
                
                
             

                <tr>
                <td>Di Semak Oleh<code>*</code></td>
                  
                  <td>
                  <input type="text" class="form-control " required name ="disemak_oleh" id="disemak_oleh" 
                  onChange="javascript:this.value=this.value.toUpperCase();" placeholder="Di Semak Oleh">
                 </td>
                  <td>Disahkan Oleh<code>*</code></td>
                  <td>

                  <input type="text" class="form-control " required name ="disahkan_oleh" id="disahkan_oleh" 
                  onChange="javascript:this.value=this.value.toUpperCase();" placeholder="Disahkan Oleh">

                </td>
                </tr>
                <tr>
                <td>Yb Menteri<code>*</code></td>
                  
                  <td>
                  <input type="text" class="form-control " required name ="yb_menteri" id="yb_menteri" 
                  onChange="javascript:this.value=this.value.toUpperCase();" placeholder="Yb Menteri">
                 </td>
                  <td>KSU<code>*</code></td>
                  <td>

                  <input type="text" class="form-control " required name ="ksu" id="ksu" 
                  onChange="javascript:this.value=this.value.toUpperCase();" placeholder="KSU">

                </td>
                </tr>
               <div>
                  
      </div>
                   
                	    
                 
                  
                </tr>
                
              </table> -->
              

            </p> 

            

         <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Bil</th>
            <th>No Kertas Perakuan</th>
            <th width="28%">Tarikh Perakuan</th>
            <th width="20%">Status Perkuan</th>
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
            <td width="32%"><?= $row['no_kertas_perakuan'] ?></td>
            <td><?= (!empty($row['tarikh_perakuan'])) ? $row['tarikh_perakuan'] : "-" ?>  </td>
            <td><?= (!empty($row['status_perakuan'])) ? $row['status_perakuan'] : "-" ?></td>
            <td>
                <div class="btn-group">
                    <button title="Syor Penilai" type="button" class="btn btn-primary btn-sm"
                        onclick="window.location.href='<?= site_url()?>/admin/selesai_perakuan/<?= $row['no_kertas_perakuan']?>';">
                        <i class="fa  fa-print"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-kemaskini<?= $row['id_surat_masuk'] ?>">
                          <i class="fa fa-calendar"></i>
                        </button>
                </div>
            </td>
        </tr>
        <?php 
            break; // Exit the loop after the first row
            } 
        ?>
        <?php } else { ?>
        <tr>
            <td colspan="6" align="center">Tiada Maklumat</td>
        </tr>
        <?php } ?>
    </tbody>
</table>

        </div>
		
        </form>	
 

        <?php
        foreach ($surat_masuk as $row) {
        ?>




          <div class="modal fade" id="modal-kemaskini<?= $row['id_surat_masuk'] ?>">






            <div class="modal-dialog ">
              <div class="modal-content">




                <?php echo form_open('Admin/edit_tarikh_perakuan/' . $row['no_kertas_perakuan']); ?>



                <div class="modal-header">

                  <!--  =========================================================================== -->
                  <h4 class="modal-title">Kemaskini Tarikh</h4> </br>
                  <table class="table table-bordered">

                    <tr>

                      <th>NAMA </th>
                      <th>PERANAN </th>
                      <th>TARIKH</th>


                    </tr>
                    <tr>

                      <td><?= (!empty($row['yb_menteri'])) ? $row['yb_menteri'] : "-" ?></td>
                      <td>YB MENTERI</td>
                      <td><input type="date" name="tarikh_menteri" id="tarikh_menteri"
                       value="<?= (!empty($row['tarikh_menteri'])) ? $row['tarikh_menteri'] : "-" ?>"></td>


                    </tr>
                    <tr>
                      

                      <td><?= (!empty($row['ksu'])) ? $row['ksu'] : "-" ?></td>
                      <td>KSU</td>
                      <td><input type="date" name="tarikh_ksu" id="tarikh_ksu"
                       value="<?= (!empty($row['tarikh_ksu'])) ? $row['tarikh_ksu'] : "-" ?>"></td>


                    </tr>
                    <tr>

                      <td><?= (!empty($row['disahkan_oleh'])) ? $row['disahkan_oleh'] : "-" ?></td>
                      <td>PENGESAH</td>
                      <td> <input type="date" name="tarikh_pengesah" id="tarikh_pengesah" 
                      value="<?= (!empty($row['tarikh_pengesah'])) ? $row['tarikh_pengesah'] : "-" ?>"></td>


                    </tr>
                    <tr>

                      <td><?= (!empty($row['disemak_oleh'])) ? $row['disemak_oleh'] : "-" ?></td>
                      <td>PENYEMAK</td>
                      <td><input type="date" name="tarikh_penyemak" id="tarikh_penyemak"
                       value="<?= (!empty($row['tarikh_penyemak'])) ? $row['tarikh_penyemak'] : "-" ?>"></td>


                    </tr>
                    
                   

                  </table>
                  <!--  <span aria-hidden="true">&times;</span></button> -->
                  <!-- <h4 class="modal-title">Tarikh Surat Dalam Tindakan</h4>           -->


                  <!-- <div class="box-group" id="accordion"> -->
                  <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->


                  <!-- <input type="date" data-date-format="yyyy-mm-dd" class="form-control pull-right" id="jim_cantum" name="jim_cantum">



                  
                  </div>
                   -->



                  <!-- =============================== ========================== -->
                  <div class="modal-footer">








                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                    <input id="no_kertas_perakuan" name="no_kertas_perakuan" type="hidden" value="<?= $row['no_kertas_perakuan'] ?>">
                  


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