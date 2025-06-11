<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit Data Layanan</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/service" class="btn btn-secondary btn-round">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('service/update/' . $service['id_layanan']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                          <label for="nama_layanan" class="form-label">Nama Layanan</label>
                          <input type="text" name="nama_layanan" id="nama_layanan" class="form-control" value="<?= $service['nama_layanan'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="deskripsi" class="form-label">Deskripsi</label>
                          <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" value="<?= $service['deskripsi'] ?>" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="durasi" class="form-label">Durasi</label>
                          <input type="time" name="durasi" id="durasi" class="form-control" value="<?= $service['durasi'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="harga" class="form-label">Harga</label>
                          <input type="text" name="harga" id="harga" class="form-control" value="<?= $service['harga'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a href="/service" class="btn btn-danger">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>