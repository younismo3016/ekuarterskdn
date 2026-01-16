
Assalamualaikum w.b.t.

Yun,

Disertakan nota perbincangan bagi perbincangan yang diadakan sebentar tadi untuk tindakan pasukan pembangun dan SME IM. Perbincangan seterusnya dijadualkan pada 29/6/2023 untuk melihat progress pembangunan Modul Surat Maklumbalas (Surat Maklumbalas Sabah, Surat Maklumbalas Tidak Lengkap, Surat Maklumbalas Dalam Tindakan).

Sekian, terima kasih.

Daftar Surat.
<!-- 1. Kategori surat, No.Fail JIM bawa ke hadapan.
2.Tambah Kategori lain2. kalau kategori lain2, dia akan stop smpi page depan sahaja. Tambah colum catatan non mandatory.
3. No IC benar kan text.
4. List Negara Dropdown List by En.Shahery
5. Alamat huruf besar
6. huruf besar semua field.
7. Status tukar ke Status JIM = Tolak, Tolak dan Dilululskan Pas Residen. -->

<!-- Sistem Mata
1. Warganegara.
2. Betulkan labek NO Rujukan Fail ke No Rujukan Fail KDN.
3. Jenis Pass Dropdown List by En.Shahery
4. Umur. 35 Tahun dan keatas.
5. Tempoh menetap. Tambah Catatan.
6. Hubungan kekeluargaan tambah Catatan.
7. Nilai Pelaburan betul kan bidang hartanah & Tambah FD
8. Perakuan Kepakaran, Ya = 5, Tidak = 0.
9. Pembatalan. Tambah Lain-lain dan catatan.
10. Syor Jawatankuasa Penilai masuk ke form. -->

Surat Maklumbalas Tak Lengkap.
1. Tarikh Surat key in. Default Tarikh sebulan tapi boleh ubah.

2/6/23
Assalamualaikum w.b.t.

Yun, disertakan komen untuk pembangunan Sistem Permit Masuk yang dibincangkan pagi tadi untuk tindakan. STK.

1) Login :

<!-- Error message : Log masuk tidak sah. Jangan mention nama field contoh Username & Password. -->

<!-- 2) Delete link New Registration di halaman login. (Belum) -->

<!-- 3) Daftar Surat :

Letak label "Sila masukkan semua maklumat". (Belum)
IC : Validation "Masukkan nombor sahaja" (Belum)
Kategori Surat Dropdown : (Dh masuk dlm db, belum panggil kat form)
Rayuan Baru
Maklumbalas Dalam Tindakan,
Maklumbalas Tidak Lengkap,
Maklumbalas Sabah, -->


<!-- 4) Senarai Surat Rayuan Baru : LIFO (Selesai)
Tambah field Tarikh Daftar Surat, Tarikh Surat.
Keluarkan Senarai Surat yang berkategori Rayuan Baru sahaja.(Belum) -->

<!-- 5) Tempoh Menetap.
Betulkan aturan.
Tambah Label : Tarikh Mula Menetap di Malaysia
Kalendar
Age is : Tukar kepada Tempoh Menetap.
Then baru Dropdown Tempoh Menetap. -->
**Belaja dengan cikgu : AUto select Tempoh Menetap daripada dropdpwn.

<!-- 6) Tempoh Perkahwinan
Tambah Label : Tarikh Kahwin
Kalendar
Age is : Tukar kepada Tempoh Perkahwinan.
Then baru Dropdown Tempoh Perkahwinan. -->
**Belaja dengan cikgu : AUto select Tempoh Perkahwinan daripada dropdpwn.

6) Hubungan Kekeluargaan (Belum)
Tambah Placeholder untuk semua field
Tambah Bilangan anak kandung warganegara(Selesai)
Sume field letak Title sebab placeholder akan hilang bila user type(Selesai)

<!-- 7) Tempoh Pengalaman Kerja Di Malaysia
Tambah Label : Tarikh Mula Bekerja di Malaysia :
Age is : Tukar kepada Tempoh Bekerja di Malaysia.
Betulkan dropdown 1 hingga 10 tahun, Lebih 10 Tahun.
Placeholder : Catatan Pengalaman Bekerja di Malaysia.
Title : Pengalaman Bekerja di Malaysia. -->

