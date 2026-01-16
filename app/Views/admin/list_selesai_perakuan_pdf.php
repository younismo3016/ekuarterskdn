<?php $this->extend('pdf_layout') ?>

<?php $this->section('content') ?>

<!-- 1. load jadual -->

<!-- <//?php //foreach ($surat_masuk as $row){ ?>

<//?php echo view('admin/jadual_kertas_perakuan'); ?>

<//?php } ?> -->

<?php echo view('admin/jadual_selesai_perakuan'); ?>

<!-- 2. load keputusan -->

<?php $this->endSection() ?>