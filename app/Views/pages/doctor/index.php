<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Data Dokter</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/doctor/create" class="btn btn-primary btn-round">Tambah Data Dokter</a>
            <?php if (session()->get('level') == "2"): ?>
            <a href="/doctor/trash" class="btn btn-label-danger btn-round">Riwayat Hapus</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th class="text-center">Nama Dokter</th>
                                    <th class="text-center">Spesialisasi</th>
                                    <th class="text-center">No HP</th>
                                    <th class="text-center">Jadwal Praktek</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ms=1; foreach ($doctors as $doctor): ?>
                                    <tr>
                                        <td class="text-center"><?= $ms++ ?></td>
                                        <td class="text-center"><?= esc($doctor['nama_dokter']) ?></td>
                                        <td class="text-center"><?= esc($doctor['spesialisasi']) ?></td>
                                        <td class="text-center"><?= esc($doctor['no_hp']) ?></td>
                                        <td class="text-center"><?= esc($doctor['jadwal_praktek']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('doctor/edit/' . $doctor['id_dokter']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?= site_url('doctor/delete/' . $doctor['id_dokter']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus Data Dokter ini?')">
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
        $('#basic-datatables').DataTable();
    });
</script>
<?= $this->endSection() ?>