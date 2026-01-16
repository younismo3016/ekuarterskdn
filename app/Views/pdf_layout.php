
<!doctype html>
<html lang="en">
  <head>
    <!-- we use BS3 css because its most compatible with DomPDF -->
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('bootstrap3.min.css'); ?>">
  </head>
  <body>
    <div class="container-fluid">
      <?= $this->renderSection('content') ?></div>
    </div>
  </body>
</html>



