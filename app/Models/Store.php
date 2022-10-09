<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;


    protected $fillable = [
        'storeName',
        'storeWebsite',
        'storeDescription',
        'storeAddress',
        'storeCity',
        'storeCountry',
        'storePhone',
        'storeEmail',
        'storeBackgroundImage',
        'storeStatus',
        'id_user',
        'storeAvatar'
    ];


    protected $primaryKey = 'id_store';
    protected $table = 'store';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }
}
