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
        'cv',
        'universe_id',
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
        return $this->belongsToMany(Rating::class)->withPivot('villain_id', 'rating_id', 'full_name', 'content', 'id');
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }
    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class)->withPivot('purchase_price', 'expiration_date')->withTimestamps();
    }
}
