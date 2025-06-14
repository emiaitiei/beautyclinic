<?php

namespace App\Models;
use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $allowedFields = ['email', 'token', 'created_at'];
    public $timestamps = false;
}