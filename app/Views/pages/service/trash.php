<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Riwayat Data Layanan yang Dihapus</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0 d-flex">
            <a href="/service" class="btn btn-secondary btn-round">Kembali</a>
            <form action="<?= site_url('service/empty_trash') ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus semua Data Layanan secara permanen?')">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-danger btn-round">Hapus Semua</button>
            </form>
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
                        <table id="trash-datatables" class="display table table-striped table-hover">
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
                                            <form action="<?= site_url('service/restore/' . $service['id_layanan']) ?>" method="post" style="display:inline;">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-success">Pulihkan</button>
                                            </form>
                                            <form action="<?= site_url('service/deletePermanent/' . $service['id_layanan']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus Data Layanan secara permanen?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus Permanen</button>
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