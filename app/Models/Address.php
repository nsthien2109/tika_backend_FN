<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressProvince',
        'addressDistrict',
        'addressCommune',
        'addressSpecific',
        'id_user'
    ];


    protected $primaryKey = 'id_address';
    protected $table = 'address';
}
