<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'couponName',
        'couponDescription',
        'couponCode',
        'couponPercent',
        'couponType',
        'id_store',
        'couponTurns',
        'start_time',
        'end_time'
    ];


    protected $primaryKey = 'id_coupon';
    protected $table = 'coupon';
}
