<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'villain_id',
        'full_name',
        'email',
        'phone',
        'content',
    ];

    public function villain()
    {
        return $this->belongsTo(Villain::class);
    }
}
