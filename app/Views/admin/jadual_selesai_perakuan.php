<style type="text/css">
  @media print {
    #printbtn {
      display: none;
    }

    #kembali {
      display: none;
    }
  }
</style>
<p align="center"><a href="#" align="center" id="donwload-link" onClick="myFunction()"><input id="printbtn" class="btn btn-primary btn-sm" type="submit" value="Cetak"></a></br> </p>
<section>



  <?php if (!empty($surat_masuk)) : ?>
    <?php $firstRow = reset($surat_masuk); // Get the first row 
    ?>



    <body>
      <p>Rujukan Kami&nbsp;:&nbsp;KDN.IM.S.600-<?php echo $firstRow['no_kertas_perakuan']; ?>
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Lampiran A</p>
      <p style="text-align: center;"><img class="center" style="width:5%;" src="<?php echo base_url(); ?>/photo/jata1.png" /></p>
      <p style="text-align: center;"> KERTAS PERAKUAN <br /> RAYUAN PERMIT MASUK</p>
    
      <table>
          <tbody>
            <tr>
              <td width="240">
                <p>KATEGORI:</p>
              </td>
              <td width="459">
                <p><strong>Isteri Kepada Warganegara.</strong></p>

              </td>
              <td width="20">
                <p>&nbsp;</p>
              </td>
            </tr>
            <tr>
              <td width="240">
                <p>SYARAT PERTIMBANGAN:</p>
              </td>
              <td width="459">
                <p><strong>Penilaian berasaskan Sistem Mata dengan markah lulus minimum bagi
                    Permit Masuk adalah 40 markah manakala Pas Residen adalah 30 markah daripada keseluruhan 100 markah.</strong></p>
              </td>
              <td width="20">
                <p>&nbsp;</p>
              </td>
            </tr>
          </tbody>
        </table>
      <table border="1" cellspacing="0" cellpadding="0" align="center" width="755" style="font: 9pt arial, sans-serif;">
        <tr>
          <td width="45" align="center" style="background-color: LightGrey"><br>
            <strong>Bil</strong><strong> </strong>
          </td>
          <td width="86" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Nama / Jantina</strong><strong> </strong></p>
          </td>
          <td width="10" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Ruj. Fail</strong><strong> </strong></p>
          </td>
          <td width="82" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Umur (Tahun) / Agama</strong><strong> </strong></p>
          </td>
          <td width="90" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Warganegara / Jenis Pas</strong><strong> </strong></p>
          </td>
          <td width="65" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Tempoh Tinggal / Kahwin (Tahun)</strong><strong> </strong></p>
          </td>
          <td width="85" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Nama Suami / Kad Pengenalan </strong><strong> </strong></p>
          </td>
          <td width="94" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Bil. Anak / Warganegara</strong><strong> </strong></p>
          </td>
          <td width="56" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Kiraan Mata</strong><strong> </strong></p>
          </td>
          <td width="101" align="center" style="background-color: LightGrey">
            <p align="center"><strong>Catatan</strong><strong> </strong></p>
          </td>
        </tr>
        <?php
        $bil = 1;
        if (isset($surat_masuk) && !empty($surat_masuk)) {
          $row_count = count($surat_masuk);

          foreach ($surat_masuk as $row) {
            if ($bil >= 1 && $bil <= 5) {
        ?>
              <tr>
                <td width="45" align="center"><?= $bil ?>.</td>
                <td width="90" align="center"><?php echo $row['nama_pemohon']; ?> <br>/<?php //echo $row['jantina']; ?></td>
                <td> <?php echo $row['no_ruj_kdn']; ?></td>
                <td width="46" align="center"><?php echo $row['umur_real']; ?>/<?php echo $row['agama']; ?></td>
                <td width="82" align="center"><?php echo $row['warganegara']; ?>/<?php echo get_jenis_pas($row['id_jenis_pas']); ?></td>
                <td width="90" align="center"><?php echo $row['tem_menetap_real']; ?>/<?php echo $row['tem_kahwin_real']; ?></td>
                <td width="65" align="center"><?php echo $row['nama_penaja']; ?>/<?php echo $row['no_kp_penaja']; ?></td>
                <td width="85" align="center"><?php echo $row['hub_keluarga9']; ?></td>
                <td width="94" align="center"><?php echo $row['jumlah_markah']; ?></td>
                <td width="101" align="center"></td>
              </tr>
          <?php
            }
            $bil++;
            if ($bil > 5) {
              // Stop the loop after the 10th row
              break;
            }
          }
        } else {
          ?>
          <tr class="icebreaker">
            <td colspan="6" align="center">Tiada Maklumat</td>
          </tr>
        <?php
        }
        ?>




      </table>
      </p>


      <table style="height: 21px; width: 752px;">
        <tbody>
          </br>

          <tr>
            <td style="width: 727.117px;">Dengan segala hormatnya, YB Menteri adalah dimohon menimbang <strong>rayuan Permit Masuk Bil. 1 - 5 </strong>dan disyorkan supaya <strong>DILULUSKAN PERMIT MASUK </strong>kerana telah memenuhi syarat pertimbangan.</td>
            <td style="width: 11.8833px;">&nbsp;</td>
          </tr>
        </tbody>
      </table>
      </br>
     
      

      <div align="left">

        <table border="0" cellspacing="0" cellpadding="0" width="666">
          <tr>
            <td width="320">
              <p><strong>Disemak oleh:</strong></p>
            </td>
            <td width="346">
              <p><strong>Disahkan oleh:</strong></p>
            </td>
          </tr>
          <tr>
            <td width="320" valign="top">
              
             
              <p><strong>&nbsp;</strong></p>
              <p><strong>(<?php echo $firstRow['disemak_oleh']; ?> )</strong><br>
                <strong>Setiausaha Bahagian</strong><br>
                <strong>Tarikh:</strong>
              </p>
            </td>
            <td width="346" valign="top">
            
           
              <p>&nbsp;</p>
              <p><strong>(<?php echo $firstRow['disahkan_oleh']; ?>)</strong><br>
                <strong>Timbalan Ketua Setiausaha (Dasar dan Kawalan)</strong><br>
                <strong>Tarikh:</strong>
              </p>
            </td>
          </tr>
        </table>


        <br style="page-break-before: always">

        <p>Rujukan Kami&nbsp;:&nbsp;KDN.IM.S.600-<?php echo $firstRow['no_kertas_perakuan']; ?>
          &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Lampiran A</p>
        <p style="text-align: center;"><img class="center" style="width:5%;" src="<?php echo base_url(); ?>/photo/jata1.png" /></p>
        <p style="text-align: center;"> KERTAS PERAKUAN <br /> RAYUAN PERMIT MASUK</p>
       
        <table>
          <tbody>
            <tr>
              <td width="240">
                <p>KATEGORI:</p>
              </td>
              <td width="459">
                <p><strong>Isteri Kepada Warganegara.</strong></p>

              </td>
              <td width="20">
                <p>&nbsp;</p>
              </td>
            </tr>
            <tr>
              <td width="240">
                <p>SYARAT PERTIMBANGAN:</p>
              </td>
              <td width="459">
                <p><strong>Penilaian berasaskan Sistem Mata dengan markah lulus minimum bagi
                    Permit Masuk adalah 40 markah manakala Pas Residen adalah 30 markah daripada keseluruhan 100 markah.</strong></p>
              </td>
              <td width="20">
                <p>&nbsp;</p>
              </td>
            </tr>
          </tbody>
        </table>
        <table border="1" cellspacing="0" cellpadding="0" align="center" width="754" style="font: 9pt arial, sans-serif;">

          <tr>
            <td width="45" align="center" style="background-color: LightGrey"><br>
              <strong>Bil</strong><strong> </strong>
            </td>
            <td width="86" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Nama / Jantina</strong><strong> </strong></p>
            </td>
            <td width="10" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Ruj. Fail</strong><strong> </strong></p>
            </td>
            <td width="82" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Umur (Tahun) / Agama</strong><strong> </strong></p>
            </td>
            <td width="90" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Warganegara / Jenis Pas</strong><strong> </strong></p>
            </td>
            <td width="65" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Tempoh Tinggal / Kahwin (Tahun)</strong><strong> </strong></p>
            </td>
            <td width="85" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Nama Suami / Kad Pengenalan </strong><strong> </strong></p>
            </td>
            <td width="94" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Bil. Anak / Warganegara</strong><strong> </strong></p>
            </td>
            <td width="56" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Kiraan Mata</strong><strong> </strong></p>
            </td>
            <td width="101" align="center" style="background-color: LightGrey">
              <p align="center"><strong>Catatan</strong><strong> </strong></p>
            </td>
          </tr>
          <?php
          $bil = 1;
          if (isset($surat_masuk) && !empty($surat_masuk)) {
            $row_count = count($surat_masuk);

            foreach ($surat_masuk as $row) {
              if ($bil >= 6 && $bil <= 10) {
          ?>

                <tr>
                  <td width="45" align="center"><?= $bil ?>.</td>
                  <td width="90" align="center"><?php echo $row['nama_pemohon']; ?> <br>/<?php echo $row['jantina']; ?></td>
                  <td> <?php echo $row['no_ruj_kdn']; ?></td>
                  <td width="46" align="center"><?php echo $row['umur_real']; ?>/<?php echo $row['agama']; ?></td>
                  <td width="82" align="center"><?php echo $row['warganegara']; ?>/<?php echo get_jenis_pas($row['id_jenis_pas']); ?></td>
                  <td width="90" align="center"><?php echo $row['tem_menetap_real']; ?>/<?php echo $row['tem_kahwin_real']; ?></td>
                  <td width="65" align="center"><?php echo $row['nama_penaja']; ?>/<?php echo $row['no_kp_penaja']; ?></td>
                  <td width="85" align="center"><?php echo $row['hub_keluarga9']; ?></td>
                  <td width="94" align="center"><?php echo $row['jumlah_markah']; ?></td>
                  <td width="101" align="center"></td>
                </tr>
            <?php
              }
              $bil++;
              if ($bil > 10) {
                // Stop the loop after the 10th row
                break;
              }
            }
          } else {
            ?>
            <tr class="icebreaker">
              <td colspan="6" align="center">Tiada Maklumat</td>
            </tr>
          <?php
          }
          ?>

        </table>

      
        </p>





        <table style="height: 21px; width: 752px;">
          <tbody>
            <tr>
              <td style="width: 727.117px;">Dengan segala hormatnya, YB Menteri adalah dimohon menimbang
                <strong>rayuan Permit Masuk Bil. 6 - 10 </strong>dan disyorkan supaya <strong>DILULUSKAN PERMIT MASUK </strong>
                kerana telah memenuhi syarat pertimbangan.
              </td>
              <td style="width: 11.8833px;">&nbsp;</td>
            </tr>
          </tbody>
        </table>
        </br>
        

        <div align="left">




          <table border="0" cellspacing="0" cellpadding="0" width="666">
            <tr>
              <td width="320">
                <p><strong>Disemak oleh:</strong></p>
              </td>
              <td width="346">
                <p><strong>Disahkan oleh:</strong></p>
              </td>
            </tr>
            <tr>
              <td width="320" valign="top">
               
                <p><strong>&nbsp;</strong></p>
                <p><strong>(<?php echo $firstRow['disemak_oleh']; ?>)</strong><br>
                  <strong>Setiausaha Bahagian</strong><br>
                  <strong>Tarikh:</strong>
                </p>
              </td>
              <td width="346" valign="top">
                
                <p>&nbsp;</p>
                <p><strong>(<?php echo $firstRow['disahkan_oleh']; ?>)</strong><br>
                  <strong>Timbalan Ketua Setiausaha (Dasar dan Kawalan)</strong><br>
                  <strong>Tarikh:</strong>
                </p>
              </td>
            </tr>
          </table>


        </div>
        <br style="page-break-before: always">


        <p><strong>KDN.IM.S.600-<?php echo $firstRow['no_kertas_perakuan']; ?></strong></p>
        <p><strong>&nbsp;</strong></p>
        <p align="center"><strong>KERTAS PERAKUAN </strong><br>
          <strong>RAYUAN PERMIT MASUK</strong>
        </p>
        <div align="center">
          <table border="1" cellspacing="0" cellpadding="0" width="665" style="font: 9pt arial, sans-serif;">
            <tr>
              <td width="45" style="background-color: LightGrey">
                <p align="center"><strong>BIL.</strong><strong> </strong></p>
              </td>
              <td width="203" style="background-color: LightGrey">
                <p align="center"><strong>NAMA PEMOHON</strong><strong> </strong></p>
              </td>
              <td width="86" style="background-color: LightGrey">
                <p align="center"><strong>NO. FAIL</strong><strong> </strong></p>
              </td>
              <td width="146" style="background-color: LightGrey">
                <p align="center"><strong>WARGANEGARA</strong><strong> </strong></p>
              </td>
              <td width="75" style="background-color: LightGrey">
                <p align="center"><strong>SISTEM MATA</strong><strong> </strong></p>
              </td>
              <td width="112" style="background-color: LightGrey">
                <p align="center"><strong>ULASAN </strong><strong> </strong><br>
                  <strong>YB MENTERI</strong><strong> </strong>
                </p>
              </td>
            </tr>
            <?php
            $bil = 1;
            if (isset($surat_masuk) && !empty($surat_masuk)) {
              $row_count = count($surat_masuk);

              foreach ($surat_masuk as $row) {
                if ($bil >= 1 && $bil <= 10) {
            ?>
                  <tr>
                    <td width="45"><?= $bil ?>.</td>
                    <td width="203"><?php echo $row['nama_pemohon']; ?></td>
                    <td width="86"><?php echo $row['no_ruj_kdn']; ?></td>
                    <td width="146"><?php echo $row['warganegara']; ?></td>
                    <td width="75"><?php echo $row['jumlah_markah']; ?></td>
                    <td width="112"></td>
                  </tr>

              <?php
                }
                $bil++;
                if ($bil > 10) {
                  // Stop the loop after the 10th row
                  break;
                }
              }
            } else {
              ?>
              <tr>
                <td colspan="6" align="center">Tiada Maklumat</td>
              </tr>
            <?php
            }
            ?>

          </table>
        </div>
        
        <p>Rayuan Permit Masuk seperti di Lampiran 1 rujukan <?php echo $firstRow['no_kertas_perakuan']; ?> telah disahkan dan diperaku <strong>DILULUSKAN </strong>berasaskan sistem mata bagi <strong>kategori Isteri kepada Warganegara </strong>dengan<strong> tahap kelulusan sistem mata bagi Permit Masuk adalah 40 markah manakala Pas Residen adalah 30 markah daripada keseluruhan 100 markah.</strong> Sehubungan itu, rayuan ini diangkat untuk pertimbangan dan keputusan YB Datuk Seri jua.</p>
        <p>Sekian, terima kasih.</p>
        
        <p><strong><?php echo $firstRow['ksu']; ?></strong></p>
        <p>Ketua Setiausaha</p>
        <p>Tarikh :</p>
        

        <p><strong><u>KEPUTUSAN</u></strong></p>
        <p></p>
        <p>Rayuan Permit Masuk seperti disebut di atas adalah;</p>
        <hr />
        
        <table>
          <tbody>
            <tr>
              <td width="85">
                <p><img class="center" style="width:80%;" src="<?php echo base_url(); ?>/photo/box1.png" />
              </td>
              <td width="635">
                <p>&nbsp;<strong>DILULUSKAN</strong></p>
              </td>
            </tr>
            <tr>
              <td width="85">
                <p><img class="center" style="width:80%;" src="<?php echo base_url(); ?>/photo/box1.png" />
              </td>
              <td width="635">
                <p>&nbsp;<strong>DITOLAK</strong></p>
              </td>
            </tr>
            <tr>
              <td width="85">
                <p><img class="center" style="width:80%;" src="<?php echo base_url(); ?>/photo/box1.png" />
              </td>
              <td width="635">
                <p>&nbsp;<strong>LAIN-LAIN KEPUTUSAN</strong></p>
              </td>
            </tr>
          </tbody>
        </table>
       
        <hr />

        <p style="text-align: center;"><strong><?php echo $firstRow['yb_menteri']; ?></strong></p>
        <p style="text-align: center;"><strong>MENTERI DALAM NEGERI</strong></p>
        <p style="text-align: center;">Tarikh :</p>
        <p>&nbsp;</p>
    </body>

    </html>


  <?php else : ?>
    <!-- Handle case when $surat_masuk is empty -->
  <?php endif; ?>




  <script>
    function myFunction() {
      var content = document.documentElement.innerHTML;
      download(content, "kertasPerakuan", "doc")

    }

    function download(content, fileName, fileType) {
      var link = document.getElementById("donwload-link");
      var file = new Blob([content], {
        type: "doc"
      });
      var donwloadFile = fileName + "." + fileType;
      link.href = URL.createObjectURL(file);
      link.download = donwloadFile
    }
  </script>



</section>


<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(700, function() {
      $(this).remove();
    });
  }, 7000);
</script>