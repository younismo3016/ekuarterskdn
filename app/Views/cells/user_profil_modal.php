<?php if (isset($user) && $user): ?>
<div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalProfilLabel"><i class="bi bi-person-badge me-2"></i>Profil Saya</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="https://ui-avatars.com/api/?name=<?= urlencode($user->nama_penuh) ?>&background=0D6EFD&color=fff" class="rounded-circle mb-3 shadow" width="100">
        <h4 class="mb-0"><?= $user->nama_penuh ?></h4>
        <p class="text-muted small mb-3"><?= $user->email ?></p>
        
        <hr>
        
        <div class="text-start px-3">
            <div class="row mb-2">
                <div class="col-4 text-muted small">No. Telefon</div>
                <div class="col-8">: <?= $user->no_tel ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted small">Agensi </div>
                <div class="col-8">: <?= $user->nama_agensi_induk ?></div>
                
            </div>
              <div class="row mb-2">
                <div class="col-4 text-muted small">Peranan </div>
                <div class="col-8">: <?= $user->peranan ?></div>
                
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>