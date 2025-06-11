<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Data Pasien</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/patient/create" class="btn btn-primary btn-round">Tambah Data Pasien</a>
            <?php if (session()->get('level') == "2"): ?>
            <a href="/patient/trash" class="btn btn-label-danger btn-round">Riwayat Hapus</a>
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
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">No HP</th>
                                    <th class="text-center">Tanggal Daftar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $ms=1; foreach ($patients as $patient): ?>
                                    <tr>
                                        <td class="text-center"><?= $ms++ ?></td>
                                        <td class="text-center"><?= esc($patient['nama_pasien']) ?></td>
                                        <td class="text-center"><?= esc($patient['jenis_kelamin']) ?></td>
                                        <td class="text-center"><?= esc($patient['tanggal_lahir']) ?></td>
                                        <td class="text-center"><?= esc($patient['alamat']) ?></td>
                                        <td class="text-center"><?= esc($patient['no_hp']) ?></td>
                                        <td class="text-center"><?= esc($patient['tanggal_daftar']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('patient/edit/' . $patient['id_pasien']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?= site_url('patient/delete/' . $patient['id_pasien']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus Data Pasien ini?')">
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