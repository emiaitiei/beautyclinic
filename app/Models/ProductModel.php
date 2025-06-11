<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $allowedFields = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'status',
        'in_trash'
    ];

    protected $useTimestamps = false;

    public function getAllActive()
    {
        return $this->where('in_trash', false)->findAll();
    }

    public function getTrashed()
    {
        return $this->where('in_trash', true)->findAll();
    }

    public function softDelete($id)
    {
        return $this->update($id, ['in_trash' => true]);
    }

    public function restore($id)
    {
        return $this->update($id, ['in_trash' => false]);
    }
}