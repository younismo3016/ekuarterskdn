<h1>Tambah Pemohon</h1>

<?= \Config\Services::validation()->listErrors() ?>

<form action="<?php echo url_to('pemohon.proses_tambah'); ?>" method="POST">


    <div class="mb-3">

        <label for="nama_pemohon">Nama Pemohon:</label>

        <input type="text" value="<?php echo set_value('nama_pemohon'); ?>" name="nama_pemohon" id="nama_pemohon" class="form-control">
        
        <p class="text-danger"><?php echo get_field_error('nama_pemohon','Nama Pemohon'); ?></p>

    </div>

    <div class="mb-3">

        <label for="passport_no">Passport No :</label>

        <input type="text" value="<?php echo set_value('passport_no'); ?>" name="passport_no" id="passport_no" class="form-control">
        
        <p class="text-danger"><?php echo get_field_error('passport_no','Passport No'); ?></p>

    </div>

    <div class="mb-3">

        <label for="alamat">Alamat :</label>

        <input type="text" value="<?php echo set_value('alamat'); ?>" name="alamat" id="alamat" class="form-control">
        
        <p class="text-danger"><?php echo get_field_error('alamat','Alamat'); ?></p>

    </div>

    <div class="mb-3">
        <label for="nama_pemohon">Negeri:</label>

        <select class="form-control" name="negeri" id="negeri">
            <option value="">Pilih Negeri</option>
            <?php foreach ($senarai_state as $state) {?>
                <option value="<?php echo $state['id'];?>"><?php echo $state['name'];?></option>

                <?php } ?>
        </select>

        <p class="text-danger">
            <?php echo get_field_error('negeri', 'Negeri'); ?>
        </p>
    </div>

    <div class="mb-3">
        <label for="nama_pemohon">Daerah:</label>

        <select class="form-control" name="daerah" id="daerah">
            <option value="">Pilih Daerah</option>
        </select>

        <p class="text-danger">
            <?php echo get_field_error('daerah', 'Daerah'); ?>
        </p>
    </div>


    <!-- CONTOH EDIT NEGERI KAT EDIT FORM -->

    <?php $current_negeri_id = 1; ?>

    <div class="mb-3">
        <label for="nama_pemohon">Edit Negeri:</label>

        <select class="form-control" name="edit_negeri" id="edit_negeri">
            <option value="">Pilih Negeri</option>

            <?php foreach ($senarai_state as $state) { ?>
                <option value="<?php echo $state['id']; ?>" <?php if ($current_negeri_id == $state['id']) { echo 'selected'; } ?> ><?php echo $state['name']; ?></option>
            <?php } ?>
        </select>
        
    </div>

    <!-- END CONTOH EDIT NEGERI KAT EDIT FORM -->

    <!-- CONTOH EDIT DAERAH KAT EDIT FORM -->
    
    <div class="mb-3">
        <label for="nama_pemohon">Edit Daerah:</label>

        <select class="form-control" name="edit_daerah" id="edit_daerah">
            <option value="">Pilih Daerah</option>
        </select>
    </div>

    <input type="hidden" name="" id="current_daerah_id" name="current_daerah_id" value="2" >

    <!-- END CONTOH EDIT DAERAH KAT EDIT FORM -->

    <div class="mb-3"></div>
    <div class="mb-3"></div>
    <div class="mb-3"></div>
    <div class="mb-3"></div>

<div class="mt-4">    <button type="submit" class="btn btn-primary">Submit</button></div class="mt-4">

</form>