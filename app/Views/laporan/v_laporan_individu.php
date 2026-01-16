<!-- Main content -->

<style>
    html{
        background:url('<?= base_url() ?>/photo/jataBig.gif') no-repeat ;

        background-size: 548px 377px 

    }
</style>
<img src="<?= base_url()?>/photo/letterhead.png"/>

<section class="content">

 
  <!-- /.row -->

  <?php 
foreach ($surat_masuk as $row){
?>    
		
		


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
</head>
<body>

<table class="table table-bordered mx-auto" style="max-width: 80%;">
            <tr>
              <td width="276"><strong>Nama Pemohon <br> 
              <a class="pull-left"><?php echo $row->nama_pemohon; ?></a><br>
              </strong></td>
              <td width="279"><strong>Nama Penaja<br> 
              <a class="pull-left"><?php echo $row->nama_penaja; ?></a></br>
              </strong></td>
              <td width="159"><strong>No KP Penaja<br> 
              <a class="pull-left"><?php echo $row->no_kp_penaja; ?></a></strong></td>
              <td width="128"><strong>No Fail Jim<br> 
              <a class="pull-left"><?php echo $row->no_fail_jim; ?></a></strong></td>
            </tr>
            <tr>
              <td width="276"><strong>Perkara Surat <br> 
              <a class="pull-left"><?php echo $row->perkara_surat; ?></a><br>
              </strong></td>
              <td width="279"><strong>Kategori Surat<br> 
              <a class="pull-left"><?php echo get_kategori_surat($row->kategori_surat); ?></a></br>
              </strong></td>
              <td width="159"><strong>Negara Asal<br> 
              <a class="pull-left"><?php echo $row->negara_asal; ?></a></strong></td>
              <td width="128"><strong>Warganegara<br> 
              <a class="pull-left"><?php echo $row->warganegara; ?></a></strong></td>
              
            </tr>
            
            </table>  
            
            
            
            
          
           
              
            
              <table class="table table-bordered" style="max-width: 50%;">
              <tr>
                  
                  <th width="206"><strong>Kategori</strong></th>
                  <th width="128">Markah</th>
                  <th width="264">Kategori</th>
                  <th width="128">  Markah </th>
                
              </tr>
                <tr>
                  
                    <td ><strong>Umur</strong></td>
                    <td style='font-size:130%'><?php echo $row->umur; ?></span></td>
                    <td ><strong>Hubungan Kekeluargaan</strong></td>
                    <td style='font-size:130%'><?php echo $row->mar_hub_kekeluargaan; ?></span></td>
                  </tr>
                <tr>
                 
                    <td><strong>Kelayakan Akademik</strong> </td>
                    <td style='font-size:130%'><?php echo $row->kel_akademik; ?></span>  </td>
                    <td><strong>Tempoh Pengalam Bekerja Di malaysia</strong></td>
                    <td style='font-size:130%'><?php echo $row->tem_pengalaman; ?></span></td>
                  </tr>
                <tr>
                  
                    <td><strong>Kemahiran Bahasa</strong></td>
                    <td style='font-size:130%'><?php echo $row->kem_bahasa; ?></td>
                    <td><strong>Nilai Pelaburan Di malaysia</strong></td>
                    <td style='font-size:130%'><?php echo $row->mar_nilai_pelaburan; ?></td>
                  </tr>
                <tr>
               
                <td><strong>Tempoh Menetap Di Malaysia</strong></td>
                <td style='font-size:130%'><?php echo $row->tem_menetap; ?></td>
                <td><strong>Pengiktirafan Kepakaran</strong></td>
                <td style='font-size:130%'><?php echo $row->mar_kepakaran; ?></td>
                  </tr>
                <tr>
                <td><strong>Tempoh Perkahwinan</strong></td>
                <td style='font-size:130%'><?php echo $row->tem_kahwin; ?></td>
                <td><strong>Syor Jawatankuasa Penilai</strong></td>
                <td style='font-size:130%'><?php echo $row->syor_penilai; ?></td>
                  </tr>
				  </tr>
                <tr>
                <td><strong>Pebatalan</strong></td>
                <td style='font-size:130%'><?php echo $row->catatan_batal; ?></td>
                
                  </tr>
                
                
                
                
                
                
                
              </table>
              </div>

              <table class="table table-bordered mx-auto" style="max-width: 50%;">
              <tr>
                  
                  <th width="131" ><strong>MARKAH AKHIR</strong></th>
                    <td width="39" style='font-size:130%'><strong><?php echo $row->jumlah_markah; ?></strong></td>
                    <td width="38"> 
                       </td>
                  
                 
                    
                  </tr>
                <tr>
                  
                <th ><strong>KEPUTUSAN</strong></th>
                  <td style='font-size:130%'><strong><?php echo $row->keputusan; ?></strong></td>
                  <td><strong><?php echo $row->cat_pas; ?></strong></td>
                
                  </tr>
             
              
                  
                 
               
              
                </table>
               
                
                









          

              
              
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </body>
</html>
        <!-- /.col -->
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

      
    <!-- Content Header (Page header) -->
   
 


            




            
		
		
 



     

        <!-- =============================== ========================== -->
		
             
            <tr>
             <td colspan="3" align="center">--<em>Tiada tanda tangan  diperlukan kerana surat adalah dari cetakan berkomputer--</em></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
              <tr>

            
        <?php } ?> 




              <td colspan="3"><style type="text/css">
@media print {
    #printbtn {
        display :  none;
    }
	#kembali {
        display :  none;
    }
}
</style>
<form id="checkout-form" class="smart-form" action="" method="post" name="myForm"  onSubmit="return validateForm()">
<input id ="printbtn" type="submit" value="Cetak" onclick="window.print();"  >
<input id= "id_user" name="id_user" type="hidden" value="">
 


 
 <input id ="kembali" type="button" value="Kembali" 
 onclick="window.location.href='<?= site_url()?>/admin/list_dalam_tindakan/';"></td>
              <td>&nbsp;</td>
            </tr>
           <tr>
              <td colspan="3">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          
          </form>
  





 </section>

 
 <script>
    window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(700, function()  {
      $(this).remove();
    });
    }, 7000);
</script>

   