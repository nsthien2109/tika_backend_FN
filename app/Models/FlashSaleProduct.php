<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_flashsale_frame	',
        'sale_day',
        'id_product',
        'id_store	',
        'salePercent',
        'amount'
    ];


    protected $primaryKey = 'id_flashsale_product';
    protected $table = 'flashsale_product';
}
