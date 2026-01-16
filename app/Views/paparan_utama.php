<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Laporan Tahunan</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

  <div class="box-body">
    <form name="carian" action="<?= site_url() ?>/home" method="GET">

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Pilih Tahun</label>
            <select id="tahun_keseluruhan" name="tahun_keseluruhan" class="form-control select2" style="width: 100%;">

              
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
			  <option value="2028">2028</option>

            </select>
          </div>

          <button type="submit" class="btn btn-success btn-sm">Cari</button>


        </div>

      </div>

    </form>
    <!-- /.row -->
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <!-- <h3>Laporan Harian


</h3> -->

    <?php
    // Array of color classes
    $colorClasses = ["bg-green", "bg-blue", "bg-red", "bg-yellow", "bg-purple"];

    ?>

    <div class="row">
      <?php
      foreach ($laporan_keseluruhan_result as $row) {
        // Get a random color class for this iteration
        $randomColorClass = $colorClasses[array_rand($colorClasses)];
      ?>
        <div class="col-lg-3 col-xs-8">
          <!-- small box -->
          <div class="small-box <?php echo $randomColorClass; ?>">
            <div class="inner">
              <h3><?php echo $row->mohon; ?></h3>
              <p><?php echo $row->kategori; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-info-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      <?php } ?>

      <!-- tambah sini -->
    </div>
  </div>
</div>


<!-- mula sini     -->




<!-- .endsini -->
<form name="carian" action="<?= site_url() ?>/home" method="GET">

  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Laporan Pendaftaran Mengikut Bulan</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

    <div class="box-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Tahun</label>
            <select id="tahun_bulanan" name="tahun_bulanan" class="form-control select2" style="width: 100%;">
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
			  <option value="2028">2028</option>

            </select>
          </div>


          <button type="submit" class="btn btn-success btn-sm">Cari</button>
        </div>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

      <div class="form-group col-md-7">

        <canvas id="rayuanChart" style="height: 650px;"></canvas>

      </div>
    </div>

  </div>
</form>
<!-- /.row -->