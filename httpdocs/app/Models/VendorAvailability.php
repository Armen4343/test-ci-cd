<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAvailability extends Model
{
    use HasFactory;
 protected $fillable=[
        "vendor_id",
        "status",
        "sunday_open",
        "sunday_close",
		 "monday_open",
		 "monday_close",
		 "tuesday_open",
		 "tuesday_close",
		 "wednesday_open",
		 "wednesday_close",
		 "thursday_open",
		 "thursday_close",
		 "friday_open",
		 "friday_close",
		 "saturday_open",
		 "saturday_close",
        ];
}
