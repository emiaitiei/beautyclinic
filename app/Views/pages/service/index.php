<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Data Layanan</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/service/create" class="btn btn-primary btn-round">Tambah Data Layanan</a>
            <?php if (session()->get('level') == "2"): ?>
                <a href="/service/trash" class="btn btn-label-danger btn-round">Riwayat Hapus</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th> 
                                    <th class="text-center">Nama Layanan</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Durasi</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ms=1; foreach ($services as $service): ?>
                                    <tr>
                                        <td class="text-center"><?= $ms++ ?></td>
                                        <td class="text-center"><?= esc($service['nama_layanan']) ?></td>
                                        <td class="text-center"><?= esc($service['deskripsi']) ?></td>
                                        <td class="text-center"><?= esc($service['durasi']) ?></td>
                                        <td class="text-center"><?= esc($service['harga']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('service/edit/' . $service['id_layanan']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?= site_url('service/delete/' . $service['id_layanan']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus Data Layanan ini?')">
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
        $("#basic-datatables").DataTable();
    });
</script>
<?= $this->endSection() ?>