<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
    <div>
      <h3 class="fw-bold mb-3">Setting</h3>
    </div>
    </div>

    <div class="row">
        <div>
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>
            <form method="post" action="/setting/update" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="site_name" class="form-label">Nama Website</label>
                    <input type="text" name="site_name" id="site_name" class="form-control" value="<?= $setting['site_name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="site_description" class="form-label">Deskripsi Website</label>
                    <textarea type="text" name="site_description" id="site_description" class="form-control" value="<?= $setting['site_description'] ?>" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="site_logo" class="form-label">Logo Website</label><br>
                    <?php if (!empty($setting['site_logo'])): ?>
                        <img src="<?= base_url('assets/upload/' . $setting['site_logo']) ?>" alt="Logo" style="max-height: 80px;" class="mb-2"><br>
                    <?php endif; ?>
                    <input type="file" name="site_logo" id="site_logo" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>