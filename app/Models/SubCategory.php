<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subCategoryName',
        'id_category',
        'numProducts',
        'status'
    ];


    protected $primaryKey = 'id_sub_category';
    protected $table = 'sub_category';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }
}
