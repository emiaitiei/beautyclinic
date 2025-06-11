<?php

namespace App\Controllers;

use App\Models\LogActivityModel;

class Setting extends BaseController
{
    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }
    }

    public function index(): string
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Peraturan');
        }

        if (session()->get('level')==1 || session()->get('level')==2) {

        $settingModel = new \App\Models\SettingModel();
        $setting = $settingModel->first();

        return view('pages/setting', ['setting' => $setting]);

        }else if (session()->get('level')>0){
            return redirect()->to('home/error');
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function update()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Peraturan berhasil diperbarui');
        }

        $settingModel = new \App\Models\SettingModel();

        $data = [
            'site_name'        => $this->request->getPost('site_name'),
            'site_description' => $this->request->getPost('site_description'),
        ];

        $logo = $this->request->getFile('site_logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = 'logo_' . time() . '.' . $logo->getExtension();
            $logo->move('assets/upload', $newName);
            $data['site_logo'] = $newName;

            $_SESSION['logo'] = $newName;

            $old = $settingModel->first();
            if ($old && !empty($old['site_logo']) && file_exists('assets/upload/' . $old['site_logo'])) {
                unlink('assets/upload/' . $old['site_logo']);
            }
        }

        if ($settingModel->countAll() == 0) {
            $settingModel->insert($data);
        } else {
            $settingModel->update(1, $data);
        }

        return redirect()->back()->with('message', 'Peraturan berhasil diperbarui');
    }
}