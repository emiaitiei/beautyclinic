<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/all.min.css'); ?>" />
  <?= $this->renderSection('head') ?>
  <?= $this->renderSection('style') ?>
  </head>
    <body class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <?= $this->renderSection('content') ?>
        <?= $this->renderSection('script') ?>
    </body>
</html>