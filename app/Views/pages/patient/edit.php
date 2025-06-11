<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit Data Pasien</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/patient" class="btn btn-secondary btn-round">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('patient/update/' . $patient['id_pasien']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                          <label for="nama_pasien" class="form-label">Nama Pasien</label>
                          <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" value="<?= $patient['nama_pasien'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" <?= $patient['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $patient['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                          <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                          <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $patient['tanggal_lahir'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="alamat" class="form-label">Alamat</label>
                          <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $patient['alamat'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="no_hp" class="form-label">No HP</label>
                          <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $patient['no_hp'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                          <input type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control" value="<?= $patient['tanggal_daftar'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/patient" class="btn btn-danger">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>