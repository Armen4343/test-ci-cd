<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitems extends Model
{
    use HasFactory;
    protected $table = 'orderitem';
    public $timestamps = false;

    protected $fillable=[
        "itemid",
        "vendorid",
        "unit_price",
        "quantity",
        "total_price",
        "item_type",
        "order_id",
    ];
}
