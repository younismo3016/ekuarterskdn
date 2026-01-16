<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-tambah">Tambah</button>
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
          <h3 class="box-title">Senarai Penyemak</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Bil</th>
              <th>Nama</th>
              <th width="11%">Aktiviti</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $bil = 1;
            if(isset($penyemak) && !empty($penyemak)) {
            foreach ($penyemak as $row){
            ?>
            <tr>
              <td width="5%"><?= $bil++ ?>.</td>
              <td width="30%"><?= $row['name_penyemak'] ?></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-sticky-note-o"></i></button>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?= $row['id_penyemak']?>"><i class="fa fa fa-edit"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?= $row['id_penyemak']?>"><i class="fa fa-trash"></i></button>
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
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<!-- Tambah Modal -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Pengguna</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('Admin/add_penyemak');?>
          
        <div class="form-group">
          <label>Nama</label>
          <div >
            <input type="text" class="form-control" name="name_penyemak" placeholder="nama" onChange="javascript:this.value=this.value.toUpperCase();">
          </div>
        </div>
            
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
    <?php echo form_close(); ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.Tambah Modal -->

<!-- Modal Delete -->
<?php 
foreach ($penyemak as $row){
?>
<div class="modal fade" id="modal-delete<?= $row['id_penyemak']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= $row['name_penyemak']?></h4>
      </div>
      <div class="modal-body">
        <p>Adakah anda mahu ingin hapus data ini&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <a <a href="<?= site_url('Admin/hapus_user/'.$row['id_penyemak'])?>" class="btn btn-danger">Delete</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<!-- /.modal -->
<!-- /.Modal Delete -->

<!-- Edit Modal -->
<?php 
foreach ($penyemak as $row){
?>
<div class="modal fade" id="modal-edit<?= $row['id_penyemak']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Kemaskini Pengguna</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('Admin/edit_penyemak/'.$row['id_penyemak']);?>
          
        <div class="form-group">
          <label>Nama</label>
          <div >
            <input type="text" class="form-control" name="name_penyemak" value="<?= $row['name_penyemak']?>" placeholder="nama" onChange="javascript:this.value=this.value.toUpperCase();">
          </div>
        </div>
        <!-- <div class="form-group">
          <label>email</label>
          <div >
            <input type="text" class="form-control" name="email" value="" placeholder="emel">
          </div>
        </div>  
        <div class="form-group">
          <label>No HP</label>
          <div >
            <input type="text" class="form-control" name="no_hp" value="" placeholder="No HP">
          </div>
        </div>
        <div class="form-group">
          <label>Level</label>
          <div >
            <input type="text" class="form-control" name="level" value="" placeholder="Level">
          </div>
        </div> 
        <div class="form-group">
          <label>Password</label>
          <div >
            <input type="text" class="form-control" name="password" value="" placeholder="password">
          </div>
        </div>   -->   
      </div> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
    <?php echo form_close(); ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<!-- /.modal -->
<!-- /.Edit Modal -->

<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function()  {
      $(this).remove();
    });
    }, 3000);
</script>