<!-- 8) Letak Numbering di setiap kriteria. -->

<!-- 9)Nilai Pelaburan di Malaysia :

Pelaburan Dalam Bidang Perniagaan :
>= 300k, < 600k --- 1 mata
>= 600k, < 900k -- 2 mata
>= 900k, < 1.2j --- 3 mata
>= 1.2j, < 1.5j -- 4 mata
>= 1.5j -- 5 mata

Duit Simpanan :
>= 100k, < 200k --- 1 mata
>= 200k, < 300k -- 2 mata
>= 300k, < 400k -- 3 mata
>= 400k, < 500k -- 4 mata
>= 500k -- 5 mata -->

<!-- 10) Pengiktirafan Kepakaran :
Semua sub-kriteria tambah Catatan. -->

<!-- 11) Asingkan Syor Jawatan Kuasa Penilai.
Form Keputusan dan Syor Jawatankuasa Penilai.
Papar Markah :
Keputusan Lulus/Gagal :
Label Tabel bagi Markah Lulus Minimum Mengikut Jenis Permohonan dan Kategori :
Catatan Syor Jawatan Kuasa Penilai. -->

12) New Form : Papar Maklumat keseluruhan bagi Rayuan Baru yg dah ada keputusan.

Target Khamis Pagi 8/6/2023 Jumpa IM untuk present.<!-- Edit Modal -->

               
<?php 
foreach ($surat_masuk as $row){
?>          
        
<!-- /.content -->
 <!-- ============================= buka modal add===================================== -->
<!-- Edit Modal -->
      
<div class="modal fade" id="modal-add<?= $row['id_surat_masuk']?>">
  <div class="modal-dialog ">
    <div class="modal-content">

      <?php if($row['id_add']=='1'){ ?>

                 <?php echo form_open('Admin/edit_rayuan/'.$row['id_rayuan']);?>	
    
      <?php }else{ ?>

                  <form action="<?= site_url() ?>/Admin/add_surat" method="post" accept-charset="utf-8">
                
      <?php }  ?>

   
      
		
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

                <script>
                      function tempohKahwin() {
                          var userinput = document.getElementById("TK").value;
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
                          return document.getElementById("tempoh_kahwin").innerHTML =  
                                  "Age is: " + age + " years. ";
                          }
                      }
                    </script>

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
                   <input type=date id = TK> 

                        <span id = "message" style="color:red"> </span> 

                    <!-- Choose a date and enter in input field -->
                    <button type="reset" onclick = "tempohKahwin()"> kira tempoh </button>     

                <h5 style="color:32A80F" id="tempoh_kahwin" ></h5>
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


<?php } ?>


untuk tambah controler
kena tambah filter->controller 
kena tambah filter->config


error mesej 

Log masuk tidak sah
 
DAFTAR MASUK
-BUTTON NEXT KEPADA SIMPAN
-LABEL SILA ISI SEMUA MAKLUMAT
 senarai surat baru kat atas
-dropdown kategori surat

buang link new registration

dashboard
jumlah rayuan baru
perakuan yang telah diangkat
baki dalam tindakan

