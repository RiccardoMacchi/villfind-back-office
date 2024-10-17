<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorshipVillain extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_price',
        'expiration_date'
    ];

}
