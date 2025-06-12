<?php

namespace App\Controllers;

use App\Models\LogActivityModel;

class LogActivity extends BaseController
{
    protected $logactivityModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }
        $this->logactivityModel = new LogActivityModel();
    }

    public function index()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Log Activity');
        }

        if (session()->get('level') == 2) {

            $logModel = new \App\Models\LogActivityModel();

            $logs = $logModel->paginate(10);
            $pager = $logModel->pager;

            $data = [
                'logactivitys' => $logs,
                'pager' => $pager,
                'index' => 0 
            ];

            return view('pages/log_activity', $data);
            
        } elseif (session()->get('level') > 0) {
            return redirect()->to('home/error');
        } else {
            return redirect()->to('dashboard');
        }
    }
}