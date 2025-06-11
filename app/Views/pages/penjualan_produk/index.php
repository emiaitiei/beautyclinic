<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Data Penjualan Produk</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="<?= base_url('/penjualan_produk/create') ?>" class="btn btn-primary btn-round">Tambah Data Penjualan Produk</a>
            <?php if (session()->get('level') == "2"): ?>
            <a href="/penjualan_produk/trash" class="btn btn-label-danger btn-round">Riwayat Hapus</a>
            <?php endif; ?>
        </div>
    </div>

  <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="5%" class="text-center">No</th> 
                                <th class="text-center">Nama Pasien</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Tanggal Pembayaran</th>
                                <th class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $ms=1; foreach ($penjualan as $i => $row): ?>
                                  <tr>
                                    <td class="text-center"><?= $ms++ ?></td>
                                    <td class="text-center"><?= esc($row['nama_pasien']) ?></td>
                                    <td class="text-center"><?= esc($row['nama_produk']) ?></td>
                                    <td class="text-center"><?= esc($row['jumlah']) ?></td>
                                    <td class="text-center"><?= esc($row['total_harga']) ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal_pembayaran'])) ?></td>
                                    <td class="text-center">
                                      <a href="<?= base_url('/penjualan_produk/edit/' . $row['id_penjualan']) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="<?= base_url('/penjualan_produk/delete/' . $row['id_penjualan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus Data Penjualan Produk ini?')">
                                        <i class="fas fa-trash"></i>
                                      </a>
                                    </td>
                                  </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function () {
        $("#basic-datatables").DataTable();
    });
</script>
<?= $this->endSection() ?>