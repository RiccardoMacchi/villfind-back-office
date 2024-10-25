<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = ['page_name', 'view_count', 'villain_id'];

    // Definisce la relazione con il modello Villain
    public function villain()
    {
        return $this->belongsTo(Villain::class);
    }
}
