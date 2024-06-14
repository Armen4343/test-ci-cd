<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;
    protected $fillable=[
        "menu_id",
        "item_id",
        "qty",
        "total",
        ];
	
	
	 public function items(){

        return $this->hasOne('App\Models\Items','id', 'item_id');

    }
}