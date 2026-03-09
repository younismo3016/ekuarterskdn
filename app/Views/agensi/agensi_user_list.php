<link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<main id="main" class="main p-4">
    <div class="pagetitle mb-4">
        <h4 class="fw-bold text-uppercase"><?= $title ?></h4>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('agensi') ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Pengguna</li>
            </ol>
        </nav>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                <div><strong>Berjaya!</strong> <?= session()->getFlashdata('success') ?></div>
            </div>
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
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
                            <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Pengguna
                            </button>

                            <form action="<?= base_url('index.php/agensi/agensi_user_list') ?>" method="get" style="width: 350px;">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control rounded-start-pill border-secondary-subtle shadow-sm" placeholder="Cari..." value="<?= esc($search) ?>">

                                    <?php if (!empty($search)): ?>
                                        <a href="<?= base_url('index.php/agensi/agensi_user_list') ?>" class="btn btn-outline-secondary border-secondary-subtle d-flex align-items-center" title="Reset Carian">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    <?php endif; ?>

                                    <button class="btn btn-primary rounded-end-pill shadow-sm" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary small text-uppercase">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">BIL.</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>NO. TEL</th>
                                        <th class="text-center">TINDAKAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($senarai_user)): ?>
                                        <?php
                                        $no = ($currentPage - 1) * 10 + 1;
                                        foreach ($senarai_user as $user):
                                            // Menggunakan teknik $no yang terbukti berkesan di tempat anda
                                            $cleanID = $no;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no ?>.</td>
                                                <td>
                                                    <div class="fw-bold text-dark"><?= esc($user['nama_penuh']) ?></div>
                                                </td>
                                                <td><?= esc($user['email']) ?></td>
                                                <td><?= esc($user['no_tel'] ?: '-') ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group shadow-sm rounded-3">
                                                        <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#viewModal<?= $cleanID ?>">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editModal<?= $cleanID ?>">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            onclick="confirmReset('<?= $user['id_user'] ?>', '<?= esc($user['email']) ?>')"
                                                            title="Reset Kata Laluan">
                                                            <i class="bi bi-key-fill"></i>
                                                        </button>

                                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                        <script>
                                                            function confirmReset(username, email) {
                                                                Swal.fire({
                                                                    title: 'Reset Kata Laluan?',
                                                                    text: "Satu pautan reset akan dihantar ke emel: " + email,
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#6c757d',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Ya, Hantar Emel',
                                                                    cancelButtonText: 'Batal'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        // Tunjukkan loading semasa proses hantar
                                                                        Swal.fire({
                                                                            title: 'Sila Tunggu',
                                                                            text: 'Sedang menghantar emel reset...',
                                                                            allowOutsideClick: false,
                                                                            didOpen: () => {
                                                                                Swal.showLoading();
                                                                            }
                                                                        });

                                                                        // Redirect ke function controller untuk proses emel
                                                                        // Contoh: agensi/hantar_reset/username
                                                                        window.location.href = "<?= base_url('index.php/agensi/hantar_reset/') ?>" + username;
                                                                    }
                                                                })
                                                            }
                                                        </script>

                                                    </div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="viewModal<?= $cleanID ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                                        <div class="modal-body p-0 text-start">
                                                            <div class="row g-0">
                                                                <div class="col-md-4 bg-info text-white p-5 d-flex flex-column justify-content-center align-items-center text-center">
                                                                    <div class="rounded-circle bg-primary bg-opacity-25 p-4 mb-4 shadow-sm border border-primary border-opacity-25 d-inline-block">
                                                                        <i class="bi bi-person-vcard fs-1 text-primary"></i>
                                                                    </div>
                                                                    <h3 class="fw-bold mb-1">Paparan Maklumat Pengguna</h3>

                                                                </div>

                                                                <div class="col-md-8 p-5 bg-white">
                                                                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                                                        <h4 class="fw-bold text-dark m-0"><i class="bi bi-info-circle me-2 text-info"></i>Maklumat Pengguna</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="row g-4">
                                                                        <div class="col-12">
                                                                            <label class="small text-muted text-uppercase fw-bold"><i class="bi bi-person me-1"></i> Nama Penuh</label>
                                                                            <p class="fs-5 fw-semibold text-dark mb-0 ps-1"><?= esc($user['nama_penuh']) ?></p>
                                                                        </div>
                                                                        <div class="col-sm-6 text-start">
                                                                            <label class="small text-muted text-uppercase fw-bold"><i class="bi bi-envelope me-1"></i> Alamat Emel</label>
                                                                            <p class="text-dark mb-0 ps-1"><?= esc($user['email']) ?></p>
                                                                        </div>
                                                                        <div class="col-sm-6 text-start">
                                                                            <label class="small text-muted text-uppercase fw-bold"><i class="bi bi-telephone me-1"></i> No. Telefon</label>
                                                                            <p class="text-dark mb-0 ps-1"><?= esc($user['no_tel'] ?: 'Tiada Maklumat') ?></p>
                                                                        </div>
                                                                        <div class="col-12 text-start">
                                                                            <label class="small text-muted text-uppercase fw-bold"><i class="bi bi-shield-lock me-1"></i> Peranan / Tahap Akses</label>
                                                                            <p class="text-primary fw-bold mb-0 ps-1">

                                                                                <?php
                                                                                $lvl = $user['level'] ?? '';
                                                                                if ($lvl == 2) echo "PENTADBIR AGENSI";
                                                                                elseif ($lvl == 3) echo "PENGGUNA BIASA";
                                                                                else echo "PENGGUNA";
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-5 d-flex justify-content-end">
                                                                        <button type="button" class="btn btn-light rounded-pill px-5 border shadow-sm" data-bs-dismiss="modal">
                                                                            <i class="bi bi-x-lg me-2"></i>Tutup
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="editModal<?= $cleanID ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                                        <form action="<?= base_url('index.php/agensi/kemaskini/' . $user['id_user']) ?>" method="POST">
                                                            <?= csrf_field() ?>
                                                            <div class="modal-body p-0 text-start">
                                                                <div class="row g-0">
                                                                    <div class="col-md-4 bg-warning text-dark p-5 d-flex flex-column justify-content-center align-items-center text-center">
                                                                        <div class="rounded-circle bg-white bg-opacity-50 p-4 mb-4 shadow-sm border border-dark border-opacity-10">
                                                                            <i class="bi bi-pencil-square fs-1"></i>
                                                                        </div>
                                                                        <h3 class="fw-bold mb-1">Kemaskini</h3>
                                                                        <span class="badge bg-dark text-white rounded-pill px-3 py-2 mt-3 fw-bold">KEMASKINI AKAUN PENGGUNA</span>
                                                                    </div>

                                                                    <div class="col-md-8 p-5 bg-white">
                                                                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                                                            <h4 class="fw-bold text-dark m-0"><i class="bi bi-gear-fill me-2 text-warning"></i>Kemaskini Pengguna</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="row g-4">
                                                                            <div class="col-12 text-start">
                                                                                <label class="form-label fw-semibold text-muted small text-uppercase"><i class="bi bi-person-fill me-1"></i> Nama Penuh</label>
                                                                                <input type="text" name="nama_penuh" class="form-control bg-light border-0 py-2 ps-3" value="<?= esc($user['nama_penuh']) ?>" required>
                                                                            </div>
                                                                            <div class="col-sm-6 text-start">
                                                                                <label class="form-label fw-semibold text-muted small text-uppercase"><i class="bi bi-envelope-fill me-1"></i> Email</label>
                                                                                <input type="email" name="email" class="form-control bg-light border-0 py-2 ps-3" value="<?= esc($user['email']) ?>" required>
                                                                            </div>
                                                                            <div class="col-sm-6 text-start">
                                                                                <label class="form-label fw-semibold text-muted small text-uppercase">
                                                                                    <i class="bi bi-telephone-fill me-1"></i> No. Telefon
                                                                                </label>
                                                                                <input type="text"
                                                                                    name="no_tel"
                                                                                    class="form-control bg-light border-0 py-2 ps-3"
                                                                                    value="<?= esc($user['no_tel']) ?>"
                                                                                    pattern="[0-9]{10,11}"
                                                                                    title="Sila masukkan 10 hingga 11 digit nombor sahaja tanpa sengkang (-)"
                                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                                                    placeholder="Contoh: 0123456789"
                                                                                    required>
                                                                              
                                                                            </div>
                                                                            <div class="col-12 text-start">
                                                                                <label class="form-label fw-semibold text-muted small text-uppercase"><i class="bi bi-diagram-3-fill me-1"></i> Peranan / Tahap Akses</label>
                                                                                <select class="form-select bg-light border-0 py-2 ps-3" name="id_peranan" required>
                                                                                    <?php if (!empty($list_peranan)): ?>
                                                                                        <?php foreach ($list_peranan as $row): ?>
                                                                                            <?php $current_role = $user['id_peranan'] ?? $user['level'] ?? ''; ?>
                                                                                            <option value="<?= $row['id_peranan'] ?>" <?= ($current_role == $row['id_peranan']) ? 'selected' : '' ?>>
                                                                                                <?= strtoupper($row['peranan']) ?>
                                                                                            </option>
                                                                                        <?php endforeach; ?>
                                                                                    <?php endif; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-5 pt-3 d-flex justify-content-end gap-2">
                                                                            <button type="button" class="btn btn-light rounded-pill px-4 border shadow-sm" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-warning rounded-pill px-4 shadow-sm fw-bold">
                                                                                <i class="bi bi-save2 me-2"></i>Simpan Perubahan
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php $no++;
                                        endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center p-5 text-muted">Tiada data dijumpai.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php if ($totalPages > 1): ?>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted small">Halaman <?= $currentPage ?> daripada <?= $totalPages ?></div>
                                <nav>
                                    <ul class="pagination pagination-sm mb-0">
                                        <?php $sq = $search ? '&search=' . $search : ''; ?>
                                        <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= $currentPage - 1 ?><?= $sq ?>">&laquo;</a>
                                        </li>
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?><?= $sq ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= $currentPage + 1 ?><?= $sq ?>">&raquo;</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                    <form action="<?= base_url('index.php/agensi/simpan') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="modal-body p-0">
                            <div class="row g-0">
                                <div class="col-md-4 bg-dark text-white p-5 d-flex flex-column justify-content-center align-items-center text-center">
                                    <div class="rounded-circle bg-white bg-opacity-10 p-4 mb-4">
                                        <i class="bi bi-person-plus-fill fs-1 text-primary"></i>
                                    </div>
                                    <h3 class="fw-bold mb-1">Tambah Pengguna</h3>
                                    <span class="badge bg-primary text-white rounded-pill px-3 py-2 fs-7 mt-3">DAFTAR AKAUN BARU</span>
                                </div>
                                <div class="col-md-8 p-5 bg-white text-start">
                                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                        <h4 class="fw-bold text-dark m-0">Maklumat Pengguna</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <input type="hidden" name="id_agensi_induk" value="<?= session()->get('id_agensi_induk') ?>">
                                    <div class="row g-4 text-start">
                                        <div class="col-12 text-start">
                                            <label class="form-label fw-semibold text-muted small text-uppercase">Nama Penuh</label>
                                            <input type="text" class="form-control bg-light border-0 py-2" name="nama_penuh" placeholder="Nama Penuh Pengguna" required>
                                        </div>
                                        <div class="col-sm-6 text-start">
                                            <label class="form-label fw-semibold text-muted small text-uppercase">Alamat Emel</label>
                                            <input type="email" id="input_email" class="form-control bg-light border-0 py-2" name="email" placeholder="nama@agensi.gov.my" required>
                                            <input type="hidden" name="name_user" id="input_name_user">
                                        </div>
                                        <div class="col-sm-6 text-start">
                                            <label class="form-label fw-semibold text-muted small text-uppercase">
                                                <i class="bi bi-telephone-fill me-1"></i> No. Telefon
                                            </label>
                                            <input type="text"
                                                class="form-control bg-light border-0 py-2"
                                                name="no_tel"
                                                placeholder="Contoh: 0123456789"
                                                pattern="[0-9]{10,11}"
                                                title="Sila masukkan 10 hingga 11 digit nombor sahaja (tanpa sengkang '-')"
                                                required>

                                        </div>
                                        <div class="col-12 text-start">
                                            <label class="form-label fw-semibold text-muted small text-uppercase">Peranan / Tahap Akses</label>
                                            <select class="form-select bg-light border-0 py-2" name="id_peranan" required>
                                                <option value="">-- Pilih Peranan --</option>
                                                <?php if (!empty($list_peranan)): ?>
                                                    <?php foreach ($list_peranan as $row): ?>
                                                        <option value="<?= $row['id_peranan'] ?>"><?= strtoupper($row['peranan']) ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-5 pt-3 d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-light rounded-pill px-4 border" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">Daftar & Hantar Emel</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('input_email');
        const usernameInput = document.getElementById('input_name_user');
        if (emailInput && usernameInput) {
            emailInput.addEventListener('input', function() {
                usernameInput.value = this.value;
            });
        }
    });

    function confirmDelete(id) {
        if (confirm('Adakah anda pasti mahu memadam akaun ini?')) {
            window.location.href = "<?= base_url('index.php/agensi/hapus/') ?>/" + id;
        }
    }
</script>