<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'booking';
    protected $primaryKey       = 'id_booking';

    protected $allowedFields    = [
        'id_pasien',
        'id_dokter',
        'id_layanan',
        'waktu_booking',
        'status_booking',
        'catatan',
        'in_trash'
    ];

    protected $useTimestamps = false;
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    public function getBooking()
    {
        return $this->db->table('booking')
                        ->select('booking.*, pasien.nama_pasien, dokter.nama_dokter, layanan.nama_layanan')
                        ->join('pasien', 'booking.id_pasien = pasien.id_pasien', 'left')
                        ->join('dokter', 'booking.id_dokter = dokter.id_dokter', 'left')
                        ->join('layanan', 'booking.id_layanan = layanan.id_layanan', 'left')
                        ->get()
                        ->getResultArray();
    }
}