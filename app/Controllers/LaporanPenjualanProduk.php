<?php

namespace App\Controllers;

use App\Models\LaporanPenjualanProdukModel;

use App\Models\LogActivityModel;

use TCPDF;

class LaporanPenjualanProduk extends BaseController
{
	protected $laporanpenjualanprodukModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }
        $this->laporanpenjualanprodukModel = new LaporanPenjualanProdukModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Laporan Penjualan Produk');
        }

        if (session()->get('level')==1 || session()->get('level')==2) {

        $laporanpenjualanproduks = $this->laporanpenjualanprodukModel->getLaporanPenjualanProduk();
        return view('pages/laporan_penjualan_produk/index', ['laporanpenjualanproduks' => $laporanpenjualanproduks]);

        }else if (session()->get('level')>0){
            return redirect()->to('home/error');
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function printlaporanpenjualanproduk()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Print Laporan Penjualan Produk');
        }

        $startDate = $this->request->getPost('awal');
        $endDate = $this->request->getPost('akhir');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        $laporanpenjualanprodukModel = new LaporanPenjualanProdukModel();
        $penjualan = $laporanpenjualanprodukModel->getPenjualanProduksByDateRange($startDate, $endDate);

        return view('pages/laporan_penjualan_produk/printlaporanpenjualanproduk', ['penjualan' => $penjualan]);
    }

    public function pdflaporanpenjualanproduk()
    {
        $startDate = $this->request->getPost('awal');
        $endDate = $this->request->getPost('akhir');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        $laporanpenjualanprodukModel = new LaporanPenjualanProdukModel();
        $penjualans = $laporanpenjualanprodukModel->getPenjualanProduksByDateRange($startDate, $endDate);

        $this->generatePDF($penjualans, $startDate, $endDate);
    }

    private function generatePDF($penjualans, $startDate, $endDate)
    {
        $user = session()->get();
        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'PDF Laporan Penjualan Produk');
        }

        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistem Penjualan Produk');
        $pdf->SetTitle('Laporan Penjualan Produk');
        $pdf->SetSubject('Laporan Penjualan Produk');
        $pdf->SetMargins(10, 10, 10);

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 12);

        $pdf->Cell(0, 10, 'Laporan Penjualan Produk dari ' . $startDate . ' hingga ' . $endDate, 0, 1, 'C');

        $pdf->Ln(10);

        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Pasien', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Produk', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Total Harga', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Tanggal Pembayaran', 1, 1, 'C');

        $no = 1;
        foreach ($penjualans as $penjualan) {
            $total_harga = floatval($penjualan['total_harga']); 

            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(40, 10, esc($penjualan['nama_pasien']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($penjualan['nama_produk']), 1, 0, 'L');
            $pdf->Cell(40, 10, esc($penjualan['jumlah']), 1, 0, 'C');
            $pdf->Cell(40, 10, 'Rp ' . number_format($total_harga, 0, ',', '.'), 1, 0, 'R'); 
            $pdf->Cell(40, 10, date('d-m-Y', strtotime($penjualan['tanggal_pembayaran'])), 1, 1, 'C');
        }

        $pdf->Output('laporan_penjualan_produk.pdf', 'D'); 
    }
}