<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    public function villains()
    {
        return $this->belongsToMany(Villain::class)->withPivot('villain_id', 'rating_id', 'full_name', 'content');
    }
}
