<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Pembayaran</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .container {
      width: 90%;
      margin: 0 auto;
      text-align: center;
    }
    .header {
      text-align: center;
      margin-bottom: 30px;
    }
    .header img {
      width: 120px;
      margin-bottom: 10px;
    }
    .header h2, .header h3 {
      margin: 5px 0;
    }
    .report-info {
      text-align: left;
      margin-bottom: 20px;
      font-size: 14px;
    }
    .report-info p {
      margin: 5px 0;
    }
    .signature {
      margin-top: 50px;
      text-align: right;
    }
    .signature p {
      margin: 5px 0;
    }
    table, th, td {
      border-collapse: collapse;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo Perusahaan">
      <h2>Eclat Beauty</h2>
      <h3>Laporan Pembayaran</h3>
    </div>

    <div class="report-info">
      <p><strong>Tanggal Laporan :</strong> <?= date('d F Y'); ?></p>
      <p><strong>Disusun oleh :</strong> Bagian Administrasi Eclat Beauty</p>
    </div>

    <table class="table table-bordered" border="1" width="100%">
      <thead>
        <tr>
          <th width="5%" class="text-center">No</th> 
          <th class="text-center">Waktu Booking</th>
          <th class="text-center">Metode Pembayaran</th>
          <th class="text-center">Jumlah Bayar</th>
          <th class="text-center">Tanggal Bayar</th>
          <th class="text-center">Status Pembayaran</th>
        </tr>
      </thead>
      <tbody>
        <?php $ms=1; foreach ($pembayarans as $pembayaran): ?>
        <tr>
          <td class="text-center"><?= $ms++ ?></td>
          <td class="text-center"><?= date('d-m-Y H:i', strtotime($pembayaran['waktu_booking'])) ?></td>
          <td class="text-center"><?= esc($pembayaran['metode_pembayaran']) ?></td>
          <td class="text-center"><?= esc($pembayaran['jumlah_bayar']) ?></td>
          <td class="text-center"><?= esc($pembayaran['tanggal_bayar']) ?></td>
          <td class="text-center"><?= esc($pembayaran['status_pembayaran']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="signature">
      <p><strong>Mengetahui,</strong></p>
      <p>Admin Eclat Beauty</p>
      <br><br>
      <p><strong>(_______________________)</strong></p>
    </div>
  </div>

</body>
</html>