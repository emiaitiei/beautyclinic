<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Tambah Data Booking</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/booking" class="btn btn-secondary btn-round">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('booking/store') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="id_pasien" class="form-label">Nama Pasien</label>
                            <select name="id_pasien" id="id_pasien" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($pasiens as $pasien): ?>
                                <option value="<?= $pasien['id_pasien'] ?>"><?= esc($pasien['nama_pasien']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_dokter" class="form-label">Nama Dokter</label>
                            <select name="id_dokter" id="id_dokter" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($dokters as $dokter): ?>
                                <option value="<?= $dokter['id_dokter'] ?>"><?= esc($dokter['nama_dokter']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_layanan" class="form-label">Nama Layanan</label>
                            <select name="id_layanan" id="id_layanan" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($layanans as $layanan): ?>
                                <option value="<?= $layanan['id_layanan'] ?>"><?= esc($layanan['nama_layanan']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="waktu_booking" class="form-label">Waktu Booking</label>
                            <input type="datetime-local" name="waktu_booking" id="waktu_booking" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_booking" class="form-label">Status Booking</label>
                            <select name="status_booking" id="status_booking" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Dikonfirmasi">Dikonfirmasi</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea type="text" name="catatan" id="catatan" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/booking" class="btn btn-danger">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>