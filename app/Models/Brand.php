<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'brandName',
        'brandImage',
        'brandDescription',
        'brandStatus'
    ];


    protected $primaryKey = 'id_brand';
    protected $table = 'brand';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }
}
