<?php

namespace App\Models;

use CodeIgniter\Model;

class BookReviewModel extends Model
{
    protected $table         = 'book_reviews';
    protected $primaryKey    = 'id_review';
    protected $allowedFields = ['id_user', 'id_book', 'rating', 'comment'];
    protected $useTimestamps = true;
}
