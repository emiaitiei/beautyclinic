<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id_layanan';
    protected $allowedFields    = ['nama_layanan', 'deskripsi', 'durasi', 'harga', 'status', 'in_trash'];
    protected $useTimestamps    = false;

    public function getActiveServices()
    {
        return $this->where('in_trash', 0)->findAll();
    }

    public function getTrashServices()
    {
        return $this->where('in_trash', 1)->findAll();
    }
}