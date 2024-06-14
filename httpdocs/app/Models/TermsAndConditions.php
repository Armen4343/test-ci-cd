<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsAndConditions extends Model
{
    use HasFactory;

	  protected $fillable = [
        'pdf_1',
        'pdf_2',
        'pdf_3',
        'pdf_4',
        'created_At',
        'terms_and_condition',
        'privacy_policy',
    ];
}
