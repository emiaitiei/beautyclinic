<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanProdukModel extends Model
{
    protected $table            = 'penjualan_produk';
    protected $primaryKey       = 'id_penjualan';

    protected $allowedFields    = [
        'id_pasien', 'id_produk', 'jumlah', 'total_harga', 'tanggal_pembayaran', 'in_trash'
    ];

    protected $useTimestamps    = false;

    public function getSalesSumPerDay()
    {
        return $this->select("tanggal_pembayaran, SUM(CAST(total_harga AS UNSIGNED)) as total")
                    ->where('in_trash', 0) 
                    ->groupBy('tanggal_pembayaran')
                    ->orderBy('tanggal_pembayaran', 'ASC')
                    ->findAll();
    }
}