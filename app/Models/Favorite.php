<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'id_user',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    protected $primaryKey = 'id_favorite';
    protected $table = 'favorite';

    public function product(){
        return $this->hasMany('App\Models\Product', 'id_product');  
    }
}
