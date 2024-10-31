<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villain extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Skill::class, 'skill_villain');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_villain');
    }

    public function ratings()
    {
        return $this->belongsToMany(Rating::class, ('rating_villain'))->withPivot('id', 'villain_id', 'rating_id', 'full_name', 'content', 'created_at')->withTimestamps();
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }
    public function views()
    {
        return $this->hasMany(View::class);
    }
    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class, ('sponsorship_villain'))->withPivot('purchase_price', 'expiration_date', 'created_at')->withTimestamps();
    }
}
