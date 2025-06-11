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

        .password-requirements {
            font-size: 0.9rem;
            margin-top: 10px;
            color: #555;
        }
    </style>

<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="card p-4" style="min-width: 400px;">
    <h3 class="text-center mb-4">Register</h3>

    <form method="post" action="/register">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <div class="input-group">
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" required oninput="checkPasswordStrength()">
            </div>
            <div id="passwordStrength" class="password-strength mb-3"></div>
            <ul id="passwordRequirements" class="password-requirements" style="display: none;">
                <li>Password harus memiliki minimal 6 karakter.</li>
                <li>Password harus memiliki minimal 1 huruf besar.</li>
                <li>Password harus memiliki minimal 1 angka.</li>
                <li>Password harus memiliki minimal 1 karakter khusus (misalnya: @, #, $, dll).</li>
            </ul>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Daftar</button>
        </div>
    </form>

    <div class="mb-3 text-center">
        <a href="/login">Sudah punya akun? Masuk</a>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script>
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthText = document.getElementById('passwordStrength');
        const submitBtn = document.getElementById('submitBtn');
        const passwordRequirements = document.getElementById('passwordRequirements');
        let strength = '';

        passwordRequirements.style.display = 'block';

        if (password.length < 6) {
            strength = 'Kekuatan Password: Sangat Lemah';
            strengthText.style.color = 'red';
            submitBtn.disabled = true;
        } else if (password.length < 8) {
            strength = 'Kekuatan Password: Lemah';
            strengthText.style.color = 'orange';
            submitBtn.disabled = true;
        } else if (password.match(/[A-Z]/) && password.match(/[0-9]/) && password.match(/[\W_]/)) {
            strength = 'Kekuatan Password: Kuat';
            strengthText.style.color = 'green';
            submitBtn.disabled = false;
        } else {
            strength = 'Kekuatan Password: Sedang';
            strengthText.style.color = 'blue';
            submitBtn.disabled = false;
        }

        strengthText.innerText = strength;
    }
</script>
<?= $this->endSection(); ?>