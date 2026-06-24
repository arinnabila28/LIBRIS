<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table         = 'wishlist';
    protected $primaryKey    = 'id_wishlist';
    protected $allowedFields = ['id_user', 'id_book', 'created_at'];
    protected $useTimestamps = false;
}
