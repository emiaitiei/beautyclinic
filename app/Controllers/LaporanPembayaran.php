<?php

namespace App\Controllers;

use App\Models\LaporanPembayaranModel;

use App\Models\LogActivityModel;

use TCPDF;

class LaporanPembayaran extends BaseController
{
	protected $laporanpembayaranModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }
        $this->laporanpembayaranModel = new LaporanPembayaranModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Laporan Pembayaran');
        }

        if (session()->get('level')==1 || session()->get('level')==2) {

        $laporanpembayarans = $this->laporanpembayaranModel->getLaporanPembayaran();
        return view('pages/laporan_pembayaran/index', ['laporanpembayarans' => $laporanpembayarans]);

        }else if (session()->get('level')>0){
            return redirect()->to('home/error');
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function printlaporanpembayaran()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Print Laporan Pembayaran');
        }

        $startDate = $this->request->getPost('awal');
        $endDate = $this->request->getPost('akhir');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        $laporanpembayaranModel = new LaporanPembayaranModel();
        $pembayarans = $laporanpembayaranModel->getPembayaransByDateRange($startDate, $endDate);

        return view('pages/laporan_pembayaran/printlaporanpembayaran', ['pembayarans' => $pembayarans]);
    }

    public function pdflaporanpembayaran()
    {
        $startDate = $this->request->getPost('awal');
        $endDate = $this->request->getPost('akhir');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        $laporanpembayaranModel = new LaporanPembayaranModel();
        $pembayarans = $laporanpembayaranModel->getPembayaransByDateRange($startDate, $endDate);

        $this->generatePDF($pembayarans, $startDate, $endDate);
    }

    private function generatePDF($pembayarans, $startDate, $endDate)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'PDF Laporan Pembayaran');
        }

        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistem Pembayaran');
        $pdf->SetTitle('Laporan Pembayaran');
        $pdf->SetSubject('Laporan Pembayaran');
        $pdf->SetMargins(10, 10, 10);

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 12);

        $pdf->Cell(0, 10, 'Laporan Pembayaran dari ' . $startDate . ' hingga ' . $endDate, 0, 1, 'C');

        $pdf->Ln(10);

        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Waktu Booking', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Metode Pembayaran', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Jumlah Bayar', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Tanggal Bayar', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Status Pembayaran', 1, 0, 'C');

        $no = 1;
        foreach ($pembayarans as $pembayaran) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(40, 10, esc($pembayaran['waktu_booking']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($pembayaran['metode_pembayaran']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($pembayaran['jumlah_bayar']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($pembayaran['tanggal_bayar']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($pembayaran['status_pembayaran']), 1, 0, 'L');
        }

        $pdf->Output('laporan_pembayaran.pdf', 'D'); 
    }
}