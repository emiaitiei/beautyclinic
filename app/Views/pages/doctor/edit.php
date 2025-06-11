<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit Data Dokter</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/doctor" class="btn btn-secondary btn-round">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('doctor/update/' . $doctor['id_dokter']) ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                          <label for="nama_dokter" class="form-label">Nama Dokter</label>
                          <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" value="<?= $doctor['nama_dokter'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="spesialisasi" class="form-label">Spesialisasi</label>
                          <input type="text" name="spesialisasi" id="spesialisasi" class="form-control" value="<?= $doctor['spesialisasi'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="no_hp" class="form-label">No HP</label>
                          <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $doctor['no_hp'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="jadwal_praktek" class="form-label">Jadwal Praktek</label>
                          <input type="text" name="jadwal_praktek" id="jadwal_praktek" class="form-control" value="<?= $doctor['jadwal_praktek'] ?>" placeholder="Contoh: Senin - Jumat, 08:00 - 12:00" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/doctor" class="btn btn-danger">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>