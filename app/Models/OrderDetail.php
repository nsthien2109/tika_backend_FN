<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_order',
        'id_product',
        'id_size',
        'id_color',
        'quantity',
        'orderCoupon',
        'orderDiscount',
        'status',
        'statusType',
        'total'
    ];

    protected $primaryKey = 'id_order_detail';
    protected $table = 'order_detail';
    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }

    public function order(){
        return $this->hasMany('App\Models\Order', 'id_order');  
    }
}
