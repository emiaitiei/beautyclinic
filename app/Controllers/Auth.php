<?php

namespace App\Controllers;

use App\Models\LogActivityModel;

class Auth extends BaseController
{
    public function __construct()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/')->send();
            exit;
        }
    }

    public function index()
    {
        $a = rand(1, 10);
        $b = rand(1, 10);

        session()->set('captcha_sum', $a + $b);

        $data = [
            "title" => "Login",
            'recaptcha_sitekey' => getenv('RECAPTCHA_SITEKEY'),
            'captcha_a' => $a,
            'captcha_b' => $b,
        ];

        return view('pages/auth/login', $data);
    }

    public function loginSubmit()
    {
        $userModel = new \App\Models\UserModel();
        $settingModel = new \App\Models\SettingModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $captchaAnswer = $this->request->getPost('captcha');

        $recaptchaValid = false;
        $hasInternet = false;

        if (!empty($recaptchaResponse)) {
            try {
                $secretKey = getenv('RECAPTCHA_SECRET');
                $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
                $response = json_decode($verify);
                if (isset($response->success)) {
                    $recaptchaValid = true;
                    $hasInternet = true;
                }
            } catch (\Exception $e) {
                $hasInternet = false;
            }
        }

        if (!$recaptchaValid && !$hasInternet) {
            $correctAnswer = session()->get('captcha_sum');
            if ((int)$captchaAnswer !== (int)$correctAnswer) {
                return redirect()->back()->with('error', 'Jawaban CAPTCHA salah');
            }
        } elseif (!$recaptchaValid) {
            return redirect()->back()->with('error', 'Verifikasi reCAPTCHA gagal, coba lagi');
        }

        $user = $userModel->where('username', $username)->first();
        $setting = $settingModel->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($user['status']) {
                    session()->set([
                        'id'        => $user['id_user'],
                        'email'     => $user['email'],
                        'nama_user' => $user['nama_user'],
                        'username'  => $user['username'],
                        'level'     => $user['level'],
                        'logo'      => $setting['site_logo'],
                        'logged_in' => true
                    ]);

                    $userId = $user['id_user'];
                    $logModel = new \App\Models\LogActivityModel();
                    $logModel->writeLog($userId, 'Login ke dalam Sistem');

                    return redirect()->to('/');
                } else {
                    return redirect()->back()->with('error', 'Akun Anda tidak aktif');
                }
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function register()
    {
        return view('pages/auth/register', ["title" => "Register"]);
    }

    public function registerSubmit()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Melakukan Register');
        }

        $userModel = new \App\Models\UserModel();

        $userModel->insert([
            'nama_user' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level'     => 5,
            'status'    => 1
        ]);

        return redirect()->to('/login');
    }

    public function recoveryPassword()
    {
        return view('pages/auth/recovery_password', ["title" => "Password Recovery"]);
    }

    public function recoveryPasswordSubmit()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Password berhasil dipulihkan');
        }

        $emailInput = $this->request->getPost('email');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $emailInput)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        $token = bin2hex(random_bytes(16));
        $now = date('Y-m-d H:i:s');

        $db = \Config\Database::connect();
        $builder = $db->table('password_resets');

        $existing = $builder->where('email', $emailInput)->get()->getRow();

        if ($existing) {
            $created = strtotime($existing->created_at);
            if (time() - $created < 600) {
                $token = $existing->token;
            } else {
                $builder->where('email', $emailInput)->update([
                    'token' => $token,
                    'created_at' => $now
                ]);
            }
        } else {
            $builder->insert([
                'email' => $emailInput,
                'token' => $token,
                'created_at' => $now
            ]);
        }

        $resetLink = base_url('change-password?token=' . $token);

        $email = \Config\Services::email();

        $config = [
            'protocol'    => 'smtp',
            'SMTPHost'    => 'smtp.gmail.com',
            'SMTPUser'    => getenv('SMTP_EMAIL'),
            'SMTPPass'    => getenv('SMTP_PASS_APP'),
            'SMTPPort'    => 587,
            'SMTPCrypto'  => 'tls',
            'mailType'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n"
        ];

        $email->initialize($config);

        $email->setFrom('your_email@gmail.com', 'Support Aplikasi');
        $email->setTo($emailInput);
        $email->setSubject('Reset Password Anda');
        $email->setMessage("
            <p>Halo,</p>
            <p>Kami menerima permintaan untuk reset password akun Anda.</p>
            <p><a href='{$resetLink}'>Klik di sini untuk reset password</a></p>
            <p>Link ini hanya berlaku selama 10 menit.</p>
        ");

        if ($email->send()) {
            return redirect()->to('/login')->with('message', 'Link recovery telah dikirim ke email Anda');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email, silakan coba lagi Debug: ' . $email->printDebugger(['headers']));
        }
    }


    public function changePassword()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Password berhasil diganti');
        }

        $token = $this->request->getGet('token');
        $passwordResetModel = new \App\Models\PasswordResetModel();
        $userModel = new \App\Models\UserModel();

        if ($this->request->getMethod() === 'POST') {
            $email = $this->request->getPost('email');
            $newPassword = $this->request->getPost('new_password');

            $userModel->where('email', $email)
                    ->set('password', password_hash($newPassword, PASSWORD_DEFAULT))
                    ->update();

            $passwordResetModel->where('email', $email)->delete();

            return redirect()->to('/login')->with('message', 'Password berhasil diganti');
        }

        $reset = $passwordResetModel->where('token', $token)->first();
        if (!$reset) {
            return redirect()->to('/login')->with('error', 'Token tidak valid');
        }

        $created = strtotime($reset['created_at']);
        if (time() - $created > 600) {
            $passwordResetModel->where('token', $token)->delete();
            return redirect()->to('/login')->with('error', 'Token sudah kadaluarsa');
        }

        return view('pages/auth/change_password', ['email' => $reset['email'], 'token' => $token, 'title' => 'Change Password']);
    }

    public function logout()
    {
        $userId = session()->get('id');

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Logout dari Sistem');
        }

        session()->destroy();

        return redirect()->to('/login')->with('message', 'Logout dari sistem');
    }
}