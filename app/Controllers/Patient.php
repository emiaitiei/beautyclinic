<?php

namespace App\Controllers;

use App\Models\PatientModel;

use App\Models\LogActivityModel;

class Patient extends BaseController
{
    protected $patientModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }
        $this->patientModel = new PatientModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Pasien');
        }

        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3 || session()->get('level')==4) {

        $patientModel = new \App\Models\PatientModel();
        $data['patients'] = $patientModel->where('in_trash', 0)->findAll();
        
        return view('pages/patient/index', $data);

        }else if (session()->get('level')>0){
            return redirect()->to('home/error');
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function create()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form tambah Data Pasien');
        }

        return view('pages/patient/create');
    }

    public function store()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Pasien berhasil ditambahkan');
        }

        $this->patientModel->save([
            'id_user'         => session()->get('id'),
            'nama_pasien'     => $this->request->getPost('nama_pasien'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
            'alamat'          => $this->request->getPost('alamat'),
            'no_hp'           => $this->request->getPost('no_hp'),
            'tanggal_daftar'  => date('Y-m-d'),
            'status'          => 1
        ]);

        return redirect()->to('/patient')->with('message', 'Data Pasien berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form edit Data Pasien');
        }

        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($id);

        if (!$patient) {
            return redirect()->to('/patient')->with('error', 'Data pasien tidak ditemukan');
        }

        return view('pages/patient/edit', [
            'patient' => $patient
        ]);
    }

    public function update($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Pasien berhasil diperbarui');
        }

        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($id);

        if (!$patient) {
            return redirect()->to('/patient')->with('error', 'Data pasien tidak ditemukan');
        }

        $data = [
            'nama_pasien'            => $this->request->getPost('nama_pasien'),
            'jenis_kelamin'          => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir'          => $this->request->getPost('tanggal_lahir'),
            'alamat'                 => $this->request->getPost('alamat'),
            'no_hp'                  => $this->request->getPost('no_hp'),
            'tanggal_daftar'         => $this->request->getPost('tanggal_daftar'),
        ];

        $patientModel->update($id, $data);

        return redirect()->to('/patient')->with('message', 'Data Pasien berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Pasien berhasil dihapus');
        }

        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($id);

        if (!$patient) {
            return redirect()->to('/patient')->with('error', 'Data pasien tidak ditemukan');
        }

        $patientModel->update($id, [
            'in_trash' => 1
        ]);

        return redirect()->to('/patient')->with('message', 'Data Pasien berhasil dihapus');
    }

    public function trash(): string
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Pasien yang dihapus');
        }

        $patientModel = new \App\Models\PatientModel();
        $data['patients'] = $patientModel->where('in_trash', 1)->findAll();

        return view('pages/patient/trash', $data);
    }

    public function restore($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Pasien berhasil dipulihkan');
        }

        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($id);

        if (!$patient || $patient['in_trash'] == 0) {
            return redirect()->to('/patient/trash')->with('error', 'Data Pasien tidak ditemukan atau sudah aktif');
        }

        $patientModel->update($id, ['in_trash' => 0]);

        return redirect()->to('/patient/trash')->with('message', 'Data Pasien berhasil dipulihkan');
    }

    public function deletePermanent($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Pasien berhasil dihapus secara permanen');
        }

        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($id);

        if (!$patient || $patient['in_trash'] == 0) {
            return redirect()->to('/patient/trash')->with('error', 'Data Pasien tidak valid atau belum dihapus secara soft delete');
        }

        $patientModel->delete($id);

        return redirect()->to('/patient/trash')->with('message', 'Data Pasien berhasil dihapus secara permanen');
    }

    public function empty_trash()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Pasien berhasil dihapus semua');
        }

        $patientModel = new \App\Models\PatientModel();

        $patientModel->where('in_trash', 1)->delete();

        return redirect()->to('/patient/trash')->with('message', 'Data Pasien berhasil dihapus semua');
    }

}