<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id_pembayaran';

    protected $allowedFields    = [
        'id_booking',
        'metode_pembayaran',
        'jumlah_bayar',
        'tanggal_bayar',
        'status_pembayaran',
        'in_trash'
    ];

    protected $useTimestamps = false;
    
    public function getLaporanPembayaran()
    {
        return $this->db->table('pembayaran')
                        ->select('pembayaran.*, booking.waktu_booking')
                        ->join('booking', 'pembayaran.id_booking = booking.id_booking', 'left')
                        ->get()
                        ->getResultArray();
    }

    public function getPembayaransByDateRange($startDate, $endDate)
    {
        return $this->select('pembayaran.*, booking.waktu_booking')
                    ->join('booking', 'pembayaran.id_booking = booking.id_booking', 'left')
                    ->where('tanggal_bayar >=', $startDate)
                    ->where('tanggal_bayar <=', $endDate)
                    ->findAll();
    }
}