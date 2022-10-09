<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'sizeName'
    ];

    protected $primaryKey = 'id_size';
    protected $table = 'size';
}
