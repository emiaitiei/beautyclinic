<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
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
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
}