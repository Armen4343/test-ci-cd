<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginRegisterBanner extends Model
{
    use HasFactory;

    protected $table = 'login_register_banner';

    protected $fillable = [
        'login_banner',
        'register_banner',
        'banner_name',
    ];
}
