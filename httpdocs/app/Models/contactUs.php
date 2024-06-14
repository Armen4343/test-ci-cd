<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactUs extends Model
{
    use HasFactory;
     protected $fillable = [
        'email',
        'phone1',
        'phone2',
        'address',
        'country',
        'postal_code',

    ];
}
