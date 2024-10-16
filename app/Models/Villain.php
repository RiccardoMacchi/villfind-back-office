<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Villain extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'phone',
        'universe_id',
        'email_contact',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function universe()
    {
        return $this->belongsTo(Universe::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }
}
