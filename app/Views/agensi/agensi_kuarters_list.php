<link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">




<main id="main" class="main p-4">
    <div class="pagetitle mb-4">
        <h4 class="fw-bold text-uppercase">Senarai Kuarters</h4>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('agensi') ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai</li>
            </ol>
        </nav>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mt-3">

                            <div>
                                <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambahKuarters">
                                    <i class="bi bi-plus-lg"></i> Tambah Kuarters
                                </button>
                            </div>

                            <form action="<?= base_url('index.php/agensi/agensi_kuarters_list') ?>" method="get" style="width: 300px;">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control rounded-start-pill" placeholder="Cari..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                    <button class="btn btn-outline-secondary rounded-end-pill" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                                        <a href="<?= base_url('index.php/agensi/agensi_kuarters_list') ?>" class="btn btn-outline-danger rounded-pill ms-2">Reset</a>
                                    <?php endif; ?>
                                </div>
                            </form>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>KOD</th>
                                        <th>NAMA KUARTERS</th>
                                        <th>KELAS</th>
                                        <th>TAHUN SIAP</th>
                                        <th class="text-center">TINDAKAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($list_kuarters)): ?>
                                        <?php foreach ($list_kuarters as $data): ?>
                                            <tr>
                                                <td class="fw-bold"><?= $data['kod_kuarters'] ?></td>
                                                <td><?= $data['nama_kuarters'] ?></td>
                                                <td><?= $data['senarai_kelas'] ?></td>
                                                <td><?= $data['tahun_siap'] ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-info text-white"
                                                        data-bs-toggle="modal" data-bs-target="#viewModal<?= $data['id_kuarters'] ?>" title="Lihat">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-warning text-white"
                                                        data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id_kuarters'] ?>" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="viewModal<?= $data['id_kuarters'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                                        <div class="modal-body p-0">
                                                            <div class="row g-0">
                                                                <div class="col-md-4 bg-primary text-white p-5 d-flex flex-column justify-content-center align-items-center text-center">
                                                                    <div class="rounded-circle bg-white bg-opacity-25 p-4 mb-4">
                                                                        <i class="bi bi-building-fill-check fs-1"></i>
                                                                    </div>
                                                                    <h3 class="fw-bold mb-1"><?= $data['nama_kuarters'] ?></h3>
                                                                    <span class="badge bg-white text-primary rounded-pill px-3 py-2 fs-7 mb-4">
                                                                        <?= $data['kod_kuarters'] ?>
                                                                    </span>

                                                                </div>

                                                                <div class="col-md-8 p-5">
                                                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                                                        <h4 class="fw-bold text-dark m-0">Butiran Lengkap</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="row g-4">
                                                                        <div class="col-sm-6">
                                                                            <div class="d-flex align-items-center gap-3 bg-light p-3 rounded-3">
                                                                                <i class="bi bi-calendar-check text-primary fs-3"></i>
                                                                                <div>
                                                                                    <div class="text-muted small">Tahun Siap</div>
                                                                                    <div class="fw-bold fs-5 text-dark"><?= $data['tahun_siap'] ?></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="d-flex align-items-center gap-3 bg-light p-3 rounded-3">
                                                                                <i class="bi bi-map text-primary fs-3"></i>
                                                                                <div>
                                                                                    <div class="text-muted small">Lokasi</div>
                                                                                    <div class="fw-bold text-dark"><?= $data['district_name'] ?>, <?= $data['state_description'] ?></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="bg-light p-3 rounded-3">
                                                                                <div class="d-flex align-items-center gap-3 mb-2">
                                                                                    <i class="bi bi-star-fill text-warning fs-3"></i>
                                                                                    <div class="fw-bold fs-5 text-dark">Kelas Kuarters</div>
                                                                                </div>
                                                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                                                    <?php
                                                                                    $kelas_array = explode(',', $data['senarai_kelas']);
                                                                                    foreach ($kelas_array as $kelas) {
                                                                                        echo '<span class="badge bg-primary text-white rounded-pill px-3 py-2">' . trim($kelas) . '</span>';
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                                                                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="editModal<?= $data['id_kuarters'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                                                        <form action="<?= base_url('index.php/agensi_kuarters/update') ?>" method="POST">
                                                            <?= csrf_field() ?>

                                                            <input type="hidden" name="id_kuarters" value="<?= $data['id_kuarters'] ?>">
                                                            <input type="hidden" name="current_page" value="<?= $currentPage ?>">
                                                            <input type="hidden" name="id_kuarters" value="<?= $data['id_kuarters'] ?>">

                                                            <div class="modal-body p-0">
                                                                <div class="row g-0">
                                                                    <div class="col-md-4 bg-dark text-white p-5 d-flex flex-column justify-content-center align-items-center text-center">
                                                                        <div class="rounded-circle bg-white bg-opacity-10 p-4 mb-4">
                                                                            <i class="bi bi-pencil-square fs-1 text-warning"></i>
                                                                        </div>
                                                                        <h3 class="fw-bold mb-1">Kemaskini Kuarters</h3>
                                                                        <p class="text-white-50 small">Sila kemaskini maklumat di sebelah kanan.</p>

                                                                    </div>

                                                                    <div class="col-md-8 p-5">
                                                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                                                            <h4 class="fw-bold text-dark m-0">Butiran Kuarters</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>

                                                                        <div class="row g-4">
                                                                            <div class="col-sm-6">
                                                                                <label class="form-label fw-semibold text-muted">Kod Kuarters</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text bg-light"><i class="bi bi-upc-scan"></i></span>
                                                                                    <input type="text"
                                                                                        class="form-control fw-bold font-monospace bg-light text-secondary border-secondary-subtle"
                                                                                        style="border-style: dashed; opacity: 0.8; cursor: default;"
                                                                                        name="kod_kuarters"
                                                                                        value="<?= isset($data['kod_kuarters']) ? $data['kod_kuarters'] : '' ?>"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <label class="form-label fw-semibold text-muted">Nama Kuarters</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                                                                    <input type="text" class="form-control" name="nama_kuarters" value="<?= isset($data['nama_kuarters']) ? $data['nama_kuarters'] : '' ?>" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <label class="form-label fw-semibold text-muted">Tahun Siap</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="tahun_siap"
                                                                                        value="<?= isset($data['tahun_siap']) ? $data['tahun_siap'] : '' ?>"
                                                                                        placeholder="Contoh: 2024"
                                                                                        pattern="[0-9]{4}"
                                                                                        title="Sila masukkan 4 angka tahun (Contoh: 2024)"
                                                                                        maxlength="4">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <label class="form-label fw-semibold text-muted">Kelas Kuarters</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text bg-light"><i class="bi bi-star"></i></span>
                                                                                    <select class="form-select tom-select-multiple" name="senarai_kelas[]" multiple placeholder="Pilih Kelas...">
                                                                                        <?php
                                                                                        $selected_classes = isset($data['senarai_kelas']) ? explode(',', str_replace(' ', '', $data['senarai_kelas'])) : [];
                                                                                        if (isset($all_classes)):
                                                                                            foreach ($all_classes as $class): ?>
                                                                                                <option value="<?= $class['kelas'] ?>" <?= in_array($class['kelas'], $selected_classes) ? 'selected' : '' ?>>
                                                                                                    <?= $class['kelas'] ?>
                                                                                                </option>
                                                                                        <?php endforeach;
                                                                                        endif; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <label class="form-label fw-semibold text-muted">Negeri</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                                                                                    <select class="form-select" name="id_negeri" id="stateSelect<?= $data['id_kuarters'] ?>" required>
                                                                                        <option value="">-- Pilih Negeri --</option>
                                                                                        <?php if (isset($states)): ?>
                                                                                            <?php foreach ($states as $state): ?>
                                                                                                <option value="<?= $state['id_adm_state'] ?>" <?= (isset($data['id_negeri']) && $state['id_adm_state'] == $data['id_negeri']) ? 'selected' : '' ?>>
                                                                                                    <?= $state['state_description'] ?>
                                                                                                </option>
                                                                                            <?php endforeach; ?>
                                                                                        <?php endif; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <label class="form-label fw-semibold text-muted">Daerah</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text bg-light"><i class="bi bi-pin-map"></i></span>
                                                                                    <select class="form-select" name="id_daerah" id="districtSelect<?= $data['id_kuarters'] ?>" required>
                                                                                        <option value="">-- Pilih Daerah --</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                                                                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-warning rounded-pill px-4 text-white">
                                                                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                (function() {
                                                    const modalId = 'editModal<?= $data['id_kuarters'] ?>';
                                                    const modalElement = document.getElementById(modalId);

                                                    modalElement.addEventListener('shown.bs.modal', function() {
                                                        const stateSelect = document.getElementById('stateSelect<?= $data['id_kuarters'] ?>');
                                                        const districtSelect = document.getElementById('districtSelect<?= $data['id_kuarters'] ?>');
                                                        const currentDistrictId = '<?= isset($data['id_daerah']) ? $data['id_daerah'] : '' ?>';

                                                        // Initialize Tom Select untuk kelas
                                                        const el = modalElement.querySelector('.tom-select-multiple');
                                                        if (el && !el.tomselect) {
                                                            new TomSelect(el, {
                                                                plugins: ['remove_button'],
                                                                create: true,
                                                                sortField: {
                                                                    field: "text",
                                                                    direction: "asc"
                                                                }
                                                            });
                                                        }

                                                        function loadDistricts(stateId, selectedDistrictId = null) {
                                                            if (stateId) {
                                                                fetch('<?= base_url('index.php/agensi_kuarters/getDistrictsByState') ?>?id_state=' + stateId)
                                                                    .then(response => response.json())
                                                                    .then(data => {
                                                                        districtSelect.innerHTML = '<option value="">-- Pilih Daerah --</option>';
                                                                        data.forEach(district => {
                                                                            let selected = (district.id_adm_district == selectedDistrictId) ? 'selected' : '';
                                                                            districtSelect.innerHTML += `<option value="${district.id_adm_district}" ${selected}>${district.district_name}</option>`;
                                                                        });
                                                                    })
                                                                    .catch(error => console.error('Error:', error));
                                                            } else {
                                                                districtSelect.innerHTML = '<option value="">-- Pilih Daerah --</option>';
                                                            }
                                                        }

                                                        if (stateSelect.value) {
                                                            loadDistricts(stateSelect.value, currentDistrictId);
                                                        }

                                                        stateSelect.addEventListener('change', function() {
                                                            loadDistricts(this.value);
                                                        });
                                                    });
                                                })();
                                            </script>

                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Tiada data dijumpai.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php if ($totalPages > 1): ?>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted">Halaman <?= $currentPage ?> daripada <?= $totalPages ?></div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination mb-0">
                                        <?php
                                        $searchQuery = isset($_GET['search']) ? '&search=' . $_GET['search'] : '';
                                        $range = 2;
                                        $showDots = true;
                                        ?>
                                        <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="<?= base_url('index.php/agensi/agensi_kuarters_list') ?>?page=<?= $currentPage - 1 ?><?= $searchQuery ?>" aria-label="Previous">&laquo;</a>
                                        </li>
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <?php if ($i == 1 || $i == $totalPages || ($i >= $currentPage - $range && $i <= $currentPage + $range)): ?>
                                                <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                                                    <a class="page-link" href="<?= base_url('index.php/agensi/agensi_kuarters_list') ?>?page=<?= $i ?><?= $searchQuery ?>"><?= $i ?></a>
                                                </li>
                                            <?php elseif ($showDots && ($i == $currentPage - $range - 1 || $i == $currentPage + $range + 1)): ?>
                                                <li class="page-item disabled"><a class="page-link">...</a></li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="<?= base_url('index.php/agensi/agensi_kuarters_list') ?>?page=<?= $currentPage + 1 ?><?= $searchQuery ?>" aria-label="Next">&raquo;</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalTambahKuarters" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                    <form action="<?= base_url('index.php/agensi_kuarters/create') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="modal-body p-0">
                            <div class="row g-0">
                                <div class="col-md-4 bg-dark text-white p-5 d-flex flex-column justify-content-center align-items-center text-center">
                                    <div class="rounded-circle bg-white bg-opacity-10 p-4 mb-4">
                                        <i class="bi bi-building-add fs-1 text-primary"></i>
                                    </div>
                                    <h3 class="fw-bold mb-1">Tambah Kuarters</h3>
                                    <p class="text-white-50 small">Sila isi maklumat kuarters baharu di sebelah kanan untuk pendaftaran.</p>
                                    <span class="badge bg-primary text-white rounded-pill px-3 py-2 fs-7 mt-3">
                                        PENDAFTARAN BARU
                                    </span>
                                </div>

                                <div class="col-md-8 p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="fw-bold text-dark m-0">Butiran Kuarters Baharu</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-sm-12">
                                            <label class="form-label fw-semibold text-muted">Nama Kuarters</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                                <input type="text" class="form-control" name="nama_kuarters" placeholder="Nama penuh kuarters" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label fw-semibold text-muted">Tahun Siap</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                                <input type="number" class="form-control" name="tahun_siap" placeholder="Contoh: 2024" min="1900" max="2100">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label fw-semibold text-muted">Kelas Kuarters</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="bi bi-star"></i></span>
                                                <select class="form-select tom-select-multiple" name="senarai_kelas[]" multiple placeholder="Pilih Kelas...">
                                                    <?php if (isset($all_classes)): ?>
                                                        <?php foreach ($all_classes as $class): ?>
                                                            <option value="<?= $class['kelas'] ?>"><?= $class['kelas'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label fw-semibold text-muted">Negeri</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                                                <select class="form-select" name="id_negeri" id="stateSelectTambah" required>
                                                    <option value="">-- Pilih Negeri --</option>
                                                    <?php if (isset($states)): ?>
                                                        <?php foreach ($states as $state): ?>
                                                            <option value="<?= $state['id_adm_state'] ?>">
                                                                <?= $state['state_description'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label fw-semibold text-muted">Daerah</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="bi bi-pin-map"></i></span>
                                                <select class="form-select" name="id_daerah" id="districtSelectTambah" required>
                                                    <option value="">-- Pilih Daerah --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                                            <i class="bi bi-save me-2"></i>Daftar Kuarters
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </section>
</main>



<script>
    (function() {
        // ID modal tambah yang kita tetapkan sebelum ini
        const modalId = 'modalTambahKuarters';
        const modalElement = document.getElementById(modalId);

        if (modalElement) {
            modalElement.addEventListener('shown.bs.modal', function() {


                const selectKelas = modalElement.querySelector('.tom-select-multiple');
                if (selectKelas && !selectKelas.tomselect) {
                    new TomSelect(selectKelas, {
                        plugins: ['remove_button'], // Membolehkan pengguna buang pilihan
                        create: false, // Set 'true' jika nak benarkan pengguna taip kelas baru
                        sortField: {
                            field: "text",
                            direction: "asc"
                        },
                        placeholder: 'Pilih Kelas...'
                    });
                }
                const stateSelect = document.getElementById('stateSelectTambah');
                const districtSelect = document.getElementById('districtSelectTambah');

                // Fungsi untuk memuatkan daerah berdasarkan negeri
                function loadDistricts(stateId) {
                    if (stateId) {
                        districtSelect.innerHTML = '<option value="">Memuatkan...</option>';

                        // PENTING: Gunakan URL controller yang sama seperti edit, 
                        // cuma pastikan parameter ID negeri dihantar betul.
                        fetch('<?= base_url('index.php/agensi_kuarters/getDistrictsByState') ?>?id_state=' + stateId)
                            .then(response => response.json())
                            .then(data => {
                                districtSelect.innerHTML = '<option value="">-- Pilih Daerah --</option>';
                                data.forEach(district => {
                                    districtSelect.innerHTML += `<option value="${district.id_adm_district}">${district.district_name}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                districtSelect.innerHTML = '<option value="">Ralat memuatkan data</option>';
                            });
                    } else {
                        districtSelect.innerHTML = '<option value="">-- Pilih Daerah --</option>';
                    }
                }

                // Event listener bila negeri ditukar
                stateSelect.addEventListener('change', function() {
                    loadDistricts(this.value);
                });
            });
        }
    })();
</script>


<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/js/tom-select.complete.min.js"></script>

