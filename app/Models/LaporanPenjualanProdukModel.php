<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPenjualanProdukModel extends Model
{
    protected $table            = 'penjualan_produk';
    protected $primaryKey       = 'id_penjualan';

    protected $allowedFields    = [
        'id_pasien', 'id_produk', 'jumlah', 'total_harga', 'tanggal_pembayaran', 'in_trash'
    ];

    protected $useTimestamps = false;

    public function getLaporanPenjualanProduk()
    {
        return $this->db->table('penjualan_produk')
                        ->select('penjualan_produk.*, pasien.nama_pasien, produk.nama_produk')
                        ->join('pasien', 'penjualan_produk.id_pasien = pasien.id_pasien', 'left')
                        ->join('produk', 'penjualan_produk.id_produk = produk.id_produk', 'left')
                        ->get()
                        ->getResultArray();
    }

    public function getPenjualanProduksByDateRange($startDate, $endDate)
    {
        return $this->select('penjualan_produk.*, pasien.nama_pasien, produk.nama_produk')
                    ->join('pasien', 'penjualan_produk.id_pasien = pasien.id_pasien', 'left')
                    ->join('produk', 'penjualan_produk.id_produk = produk.id_produk', 'left')
                    ->where('tanggal_pembayaran >=', $startDate)
                    ->where('tanggal_pembayaran <=', $endDate)
                    ->findAll();
    }
}