<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Edit Data Produk</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/product" class="btn btn-secondary btn-round">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('product/update/' . $product['id_produk']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                          <label for="nama_produk" class="form-label">Nama Produk</label>
                          <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $product['nama_produk'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="deskripsi" class="form-label">Deskripsi</label>
                          <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" value="<?= $product['deskripsi'] ?>" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="harga" class="form-label">Harga</label>
                          <input type="text" name="harga" id="harga" class="form-control" value="<?= $product['harga'] ?>" required>
                        </div>

                        <div class="mb-3">
                          <label for="stok" class="form-label">Stok</label>
                          <input type="number" name="stok" id="stok" class="form-control" value="<?= $product['stok'] ?>" min="1" required>
                        </div>

                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a href="/product" class="btn btn-danger">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>