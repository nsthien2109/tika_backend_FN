<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'productName',
        'productDescription',
        'productPrice',
        'productAmount',
        'purchases',
        'likes',
        'discount',
        'comments',
        'productStatus',
        'id_store',
        'id_category',
        'id_sub_category',
        'id_brand'
    ];


    protected $primaryKey = 'id_product';
    protected $table = 'products';


    public function store(){
        return $this->belongsTo('App\Models\Store', 'id_store');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'id_brand');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'id_category');
    }

    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory', 'id_sub_category');
    }

    public function images(){
        return $this->hasMany('App\Models\Images', 'id_image');
    }
}
