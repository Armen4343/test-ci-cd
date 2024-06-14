<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'cuisine_id',
        'description',
        'co2_avg',
        'h2o_avg',
        'image',
        'alergen_info',
        'menu_status',
        'discount',
        'price',
        'date_range',
        'quantity',
        'promo',
        'tax',
        'tax_included',
        'expire_date',
        'availability',
        'user_id',
		'sale_price',
        'deleted',
        'promo_days',
        'time_range',
        'calculate_owner',
        'seen_by_vendor',
        "is_exists_expire_date"
    ];

    public function category() {
        return $this->belongsTo(Category::class); // don't forget to add your full namespace
    }
    public function cuisine() {
        return $this->belongsTo(Cuisine::class); // don't forget to add your full namespace
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class); // don't forget to add your full namespace
    }

}
