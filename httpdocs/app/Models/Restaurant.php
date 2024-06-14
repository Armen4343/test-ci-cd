<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable  = [
        'name',
        'image',
        'cover_image',
        'min_delivery_time',
        'max_delivery_time',
        'license',
        'short_description',
        'address',
        'logitude',
        'latitude',
        'phone',
        'min_order_price',
        'status',
        'vendor_id'
    ];
}
