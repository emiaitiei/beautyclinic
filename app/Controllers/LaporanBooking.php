<?php

namespace App\Controllers;

use App\Models\LaporanBookingModel;

use App\Models\LogActivityModel;

use TCPDF;

class LaporanBooking extends BaseController
{
	protected $laporanbookingModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }
        $this->laporanbookingModel = new LaporanBookingModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Laporan Booking');
        }

        if (session()->get('level')==1 || session()->get('level')==2) {

        $laporanbookings = $this->laporanbookingModel->getLaporanBooking();
        return view('pages/laporan_booking/index', ['laporanbookings' => $laporanbookings]);

        }else if (session()->get('level')>0){
            return redirect()->to('home/error');
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function printlaporanbooking()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Print Laporan Booking');
        }

        $startDate = $this->request->getPost('awal');
        $endDate = $this->request->getPost('akhir');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        $laporanbookingModel = new LaporanBookingModel();
        $bookings = $laporanbookingModel->getBookingsByDateRange($startDate, $endDate);

        return view('pages/laporan_booking/printlaporanbooking', ['bookings' => $bookings]);
    }

    public function pdflaporanbooking()
    {
        $startDate = $this->request->getPost('awal');
        $endDate = $this->request->getPost('akhir');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        $laporanbookingModel = new LaporanBookingModel();
        $bookings = $laporanbookingModel->getBookingsByDateRange($startDate, $endDate);

        $this->generatePDF($bookings, $startDate, $endDate);
    }

    private function generatePDF($bookings, $startDate, $endDate)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'PDF Laporan Booking');
        }

        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistem Reservasi');
        $pdf->SetTitle('Laporan Booking');
        $pdf->SetSubject('Laporan Booking');
        $pdf->SetMargins(10, 10, 10);

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 12);

        $pdf->Cell(0, 10, 'Laporan Booking dari ' . $startDate . ' hingga ' . $endDate, 0, 1, 'C');

        $pdf->Ln(10); 
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Pasien', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Dokter', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Layanan', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Waktu Booking', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Status Booking', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Catatan', 1, 1, 'C');

        $no = 1;
        foreach ($bookings as $booking) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(40, 10, esc($booking['nama_pasien']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($booking['nama_dokter']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($booking['nama_layanan']), 1, 0, 'L');
            $pdf->Cell(40, 10, date('d-m-Y H:i', strtotime($booking['waktu_booking'])), 1, 0, 'C');
            $pdf->Cell(40, 10, esc($booking['status_booking']), 1, 0, 'C');
            $pdf->Cell(40, 10, esc($booking['catatan']), 1, 1, 'L');
        }

        $pdf->Output('laporan_booking.pdf', 'D'); 
    }
}