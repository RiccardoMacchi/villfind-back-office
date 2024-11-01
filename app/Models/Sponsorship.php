<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'hours',
        'description'
    ];

    public function villains()
    {
        return $this->belongsToMany(Villain::class, 'sponsorship_villain')
                    ->withPivot('purchase_price', 'expiration_date')
                    ->withTimestamps();
    }
}
