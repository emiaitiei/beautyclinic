<?php

namespace App\Controllers;

use App\Models\BookingModel;

use App\Models\PatientModel;  
use App\Models\DoctorModel;  
use App\Models\ServiceModel;

use App\Models\LogActivityModel;

class Booking extends BaseController
{
    protected $bookingModel;
    protected $patientModel;
    protected $doctorModel;
    protected $serviceModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }

        $this->bookingModel = new BookingModel();
        $this->patientModel = new PatientModel();
        $this->doctorModel = new DoctorModel();
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Booking');
        }

        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3) {
            $data = [
                'bookings' => $this->bookingModel
                    ->select('booking.*, pasien.nama_pasien, dokter.nama_dokter, layanan.nama_layanan')
                    ->join('pasien', 'pasien.id_pasien = booking.id_pasien')
                    ->join('dokter', 'dokter.id_dokter = booking.id_dokter')
                    ->join('layanan', 'layanan.id_layanan = booking.id_layanan')
                    ->where('booking.in_trash', 0)
                    ->findAll()
            ];
            return view('pages/booking/index', $data);

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
            $logModel->writeLog($userId, 'Mengakses form tambah Data Booking');
        }

        $data = [
            'pasiens' => $this->patientModel->where('in_trash', 0)->findAll(),
            'dokters' => $this->doctorModel->where('in_trash', 0)->findAll(),
            'layanans' => $this->serviceModel->where('in_trash', 0)->findAll()
        ];

        return view('pages/booking/create', $data);
    }

    public function store()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Booking berhasil ditambahkan');
        }

        $this->bookingModel->insert([
            'id_pasien' => $this->request->getPost('id_pasien'),
            'id_dokter' => $this->request->getPost('id_dokter'),
            'id_layanan' => $this->request->getPost('id_layanan'),
            'waktu_booking' => $this->request->getPost('waktu_booking'),
            'status_booking' => $this->request->getPost('status_booking'),
            'catatan' => $this->request->getPost('catatan'),
            'in_trash' => 0
        ]);

        return redirect()->to('/booking')->with('success', 'Data Booking berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form edit Data Booking');
        }

        $data = [
            'booking' => $this->bookingModel->find($id),
            'pasiens' => $this->patientModel->where('in_trash', 0)->findAll(),
            'dokters' => $this->doctorModel->where('in_trash', 0)->findAll(),
            'layanans' => $this->serviceModel->where('in_trash', 0)->findAll()
        ];

        return view('pages/booking/edit', $data);
    }

    public function update($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Booking berhasil diperbarui');
        }

        $this->bookingModel->update($id, [
            'id_pasien' => $this->request->getPost('id_pasien'),
            'id_dokter' => $this->request->getPost('id_dokter'),
            'id_layanan' => $this->request->getPost('id_layanan'),
            'waktu_booking' => $this->request->getPost('waktu_booking'),
            'status_booking' => $this->request->getPost('status_booking'),
            'catatan' => $this->request->getPost('catatan')
        ]);

        return redirect()->to('/booking')->with('success', 'Data Booking berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Booking berhasil dihapus');
        }

        $this->bookingModel->update($id, ['in_trash' => 1]);
        return redirect()->to('/booking')->with('success', 'Data Booking berhasil dihapus');
    }

    public function trash()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Booking yang dihapus');
        }

        $data = [
            'bookings' => $this->bookingModel
                ->select('booking.*, pasien.nama_pasien, dokter.nama_dokter, layanan.nama_layanan')
                ->join('pasien', 'pasien.id_pasien = booking.id_pasien')
                ->join('dokter', 'dokter.id_dokter = booking.id_dokter')
                ->join('layanan', 'layanan.id_layanan = booking.id_layanan')
                ->where('booking.in_trash', 1)
                ->findAll()
        ];

        return view('pages/booking/trash', $data);
    }

    public function restore($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Booking berhasil dipulihkan');
        }

        $this->bookingModel->update($id, ['in_trash' => 0]);
        return redirect()->to('/booking/trash')->with('success', 'Data Booking berhasil dipulihkan');
    }

    public function deletePermanent($id)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Booking berhasil dihapus secara permanen');
        }

        $this->bookingModel->delete($id);
        return redirect()->to('/booking/trash')->with('success', 'Data Booking berhasil dihapus secara permanen');
    }

    public function empty_trash()
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new LogActivityModel();
            $logModel->writeLog($userId, 'Data Booking berhasil dihapus semua');
        }

        $this->bookingModel->where('in_trash', 1)->delete();
        return redirect()->to('/booking/trash')->with('success', 'Data Booking berhasil dihapus semua');
    }
}