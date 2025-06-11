<?= $this->extend('layouts/auth') ?>

<?= $this->section('style') ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?= $this->endSection() ?>

<?= $this->section('style') ?>
<style>
    body {
      background: #f0f2f5;
      font-family: 'Arial', sans-serif;
    }

    .card {
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .form-label {
      font-weight: bold;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .text-center a {
      color: #007bff;
      text-decoration: none;
      transition: color 0.3s;
    }

    .text-center a:hover {
      color: #0056b3;
    }

    .input-group-text {
      background-color: #007bff;
      color: white;
      border: none;
    }

    .input-group-text i {
      color: white;
    }

    .icon {
      font-size: 1.5rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card p-4" style="min-width: 400px;">
<h3 class="text-center mb-4">Login</h3>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

<form method="post" action="/login">
    <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <div class="input-group">
        <input type="text" name="username" class="form-control" id="username" required>
    </div>
    </div>

    <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <div class="input-group">
        <input type="password" name="password" class="form-control" id="password" required>
    </div>
    </div>

    <div id="recaptcha-wrapper" class="mb-3">
        <div class="g-recaptcha" data-sitekey="<?= esc($recaptcha_sitekey); ?>"></div>
    </div>

    <div id="math-captcha" class="mb-3" style="display: none;">
        <label for="captcha" class="form-label">
            Berapa hasil dari <?= $captcha_a ?> + <?= $captcha_b ?>?
        </label>
        <input id="id-math-captcha" type="number" name="captcha" class="form-control" required>
    </div>

    <div class="d-grid">
    <button type="submit" class="btn btn-primary">Masuk</button>
    </div>
</form>

<div class="mb-3 text-center">
    <a href="/register">Daftar</a> | <a href="/recovery-password">Lupa Password?</a>
</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    window.onload = function () {
        const recaptcha = document.querySelector('#recaptcha-wrapper');
        const mathCaptcha = document.querySelector('#math-captcha');

        fetch('https://www.google.com/recaptcha/api.js', {mode: 'no-cors'})
            .then(() => {
                recaptcha.style.display = 'block';
                mathCaptcha.style.display = 'none';
                document.getElementById("id-math-captcha").required = false;
            })
            .catch(() => {
                recaptcha.style.display = 'none';
                mathCaptcha.style.display = 'block';
                document.getElementById("id-math-captcha").required = true;
            });
    };
</script>
<?= $this->endSection(); ?>