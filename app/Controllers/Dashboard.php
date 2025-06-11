<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\PenjualanProdukModel;

use App\Models\LogActivityModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $orderModel;
    protected $transactionModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit;
        }

        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->orderModel = 0;
        $this->transactionModel = 0;
    }

    public function index(): string
    {
        $user = session()->get();

        $userId = $user['id'] ?? null;

        if ($userId) {
            $logModel = new \App\Models\LogActivityModel();
            $logModel->writeLog($userId, 'Mengakses Halaman Dashboard');
        }

        $data = [
            'total_visitors' => $this->userModel->countAll(),
            'total_subscribers' => $this->userModel->countAll(),
            'total_sales' => is_object($this->transactionModel) ? $this->transactionModel->countAll() : $this->transactionModel,
            'total_orders' => is_object($this->orderModel) ? $this->orderModel->countAll() : $this->orderModel,
        ];

        $penjualanModel = new \App\Models\PenjualanProdukModel();
        $salesData = $penjualanModel->getSalesSumPerDay();

        $labels = [];
        $totals = [];

        foreach ($salesData as $row) {
            $labels[] = $row['tanggal_pembayaran'];
            $totals[] = $row['total'];
        }

        return view('pages/dashboard', array_merge($data, [
            'salesLabels' => json_encode($labels),
            'salesTotals' => json_encode($totals)
        ]));

        switch (session()->get('level')) {
            case 1:
            case 2: 
            case 3:
            case 4:
                return view('dashboard', $data);
            default:
                return view('dashboard2', $data);
        }
    }
}