<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['name', 'email', 'password', 'role', 'id_member'];
    protected $useTimestamps    = true;

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }
}
