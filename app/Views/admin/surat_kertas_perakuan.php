
        
        <h3 text-align: center;>Kertas Perakuan Permit Masuk</h3>

<h4>KATEGORI: </h4>

<h4>SYARAT PERTIMBANGAN: Penilaian berasaskan Sistem Mata dengan markah lulus minimum bagi Permit Masuk adalah 40 markah manakalh Pas Residen adalah 30 markah
    daripada keseluruhan 100 markah </h4>
        
<div>
<font size="-3" face="Arial" >
<style>
    .page-break {
        page-break-before: always;
    }

    
    
</style>

<table class="table table-bordered" width="100%">
    <thead>
        <th style="background-color: Grey">Bil</th>
        <th style="background-color: LightGrey">Nama/Jantina</th>
        <th style="background-color: LightGrey">Rujukan fail</th>
        <th style="background-color: LightGrey">Umur </br>/Agama</th>
        <th style="background-color: LightGrey">Warganegara</br>/Jenis Pas</th>
        <th style="background-color: LightGrey">Tempoh Tinggal</br> /kahwin</th>
        <th style="background-color: LightGrey">Nama Suami</br>/No K/P</th>
        <th style="background-color: LightGrey">Bil Anak</br>/No K/P</th>
        <th style="background-color: LightGrey">Kiraan Mata</th>
        <th style="background-color: LightGrey">Catatan</th>
    </thead>
    <tbody>
        <?php 
        $bil = 1;
        if (isset($surat_masuk) && !empty($surat_masuk)) {
            $row_count = count($surat_masuk);
            $break_after = 3; // Break after the 5th row

            foreach ($surat_masuk as $row) {
                ?>
                <tr class="icebreaker">
                    <td style="background-color: LightGrey" width="5%"><?= $bil++ ?>.</td>
                    <td><?php echo $row['nama_pemohon']; ?></td>
                    <td><?php echo $row['umur']; ?></td>
                    <td><?php //echo $row['warganegara']; ?>Malaysia</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <!-- <style type="text/css">
                            textarea.test {
                                width: 100%;
                                height: 100%;
                                border-color: Transparent;
                            }
                        </style>
                        <textarea class="test" rows="2" 
                                  name="cttn_syor_penilai" id="cttn_syor_penilai" disabled
                                  value="" 
                                  placeholder="Catatan Penilai" style="width:100px; height: 105px;">
                        </textarea> -->
                    </td>
                </tr>
                <tr>
               
                </tr>
              
                <?php

                if ($bil == 4) {
                    // Add a page break after the 5th row
                    echo '<tr class="page-break"><td colspan="10"> </td></tr>';

                    // Continue the table header after the page break
                    
                }

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
    </tbody>
 
</table>               

        
        </font>
        <div>


        </div>
      </br>
      </br>
      </br>
        <footer>
  <p>Dengan segala hormatnya, YB Menter adalah dimohon menimbang  rayuan Permit Masuk Bil. </br>1
6-10 dan disyorkan supaya DILULUSKAN PERMIT MASUK kerana memenuhi sayrat-syarat </p>
  <p></p>
</footer> 
<!-- <div style="page-break-after: always;"></div> -->

<style type="text/css">
  .ice tr:nth-child(2) {
    page-break-inside: avoid;
  }
</style>
           