<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    use HasFactory;
	    protected $fillable = [
        'name_on_card',
        'card_number',
		'card_type',
		'expiration_date',
        'status',
        'buyer_id',
        'created_at',
        'updated_at',
    ];
}
