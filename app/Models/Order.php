<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'addressProvince',
        'addressDistrict',
        'addressCommune',
        'addressSpecific',
        'feeship',
        'orderTotal',
        'orderEmail',
        'orderPhone',
        'orderCoupon',
        'orderDiscount',
        'orderName',
        'paymentMethod',
        'orderNotes'
    ];


    protected $primaryKey = 'id_order';
    protected $table = 'order';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }
}
