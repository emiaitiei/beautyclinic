<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit Data Pembayaran</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/pembayaran" class="btn btn-secondary btn-round">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('pembayaran/update/' . $pembayaran['id_pembayaran']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                          <label for="id_booking" class="form-label">Waktu Booking</label>
                          <select name="id_booking" id="id_booking" class="form-control" required>
                            <option value="">-- Pilih --</option>
                              <?php foreach ($bookings as $booking): ?>
                              <option value="<?= $booking['id_booking'] ?>" <?= $pembayaran['id_booking'] == $booking['id_booking'] ? 'selected' : '' ?>>
                                  <?= esc($booking['waktu_booking']) ?>
                              </option>
                              <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Cash" <?= $pembayaran['metode_pembayaran'] == 'Cash' ? 'selected' : '' ?>>Cash</option>
                                <option value="Transfer" <?= $pembayaran['metode_pembayaran'] == 'Transfer' ? 'selected' : '' ?>>Transfer</option>
                                <option value="E-Wallet" <?= $pembayaran['metode_pembayaran'] == 'E-Wallet' ? 'selected' : '' ?>>E-Wallet</option>
                                <option value="Kartu Kredit" <?= $pembayaran['metode_pembayaran'] == 'Kartu Kredit' ? 'selected' : '' ?>>Kartu Kredit</option>
                            </select>
                        </div>

                        <div class="mb-3">
                          <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                          <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" value="<?= $pembayaran['jumlah_bayar'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                          <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" value="<?= $pembayaran['tanggal_bayar'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                            <select name="status_pembayaran" id="status_pembayaran" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Lunas" <?= $pembayaran['status_pembayaran'] == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                                <option value="Belum Lunas" <?= $pembayaran['status_pembayaran'] == 'Belum Lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                                <option value="Dibatalkan" <?= $pembayaran['status_pembayaran'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a href="/pembayaran" class="btn btn-danger">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>