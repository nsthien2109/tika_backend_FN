<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRelease extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_size',
        'id_color',
        'id_product'
    ];


    protected $primaryKey = 'id_product_release';
    protected $table = 'product_release';

    public function color(){
        return $this->belongsTo('App\Models\Color', 'id_color');
    }
    public function size(){
        return $this->belongsTo('App\Models\Size', 'id_size');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product', 'id_product');
    }
}
