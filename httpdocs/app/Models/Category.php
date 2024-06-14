<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
	protected $fillable=[
		"title",
		"image",
		"status",
        "description",
		"user_id",
	];

    public function items(): HasMany
    {
        return $this->hasMany(Items::class); // don't forget to add your full namespace
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // don't forget to add your full namespace
    }
}
