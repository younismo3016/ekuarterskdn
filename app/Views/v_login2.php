<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistem eKuarters KDN</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url() ?>assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="bg-login">

  <main>

  <canvas id="marbleCanvas"></canvas>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <!-- <img src="<?= base_url() ?>assets/img/logo.png" alt=""> -->
                  <span class="d-none d-lg-block" style="color: white; font-size: 2.5 em;">Sistem eKuarters KDN</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">
                



                
                
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Log Masuk</h5>
                    <p class="text-center small">Masukan e-mel dan kata laluan</p>
                  </div>

                  
                  <?php echo form_open('auth/check_login');?>
                    <div class="col-12">
                      <label for="email" class="form-label">E-mel</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control"  required>
       
                       
                        <div class="invalid-feedback">Masukkan e-mel anda.</div>
                      </div>
                    </div>
                      &nbsp;
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Kata Laluan</label>
                      
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Masukkan Katalaluan</div>
                    </div>

                    <div class="col-12">
                      &nbsp;
                    </div>
                    <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Log Masuk</button>
                    </div>
                    <div class="col-12">
</p>
                      <p class="small mb-0"><?php
// pesan validation error
                    $errors = session()->getFlashdata('errors'); 
                    if (!empty($errors)) { ?>
                   
                        <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                            <div class="spinner-border text-success" style="width: 20px; height: 20px;"  role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
                        </div> 
                    <?php } ?>
                    <span class="visually-hidden">Loading...</span>
                    <?php 
                    if (session()->getFlashdata('pesan')) {
                        echo '<div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">';
                        echo session()->getFlashdata('pesan');
                        echo '<div class="spinner-border text-success" style="width: 20px; height: 20px;"  role="status">
                <span class="visually-hidden">Loading...</span>
              </div>';
                        echo '</div>';
                    }
                    ?></p>
                    </div>
                    <?php echo form_close(); ?> 

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                <!-- Designed by <strong>BAHAGIAN PENGURUSAN TEKNOLOGI MAKLUMAT</strong> -->
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url() ?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/quill/quill.js"></script>
  <script src="<?= base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>assets/js/main.js"></script>

   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

<!-- Your custom script for auto-dismiss alerts -->
<script>
    // Wait for the DOM to fully load
    document.addEventListener('DOMContentLoaded', function() {
        // Select all elements with the 'auto-dismiss' class
        const alerts = document.querySelectorAll('.auto-dismiss');

        // Set a timeout for each alert to disappear after 5 seconds (5000 ms)
        alerts.forEach(function(alert) {
            setTimeout(function() {
                // Remove the 'show' class to trigger Bootstrap's fade out effect
                alert.classList.remove('show');
            }, 3500); // 5 seconds

            // Remove the element completely after the fade-out effect (optional)
            setTimeout(function() {
                alert.remove();
            }, 3500); // 5.5 seconds (slightly longer to allow fade-out animation to complete)
        });
    });
</script>
<canvas id="marbleCanvas"></canvas>

<script>
  const canvas = document.getElementById('marbleCanvas');
  const ctx = canvas.getContext('2d');

  let particles = [];
  const particleCount = 40; // Jumlah guli
  const connectionDistance = 140; // Jarak garisan muncul
  let mouse = { x: null, y: null };

  // Track pergerakan mouse
  window.addEventListener('mousemove', (e) => {
    mouse.x = e.x;
    mouse.y = e.y;
  });

  function init() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    particles = [];
    
    for (let i = 0; i < particleCount; i++) {
      particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        radius: Math.random() * 12 + 4,
        dx: (Math.random() - 0.5) * 0.8,
        dy: (Math.random() - 0.5) * 0.8,
        opacity: Math.random() * 0.3 + 0.1
      });
    }
  }

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    for (let i = 0; i < particles.length; i++) {
      let p = particles[i];

      // Logik Mouse: Guli akan "lari" sikit bila mouse dekat
      let dxM = mouse.x - p.x;
      let dyM = mouse.y - p.y;
      let distM = Math.sqrt(dxM * dxM + dyM * dyM);
      if (distM < 100) {
        if (mouse.x > p.x) p.x -= 2; else p.x += 2;
        if (mouse.y > p.y) p.y -= 2; else p.y += 2;
      }

      // Lukis Garisan Sambungan
      for (let j = i + 1; j < particles.length; j++) {
        let p2 = particles[j];
        let dx = p.x - p2.x;
        let dy = p.y - p2.y;
        let dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < connectionDistance) {
          ctx.beginPath();
          ctx.strokeStyle = `rgba(255, 255, 255, ${1 - dist/connectionDistance * 0.2})`;
          ctx.lineWidth = 0.6;
          ctx.moveTo(p.x, p.y);
          ctx.lineTo(p2.x, p2.y);
          ctx.stroke();
        }
      }

      // Lukis Biji Guli (Glass Effect)
      let grad = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.radius);
      grad.addColorStop(0, `rgba(255, 255, 255, ${p.opacity + 0.2})`);
      grad.addColorStop(1, `rgba(255, 255, 255, 0)`);

      ctx.beginPath();
      ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
      ctx.fillStyle = grad;
      ctx.fill();

      // Gerakkan guli
      p.x += p.dx;
      p.y += p.dy;

      // Pantulan dinding
      if (p.x > canvas.width || p.x < 0) p.dx *= -1;
      if (p.y > canvas.height || p.y < 0) p.dy *= -1;
    }
    requestAnimationFrame(draw);
  }

  window.addEventListener('resize', init);
  init();
  draw();
</script>

</body>

</html>