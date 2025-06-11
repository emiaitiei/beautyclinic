<?php

namespace App\Controllers;

use App\Models\PenjualanProdukModel;

use App\Models\PatientModel;
use App\Models\ProductModel;

use App\Models\LogActivityModel;

class PenjualanProduk extends BaseController
{
    protected $penjualanProdukModel;
    protected $pasienModel;
    protected $produkModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }

        $this->penjualanProdukModel = new PenjualanProdukModel();
        $this->pasienModel = new PatientModel();
        $this->produkModel = new ProductModel();
    }

    public function index()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Penjualan Produk');
        }

        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3) {

        $data = [
            'penjualan' => $this->penjualanProdukModel
                ->select('penjualan_produk.*, pasien.nama_pasien, produk.nama_produk')
                ->join('pasien', 'pasien.id_pasien = penjualan_produk.id_pasien')
                ->join('produk', 'produk.id_produk = penjualan_produk.id_produk')
                ->where('penjualan_produk.in_trash', 0)
                ->findAll()
        ];
        return view('pages/penjualan_produk/index', $data);

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
            $logModel->writeLog($userId, 'Mengakses form tambah Data Penjualan Produk');
        }

        $data = [
            'pasiens' => $this->pasienModel->where('in_trash', 0)->findAll(),
            'produks' => $this->produkModel->where('in_trash', 0)->findAll()
        ];

        return view('pages/penjualan_produk/create', $data);
    }

    public function store()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Penjualan Produk berhasil ditambahkan');
        }

        $this->penjualanProdukModel->insert([
            'id_pasien'         => $this->request->getPost('id_pasien'),
            'id_produk'         => $this->request->getPost('id_produk'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'total_harga'       => $this->request->getPost('total_harga'),
            'tanggal_pembayaran'=> $this->request->getPost('tanggal_pembayaran'),
            'in_trash'          => 0
        ]);

        return redirect()->to('/penjualan_produk')->with('success', 'Data Penjualan Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form edit Data Penjualan Produk');
        }

        $data = [
            'penjualan' => $this->penjualanProdukModel->find($id),
            'pasiens' => $this->pasienModel->where('in_trash', 0)->findAll(),
            'produks' => $this->produkModel->where('in_trash', 0)->findAll()
        ];
        return view('pages/penjualan_produk/edit', $data);
    }

    public function update($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Penjualan Produk berhasil diperbarui');
        }

        $this->penjualanProdukModel->update($id, [
            'id_pasien'         => $this->request->getPost('id_pasien'),
            'id_produk'         => $this->request->getPost('id_produk'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'total_harga'       => $this->request->getPost('total_harga'),
            'tanggal_pembayaran'=> $this->request->getPost('tanggal_pembayaran')
        ]);

        return redirect()->to('/penjualan_produk')->with('success', 'Data Penjualan Produk berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Penjualan Produk berhasil dihapus');
        }

        $this->penjualanProdukModel->update($id, ['in_trash' => 1]);
        return redirect()->to('/penjualan_produk')->with('success', 'Data Penjualan Produk berhasil dihapus');
    }

    public function trash(): string
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Penjualan Produk yang dihapus');
        }

        $data = [
            'penjualans' => $this->penjualanProdukModel
                ->select('penjualan_produk.*, pasien.nama_pasien, produk.nama_produk')
                ->join('pasien', 'pasien.id_pasien = penjualan_produk.id_pasien')
                ->join('produk', 'produk.id_produk = penjualan_produk.id_produk')
                ->where('penjualan_produk.in_trash', 1)
                ->findAll()
        ];
        return view('pages/penjualan_produk/trash', $data);
    }

    public function restore($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Penjualan Produk berhasil dipulihkan');
        }

        $this->penjualanProdukModel->update($id, ['in_trash' => 0]);
        return redirect()->to('/penjualan_produk/trash')->with('success', 'Data Penjualan Produk berhasil dipulihkan');
    }

    public function deletePermanent($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Penjualan Produk berhasil dihapus secara permanen');
        }

        $this->penjualanProdukModel->delete($id);
        return redirect()->to('/penjualan_produk/trash')->with('success', 'Data Penjualan Produk berhasil dihapus secara permanen');
    }

    public function empty_trash()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Penjualan Produk berhasil dihapus semua');
        }

        $this->penjualanProdukModel->where('in_trash', 1)->delete();
        return redirect()->to('/penjualan_produk/trash')->with('success', 'Data Penjualan Produk berhasil dihapus semua');
    }
}