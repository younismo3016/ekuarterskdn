
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>KEMENTERIAN DALAM NEGERI</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <strong>BAHAGIAN PENGURUSAN TEKNOLOGI MAKLUMAT</strong>
    </div>
  </footer>
  
  
  

<!-- jQuery -->




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
  <!-- JS Select2 -->
   

   
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
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Automatically show the dropdown
    let dropdown = new bootstrap.Dropdown(document.getElementById('notificationToggle'));
    dropdown.show();

    // Hide the dropdown after 3 seconds
    setTimeout(function () {
      dropdown.hide();
    }, 3000);
  });
</script>

<script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/js/select2.min.js"></script>




<script>
  $(document).ready(function() {
    $('.select2').each(function() {
      // Check if inside modal
      var $this = $(this);
      var $modal = $this.closest('.modal');

      if ($modal.length) {
        $this.select2({
          dropdownParent: $modal
        });
      } else {
        $this.select2();
      }
    });
  });
</script>
<style>
  /* Betulkan saiz select2 dalam form-floating */
  .form-floating .select2-container--default .select2-selection--single {
    height: 58px !important; /* sama macam form-select */
    padding: 1.0rem 0.75rem !important;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
    top: 10px !important;
    right: 10px;
  }

  /* Pastikan select2 penuh lebar */
  .select2-container {
    width: 100% !important;
  }
</style>
<script>
    $(document).ready(function() {
        $('#searchDropdown').select2({
           
            allowClear: true,
            width: '100%' // penting supaya saiz ngam dengan bootstrap
        });
    });
  </script>

  <script>
    $(document).ready(function() {
        $('#searchDropdown1').select2({
           
            allowClear: true,
            width: '100%' // penting supaya saiz ngam dengan bootstrap
        });
    });
  </script>
  

 





</body>

<script>
function printModalContent(modalId) {
  const modal = document.getElementById(modalId);
  const content = modal.querySelector('.modal-body').innerHTML;

  const win = window.open('', '', 'height=1000,width=800');
  win.document.write('<html><head><title>Cetak Permohonan CR</title>');
  win.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
  win.document.write('<style>');
  win.document.write('body { font-family: Arial, sans-serif; padding: 40px; }');
  win.document.write('.header { text-align: center; margin-bottom: 30px; }');
  win.document.write('.logo { width: 80px; height: auto; margin-bottom: 10px; }');
  win.document.write('h5 { font-weight: bold; margin-bottom: 20px; }');
  win.document.write('p { margin-bottom: 6px; }');
  win.document.write('hr { margin: 20px 0; }');
  win.document.write('</style>');
  win.document.write('</head><body>');

  win.document.write('<div class="header">');
  win.document.write('<img src="https://etemujanji.moha.gov.my/assets/dist/img/KDNLogo.png" class="logo" alt="Jata Negara">');
  win.document.write('<h5>Permohonan CR </h5>');
  win.document.write('<p>Kementerian Dalam Negeri</p>');
  win.document.write('<hr>');
  win.document.write('</div>');

  win.document.write('<div>');
  win.document.write(content);
  win.document.write('</div>');

  win.document.write('</body></html>');
  win.document.close();

  // Tunggu gambar siap load sebelum print
  win.onload = function() {
    const img = win.document.querySelector('.logo');
    if (img.complete) {
      win.focus();
      win.print();
      win.close();
    } else {
      img.onload = function() {
        win.focus();
        win.print();
        win.close();
      };
      img.onerror = function() {
        // Kalau gambar gagal load, terus print juga
        win.focus();
        win.print();
        win.close();
      };
    }
  };
}


</script>
<script>
$(document).ready(function() {
    $('#id_agensi_induk').on('change', function() {
        var agensiId = $(this).val();

        if(agensiId) {
            $.ajax({
                url: '<?= site_url("admin/get_sub_agensi") ?>', // endpoint untuk fetch sub agensi
                type: 'POST',
                data: { id_agensi_induk: agensiId },
                dataType: 'json',
                success: function(data) {
                    $('#id_sub_agensi').empty();
                    $('#id_sub_agensi').append('<option value="">--sila pilih--</option>');

                    $.each(data, function(key, value) {
                        $('#id_sub_agensi').append('<option value="'+ value.id_sub_agensi +'">'+ value.nama_sub_agensi +'</option>');
                    });

                    $('#id_sub_agensi').trigger('change'); // update select2 jika guna
                }
            });
        } else {
            $('#id_sub_agensi').empty();
            $('#id_sub_agensi').append('<option value="">--sila pilih--</option>');
        }
    });
});

</script>

</html>
