<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Data Produk</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/product/add" class="btn btn-primary btn-round">Tambah Data Produk</a>
            <?php if (session()->get('level') == "2"): ?>
                <a href="/product/trash" class="btn btn-label-danger btn-round">Riwayat Hapus</a>
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
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ms=1; foreach ($products as $product): ?>
                                    <tr>
                                        <td class="text-center"><?= $ms++ ?></td>
                                        <td class="text-center"><?= esc($product['nama_produk']) ?></td>
                                        <td class="text-center"><?= esc($product['deskripsi']) ?></td>
                                        <td class="text-center"><?= esc($product['harga']) ?></td>
                                        <td class="text-center"><?= esc($product['stok']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('product/edit/' . $product['id_produk']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?= site_url('product/delete/' . $product['id_produk']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus Data Produk ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
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
        $("#basic-datatables").DataTable({});
    });
</script>
<?= $this->endSection() ?>