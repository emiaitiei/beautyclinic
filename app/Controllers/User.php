<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Models\LogActivityModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data User');
        }

        if (session()->get('level')==1 || session()->get('level')==2) {

            $users = $this->userModel->where('in_trash', 0)->findAll();
            return view('pages/user/index', ['users' => $users]);

        }else if (session()->get('level')>0){
            return redirect()->to('home/error');
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function reset_user($id)
    {
        $session = session();
        $userId = $session->get('id');  

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $logModel = new LogActivityModel();
        $logModel->writeLog($userId, "Reset Password User dengan ID $id");

        $userModel = new UserModel();

        $newPassword = password_hash('1111', PASSWORD_DEFAULT);

        $updated = $userModel->update($id, ['password' => $newPassword]);

        if ($updated) {
            $session->setFlashdata('message', 'Password user berhasil direset ke "1111"');
        } else {
            $session->setFlashdata('error', 'Gagal mereset password user');
        }

        return redirect()->to('/pages/user/index');
    }
}