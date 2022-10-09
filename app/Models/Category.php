<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'categoryName',
        'categoryImage',
        'categoryDescription',
        'numProducts'
    ];


    protected $primaryKey = 'id_category';
    protected $table = 'category';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }
}
