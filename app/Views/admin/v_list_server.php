<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-tambah">Tambah</button>
      <br><br>
   
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Senarai Server</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Bil</th>
              <th>Nama</th>
              <th>IP</th>
              <th>Level</th>
              <th>Sistem Operasi</th>
              <th width="11%">Aktiviti</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $bil = 1;
            if(isset($server) && !empty($server)) {
            foreach ($server as $row){
            ?>
            <tr>
              <td width="5%"><?= $bil++ ?>.</td>
              <td width="30%"><?= $row['name_server'] ?>
              </td>
              <td><?= (!empty($row['ip_server'])) ? $row['ip_server'] : "-" ?></td>
              <td>
                    <?php if ($row['type_server'] == 1) { ?>
                            LIVE
                    <?php } else if ($row['type_server'] == 2) { ?> 
                            DEV
                    <?php } else { ?> 
                            TRAINING
                    <?php } ?> 
              </td>
              <td><?= (!empty($row['ope_system'])) ? $row['ope_system'] : "-" ?></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-sticky-note-o"></i></button>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?= $row['id_server']?>"><i class="fa fa fa-edit"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?= $row['id_server']?>"><i class="fa fa-trash"></i></button>
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
        <h4 class="modal-title">Tambah Server</h4>
      </div>
      <div class="modal-body">
          
        <div class="form-group">
          <label>Nama Server</label>
          <div >
            <input type="text" class="form-control name_server" placeholder="enter nama server">
          </div>
          <span id="error_name_server" class="text-danger"></span>
        </div>
        <div class="form-group">
          <label>IP Address</label>
          <div >
            <input type="text" class="form-control ip_server" placeholder="enter IP Address">
          </div>
          <span id="error_ip_server" class="text-danger ms-3"></span>
        </div>  
        <div class="form-group">
          <label>Level</label>
          <div >
            <input type="text" class="form-control type_server" placeholder="enter Level Server">
          </div>
          <span id="error_type_server" class="text-danger ms-3"></span>
        </div>
        <div class="form-group">
          <label>Sistem Operasi</label>
          <div >
            <input type="text" class="form-control ope_system" placeholder="enter Sistem Operasi">
          </div>
          <span id="error_ope_system" class="text-danger ms-3"></span>
        </div>      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary ajaxserver-save">Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.Tambah Modal -->


