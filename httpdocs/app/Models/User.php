<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'google_id',
		'facebook_id',
        'name',
		'manager_name',
        'email',
        'password',
        'vendor_payment_password',
		'token',
		'email_verified_at',
        'phone',
        'country',
        'state',
        'city',
        'zipcode',
        'role',
        'status',
        'termsandconditions',
        'disable_restaurant',
        'business_description',
		'address',
		'street_number',
        'profile_photo_path',
        'banner_photo_path',
		'provider',
		'provider_id',
        'stripe_account_id',
        'vendor_commission',
        'email_confirm_code',
        'company_name',
        'tax_id',
        'vat_number',
        'sdi_code',
        'pec'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Items::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'vendor_id', 'id');
    }

    public function vendorsAvailabilities(): BelongsTo
    {
        return $this->belongsTo(VendorAvailability::class, 'id', 'vendor_id');
    }
}
