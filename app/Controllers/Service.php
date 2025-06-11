<?php

namespace App\Controllers;

use App\Models\ServiceModel;

use App\Models\LogActivityModel;

class Service extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Layanan');
        }

        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3 || session()->get('level')==4) {

        $services = $this->serviceModel->getActiveServices();
        return view('pages/service/index', ['services' => $services]);

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
            $logModel->writeLog($userId, 'Mengakses form tambah Data Layanan');
        }

        return view('pages/service/create');
    }

    public function store()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Layanan berhasil ditambahkan');
        }

        $data = [
            'nama_layanan'  => $this->request->getPost('nama_layanan'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'durasi'        => $this->request->getPost('durasi'),
            'harga'         => $this->request->getPost('harga'),
        ];

        $this->serviceModel->save($data);
        return redirect()->to('/service')->with('message', 'Data Layanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form edit Data Layanan');
        }

        $service = $this->serviceModel->find($id);
        if (!$service) {
            return redirect()->to('/service')->with('error', 'Data Layanan tidak ditemukan');
        }

        return view('pages/service/edit', ['service' => $service]);
    }

    public function update($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Layanan berhasil diperbarui');
        }

        $data = [
            'nama_layanan'  => $this->request->getPost('nama_layanan'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'durasi'        => $this->request->getPost('durasi'),
            'harga'         => $this->request->getPost('harga'),
        ];

        $this->serviceModel->update($id, $data);
        return redirect()->to('/service')->with('message', 'Data Layanan berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Layanan berhasil dihapus');
        }

        $service = $this->serviceModel->find($id);
        if ($service) {
            $this->serviceModel->update($id, ['in_trash' => 1]);
            return redirect()->to('/service')->with('message', 'Data Layanan berhasil dihapus');
        }
        return redirect()->to('/service')->with('error', 'Data Layanan tidak ditemukan');
    }

    public function trash(): string
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Layanan yang dihapus');
        }

        $trashedServices = $this->serviceModel->getTrashServices();
        return view('pages/service/trash', ['services' => $trashedServices]);
    }

    public function restore($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Layanan berhasil dipulihkan');
        }

        $service = $this->serviceModel->find($id);
        if ($service) {
            $this->serviceModel->update($id, ['in_trash' => 0]);
            return redirect()->to('/service/trash')->with('message', 'Data Layanan berhasil dipulihkan');
        }
        return redirect()->to('/service/trash')->with('error', 'Data Layanan tidak ditemukan');
    }

    public function deletePermanent($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Layanan berhasil dihapus secara permanen');
        }

        $service = $this->serviceModel->find($id);
        if ($service) {
            $this->serviceModel->delete($id);
            return redirect()->to('/service/trash')->with('message', 'Data Layanan berhasil dihapus secara permanen');
        }
        return redirect()->to('/service/trash')->with('error', 'Data Layanan tidak ditemukan');
    }

    public function empty_trash()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Layanan berhasil dihapus semua');
        }

        $this->serviceModel->where('in_trash', 1)->delete();
        return redirect()->to('/service/trash')->with('message', 'Data Layanan berhasil dihapus semua');
    }
}