<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'id_user',
        'star_rate',
        'commentContent'
    ];


    protected $primaryKey = 'id_comment';
    protected $table = 'comment';
}
