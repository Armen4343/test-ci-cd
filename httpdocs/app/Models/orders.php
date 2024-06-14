<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $table = 'tblorder';
    public $timestamps = false;

    protected $fillable=[
        "userid",
        "vendorid",
        "total",
        "status",
        "payment_type",
        "transactiontime",
        "creditcardtime",
        "paypal_id",
        "card4",
        "cardtype",
        "address",
        "name",
        "city",
        "state",
        "zipcode",
        "phone",
        "delivery_date",
        "delivery_time",
        "collected",
        "collectiontime",
        "seen_by_vendor",
        "refund_id",
        "refund_time",
        "refund_amount",
        "refund_status"
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