2/6/23
tarikh surat


       
<div class="modal fade" id="modal-add">
  <div class="modal-dialog ">
    <div class="modal-content">
   
    <form action="<?= site_url() ?>/Admin/add_surat" method="post" accept-charset="utf-8">
		
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
          <script>
                      function ageCalculator() {
                          var userinput = document.getElementById("DOB").value;
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
                          return document.getElementById("result").innerHTML =  
                                  "Age is: " + age + " years. ";
                          }
                      }
                    </script>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                      Umurss
                      </a>
                    </h4>
                  </div>
                  <div id="collapse12" class="panel-collapse collapse in">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse13">
                        Kelayakan Akademik
                      </a>
                    </h4>
                  </div>
                  <div id="collapse13" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse14">
                        Kemahiran Bahasa Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse14" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse15">
                        Tempoh Menetap Di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse15" class="panel-collapse collapse">
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

                <script>
                      function tempohKahwin() {
                          var userinput = document.getElementById("TK").value;
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
                          return document.getElementById("tempoh_kahwin").innerHTML =  
                                  "Age is: " + age + " years. ";
                          }
                      }
                    </script>

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse16">
                       Tempoh Perkahwinan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse16" class="panel-collapse collapse">
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
                   <input type=date id = TK> 

                        <span id = "message" style="color:red"> </span> 

                    <!-- Choose a date and enter in input field -->
                    <button type="reset" onclick = "tempohKahwin()"> kira tempoh </button>     

                <h5 style="color:32A80F" id="tempoh_kahwin" ></h5>
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse17">
                        Hubungan Kekeluargaan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse17" class="panel-collapse collapse">
                    <div class="box-body">


                    <table class="table table-bordered">
                    <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Suami Warganegara</option>
                  <option value="">Suami  PR</option>
                 
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text" class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                   
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Isteri Warganegara</option>
                  <option value="">Isteri PR</option>
                  
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text"  class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  
                  <option value="">Ibu kandung Warganegara</option>
                  <option value="">Ibu kandung PR</option>
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text" class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                
                  <option value=""> Bapa kandung Warganegara</option>
                  <option value=""> Bapa kandung PR</option>
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text" class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan anak kandung PR">
                
                
                </td>
                  <td>
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan adik beradik warganegara">
              </div> 
                 </td>
                  
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan adik beradik PR">
                
                
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse18">
                        Tempoh Pengalaman Bekerja di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse18" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse19">
                        Nilai Pelaburan di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse19" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse20">
                        Pengiktirafan Kepakaran
                      </a>
                    </h4>
                  </div>
                  <div id="collapse20" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse21">
                        Pembatalan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse21" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse22">
                        Syor Jawatan Kuasa Penilai
                      </a>
                    </h4>
                  </div>
                  <div id="collapse22" class="panel-collapse collapse">
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




<!-- ============================= buka modal kemaskini===================================== -->

<?php 
foreach ($surat_masuk as $row){
?>
<div class="modal fade" id="modal-kemaskini<?= $row['id_rayuan']?>">
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
                  
                  Calendar
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
                  <option value="">Suami  PR</option>
                 
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text" class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                   
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  <option value="" >Isteri Warganegara</option>
                  <option value="">Isteri PR</option>
                  
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text"  class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                  
                  <option value="">Ibu kandung Warganegara</option>
                  <option value="">Ibu kandung PR</option>
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text" class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <div class="form-group">
                
                <select class="form-control select2" style="width: 100%;">
                <option value="" >-Sila Pilih-</option>
                
                  <option value=""> Bapa kandung Warganegara</option>
                  <option value=""> Bapa kandung PR</option>
              
                </select>
              </div> 
                
                
                </td>
                
                  <td>
                <!-- <label>Bilangan anak</label> -->
                  <input type="text" class="form-control" name ="no_kp_penaja" id="no_kp_penaja">
                 </td>
                 <!-- <script type="text/javascript">

                 </script>	                   -->
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan anak kandung PR">
                
                
                </td>
                  <td>
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan adik beradik warganegara">
              </div> 
                 </td>
                  
                  
                </tr>
                <tr>
                  
                  <td> 
                  
                  <input type="number" class="form-control" name ="no_kp_penaja" id="no_kp_penaja"
                   placeholder="Bilangan adik beradik PR">
                
                
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                        Tempoh Pengalaman Bekerja di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse7" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                        Nilai Pelaburan di Malaysia
                      </a>
                    </h4>
                  </div>
                  <div id="collapse8" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                        Pengiktirafan Kepakaran
                      </a>
                    </h4>
                  </div>
                  <div id="collapse9" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                        Pembatalan
                      </a>
                    </h4>
                  </div>
                  <div id="collapse10" class="panel-collapse collapse">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                        Syor Jawatan Kuasa Penilai
                      </a>
                    </h4>
                  </div>
                  <div id="collapse11" class="panel-collapse collapse">
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


<!-- ============================= tutup modal kemaskini===================================== -->