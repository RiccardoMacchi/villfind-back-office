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
        'hours'
    ];

    public function villains()
    {
        return $this->hasMany(Villain::class);
    }
}
