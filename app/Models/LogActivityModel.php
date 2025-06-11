<?php

namespace App\Models;

use CodeIgniter\Model;

class LogActivityModel extends Model
{
    protected $table = 'log_activity';
    protected $primaryKey = 'id_log';
    protected $allowedFields = ['id_user', 'aktivitas', 'ip_address', 'waktu'];
    public $timestamps = false;

    public function writeLog(int $userId, string $activity): bool
    {
        $request = \Config\Services::request();
        $ipAddress = $request->getIPAddress();

        $data = [
            'id_user'    => $userId,
            'aktivitas'  => $activity,
            'ip_address' => $ipAddress,
            'waktu'      => date('Y-m-d H:i:s'),
        ];

        return $this->insert($data);
    }
}