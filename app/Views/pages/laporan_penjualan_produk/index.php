<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-3">Laporan Penjualan Produk</h3>
    </div>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">PRINT</h5>
            <form action="<?= base_url('/laporan_penjualan_produk/printlaporanpenjualanproduk') ?>" method="POST">
              <?= csrf_field() ?>

              <div class="mb-3">
                <label for="awal" class="form-label">Tanggal Awal :</label>
                <input type="date" name="awal" id="awal" class="form-control">
              </div>

              <div class="mb-3">
                <label for="akhir" class="form-label">Tanggal Akhir :</label>
                <input type="date" name="akhir" id="akhir" class="form-control">
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-info">
                  <i class="fas fa-print"></i> 
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">PDF</h5>
            <form action="<?= base_url('/laporan_penjualan_produk/pdflaporanpenjualanproduk') ?>" method="POST">
              <?= csrf_field() ?>

              <div class="mb-3">
                <label for="awal" class="form-label">Tanggal Awal :</label>
                <input type="date" name="awal" id="awal" class="form-control">
              </div>

              <div class="mb-3">
                <label for="akhir" class="form-label">Tanggal Akhir :</label>
                <input type="date" name="akhir" id="akhir" class="form-control">
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-danger">
                  <i class="far fa-file-pdf"></i> 
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>

    </div>
  </section>
  <?= $this->endSection() ?>