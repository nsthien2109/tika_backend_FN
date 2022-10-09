<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;


    protected $fillable = [
        'bannerName',
        'bannerImage',
        'bannerDescription',
        'bannerUrl'
    ];


    protected $primaryKey = 'id_banner';
    protected $table = 'banner';
}
