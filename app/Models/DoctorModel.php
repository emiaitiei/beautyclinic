<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    protected $table      = 'dokter';
    protected $primaryKey = 'id_dokter';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = [
        'id_user', 
        'nama_dokter', 
        'spesialisasi', 
        'no_hp', 
        'jadwal_praktek', 
        'status', 
        'in_trash'
    ];

    protected $dateFormat    = 'datetime';

    public function getActiveDoctors()
    {
        return $this->where('in_trash', 0)->findAll();
    }

    public function getTrashDoctors()
    {
        return $this->where('in_trash', 1)->findAll();
    }
}