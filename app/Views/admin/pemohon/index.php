<h2>Senarai</h2>

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success">
        <?php echo session()->getFlashdata('success'); ?>
    </div>

    <?php endif ?>

<a href="<?php echo url_to('pemohon.tambah'); ?>">Tambah Pemohon</a>

<table class="table table-bordered table-striped">
    <thead>
        <th>ID</th>
        <th>NamA</th>
        <th>Passport</th>
        <th>Alamat</th>
        <th>Wargangera</th>
        <th>Kategori</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach($senarai_pemohon as $pemohon_row) { ?>
        <tr>
            <td><?php echo $pemohon_row['id']; ?></td>
            <td><?php echo $pemohon_row['nama_pemohon']; ?></td>
            <td><?php echo $pemohon_row['passport_no']; ?></td>
            <td><?php echo $pemohon_row['alamat']; ?></td>
            <td><?php echo $pemohon_row['created_at']; ?></td>
            <td><?php echo $pemohon_row['updated_at']; ?></td>
            <td>
                <form action="<?php echo "
            Edit |


            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>