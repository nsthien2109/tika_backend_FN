<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'quantity',
        'id_color',
        'id_size',
        'id_user'
    ];


    protected $primaryKey = 'id_cart';
    protected $table = 'cart';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }
}
