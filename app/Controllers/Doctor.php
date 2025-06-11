<?php

namespace App\Controllers;

use App\Models\DoctorModel;

use App\Models\LogActivityModel;

class Doctor extends BaseController
{
    protected $doctorModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }
        $this->doctorModel = new DoctorModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Dokter');
        }

        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {

        $doctors = $this->doctorModel->getActiveDoctors();
        return view('pages/doctor/index', ['doctors' => $doctors]);

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
            $logModel->writeLog($userId, 'Mengakses form tambah Data Dokter');
        }

        return view('pages/doctor/create');
    }

    public function store()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Dokter berhasil ditambahkan');
        }

        $data = $this->request->getPost();
        
        if ($this->doctorModel->insert($data)) {
            return redirect()->to('/doctor')->with('message', 'Data Dokter berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan Data Dokter');
        }
    }

    public function edit($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form edit Data Dokter');
        }

        $doctor = $this->doctorModel->find($id);
        
        if (!$doctor) {
            return redirect()->to('/doctor')->with('error', 'Data Dokter tidak ditemukan');
        }

        return view('pages/doctor/edit', ['doctor' => $doctor]);
    }

    public function update($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Dokter berhasil diperbarui');
        }

        $data = $this->request->getPost();
        
        if ($this->doctorModel->update($id, $data)) {
            return redirect()->to('/doctor')->with('message', 'Data Dokter berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui Data Dokter');
        }
    }

    public function delete($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Dokter berhasil dihapus');
        }

        if ($this->doctorModel->update($id, ['in_trash' => 1])) {
            return redirect()->to('/doctor')->with('message', 'Data Dokter berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus Data Dokter');
        }
    }

    public function trash(): string
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Dokter yang dihapus');
        }

        $doctors = $this->doctorModel->getTrashDoctors();
        return view('pages/doctor/trash', ['doctors' => $doctors]);
    }

    public function restore($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Dokter berhasil dipulihkan');
        }

        if ($this->doctorModel->update($id, ['in_trash' => 0])) {
            return redirect()->to('/doctor/trash')->with('message', 'Data Dokter berhasil dipulihkan');
        } else {
            return redirect()->back()->with('error', 'Gagal memulihkan Data Dokter');
        }
    }

    public function deletePermanent($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Dokter berhasil dihapus secara permanen');
        }

        if ($this->doctorModel->delete($id, true)) {
            return redirect()->to('/doctor/trash')->with('message', 'Data Dokter berhasil dihapus secara permanen');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus Data Dokter secara permanen');
        }
    }

    public function empty_trash()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Dokter berhasil dihapus semua');
        }

        if ($this->doctorModel->where('in_trash', 1)->delete()) {
            return redirect()->to('/doctor/trash')->with('message', 'Data Dokter berhasil dihapus semua');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus semua Data Dokter');
        }
    }
}