<?= $this->extend('layouts/auth') ?>

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
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="card p-4" style="min-width: 400px;">
    <h3 class="text-center mb-4">Lupa Password</h3>

    <form method="post" action="/recovery-password">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Kirim Link</button>
        </div>
    </form>

    <div class="mb-3 text-center">
        <a href="/login">Kembali ke Halaman Masuk</a>
    </div>
</div>
<?= $this->endSection(); ?>