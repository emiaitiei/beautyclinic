<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table      = 'pasien';
    protected $primaryKey = 'id_pasien';

    protected $allowedFields = [
        'id_user',
        'nama_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'tanggal_daftar',
        'status',
        'in_trash',
    ];

    protected $useTimestamps = false;

    protected $returnType = 'array';
}