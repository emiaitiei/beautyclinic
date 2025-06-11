<?php

namespace App\Controllers;

use App\Models\PembayaranModel;

use App\Models\BookingModel;

use App\Models\LogActivityModel;

class Pembayaran extends BaseController
{
    protected $pembayaranModel;
    protected $bookingModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }

        $this->pembayaranModel = new PembayaranModel();
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Pembayaran');
        }

        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3) {
            $data = [
                'pembayarans' => $this->pembayaranModel
                    ->select('pembayaran.*, booking.id_booking, booking.waktu_booking, booking.status_booking')
                    ->join('booking', 'booking.id_booking = pembayaran.id_booking')
                    ->where('pembayaran.in_trash', 0)
                    ->findAll()
            ];
            return view('pages/pembayaran/index', $data);
        } else {
            return redirect()->to('home/error');
        }
    }

    public function create()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form tambah Data Pembayaran');
        }

        $data = [
            'bookings' => $this->bookingModel->where('in_trash', 0)->findAll()
        ];

        return view('pages/pembayaran/create', $data);
    }

    public function store()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Pembayaran berhasil ditambahkan');
        }

        $this->pembayaranModel->insert([
            'id_booking' => $this->request->getPost('id_booking'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'jumlah_bayar' => $this->request->getPost('jumlah_bayar'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'status_pembayaran' => $this->request->getPost('status_pembayaran'),
            'in_trash' => 0
        ]);

        return redirect()->to('/pembayaran')->with('success', 'Data Pembayaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form edit Data Pembayaran');
        }

        $data = [
            'pembayaran' => $this->pembayaranModel->find($id),
            'bookings' => $this->bookingModel->where('in_trash', 0)->findAll()
        ];

        return view('pages/pembayaran/edit', $data);
    }

    public function update($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Pembayaran berhasil diperbarui');
        }

        $this->pembayaranModel->update($id, [
            'id_booking' => $this->request->getPost('id_booking'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'jumlah_bayar' => $this->request->getPost('jumlah_bayar'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'status_pembayaran' => $this->request->getPost('status_pembayaran')
        ]);

        return redirect()->to('/pembayaran')->with('success', 'Data Pembayaran berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Pembayaran berhasil dihapus');
        }

        $this->pembayaranModel->update($id, ['in_trash' => 1]);
        return redirect()->to('/pembayaran')->with('success', 'Data Pembayaran berhasil dihapus');
    }

    public function trash()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Pembayaran yang dihapus');
        }

        $data = [
            'pembayarans' => $this->pembayaranModel
                ->select('pembayaran.*, booking.id_booking, booking.waktu_booking, booking.status_booking')
                ->join('booking', 'booking.id_booking = pembayaran.id_booking')
                ->where('pembayaran.in_trash', 1)
                ->findAll()
        ];

        return view('pages/pembayaran/trash', $data);
    }

    public function restore($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Pembayaran berhasil dipulihkan');
        }

        $this->pembayaranModel->update($id, ['in_trash' => 0]);
        return redirect()->to('/pembayaran/trash')->with('success', 'Data Pembayaran berhasil dipulihkan');
    }

    public function deletePermanent($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Pembayaran berhasil dihapus secara permanen');
        }

        $this->pembayaranModel->delete($id);
        return redirect()->to('/pembayaran/trash')->with('success', 'Data Pembayaran berhasil dihapus secara permanen');
    }

    public function empty_trash()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Pembayaran berhasil dihapus semua');
        }

        $this->pembayaranModel->where('in_trash', 1)->delete();
        return redirect()->to('/pembayaran/trash')->with('success', 'Data Pembayaran berhasil dihapus semua');
    }
}