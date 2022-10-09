<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'id_product'
    ];

    protected $primaryKey = 'id_image';
    protected $table = 'images';

    public function product(){
        return $this->belongsTo('App\Models\Product', 'id_product');
    }
}
