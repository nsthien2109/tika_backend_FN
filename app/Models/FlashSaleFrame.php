<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleFrame extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'start',
        'end'
    ];


    protected $primaryKey = 'id_flashsale_frame';
    protected $table = 'flashsale_frame';
}
