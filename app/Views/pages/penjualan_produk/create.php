<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Tambah Data Penjualan Produk</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/penjualan_produk" class="btn btn-secondary btn-round">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('penjualan_produk/store') ?>" method="post">
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
                            <label for="id_produk" class="form-label">Nama Produk</label>
                            <select name="id_produk" id="id_produk" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($produks as $produk): ?>
                                <option value="<?= $produk['id_produk'] ?>"><?= esc($produk['nama_produk']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="text" name="total_harga" id="total_harga" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal_pembayaran" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/penjualan_produk" class="btn btn-danger">Batal</a>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const jumlahInput = document.getElementById('jumlah');
        const totalHargaInput = document.getElementById('total_harga');
        const produkSelect = document.getElementById('id_produk');

        function getProductPrice(id_produk) {
            return <?= json_encode($produks); ?>.find(product => product.id_produk == id_produk).harga;
        }

        function updateTotalHarga() {
            const id_produk = produkSelect.value;
            const jumlah = parseInt(jumlahInput.value) || 0;
            const harga = getProductPrice(id_produk);

            if (jumlah > 0 && harga) {
                totalHargaInput.value = (jumlah * harga).toFixed(2);
            } else {
                totalHargaInput.value = '';
            }
        }

        jumlahInput.addEventListener('input', updateTotalHarga);
        produkSelect.addEventListener('change', updateTotalHarga);
    });
</script>
<?= $this->endSection() ?>