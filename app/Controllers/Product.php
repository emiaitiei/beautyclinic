<?php

namespace App\Controllers;

use App\Models\ProductModel;

use App\Models\LogActivityModel;

class Product extends BaseController
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
            $logModel->writeLog($userId, 'Mengakses Data Produk');
        }

        if (session()->get('level')==1 || session()->get('level')==2 || session()->get('level')==3 || session()->get('level')==4) {

        $productsModel = new \App\Models\ProductModel();
        $products = $products = $productsModel->getAllActive();

        return view('pages/product/index', ['products' => $products]);

        }else if (session()->get('level')>0){
            return redirect()->to('home/error');
        }else{
            return redirect()->to('dashboard');
        }
    }

    public function add()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form tambah Data Produk');
        }

        return view('pages/product/create');
    }

    public function store()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Produk berhasil ditambahkan');
        }

        $productModel = new \App\Models\ProductModel();

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'in_trash'    => false,
        ];

        $productModel->insert($data);

        return redirect()->to('/product')->with('success', 'Data Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses form edit Data Produk');
        }

        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to('/product')->with('error', 'Data Produk tidak ditemukan');
        }

        return view('pages/product/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Produk berhasil diperbarui');
        }

        $productModel = new \App\Models\ProductModel();

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
        ];

        $productModel->update($id, $data);

        return redirect()->to('/product')->with('success', 'Data Produk berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Produk berhasil dihapus');
        }

        $productModel = new \App\Models\ProductModel();

        $role = session()->get('role');

        if ($role == 2) {
            $productModel->delete($id);
        } else {
            $productModel->softDelete($id);
        }

        return redirect()->back()->with('success', 'Data Produk berhasil dihapus');
    }

    public function trash()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Data Produk yang dihapus');
        }

        $model = new \App\Models\ProductModel();
        $products = $model->where('in_trash', 1)->findAll();

        return view('pages/product/trash', ['products' => $products]);
    }

    public function restore($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Produk berhasil dipulihkan');
        }

        $model = new \App\Models\ProductModel();
        $model->update($id, ['in_trash' => 0]);

        return redirect()->to('/product/trash')->with('message', 'Data Produk berhasil dipulihkan');
    }

    public function deletePermanent($id)
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Produk berhasil dihapus secara permanen');
        }

        if (session()->get('level') != 2) {
            return redirect()->back()->with('message', 'Tidak diizinkan.');
        }

        $model = new \App\Models\ProductModel();
        $model->delete($id, true);

        return redirect()->to('/product/trash')->with('message', 'Data Produk berhasil dihapus secara permanen');
    }

    public function empty_trash()
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Data Produk berhasil dihapus semua');
        }

        if (session()->get('level') != 2) {
            return redirect()->back()->with('message', 'Tidak diizinkan.');
        }

        $model = new \App\Models\ProductModel();
        $model->where('in_trash', 1)->delete(null, true); 

        return redirect()->to('/product/trash')->with('message', 'Data Produk berhasil dihapus semua');
    }

}