<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table         = 'pengaturan';
    protected $primaryKey    = 'id';
    protected $useTimestamps  = false;
    protected $allowedFields  = ['lama_pinjam', 'denda_per_hari', 'updated_at'];
}
