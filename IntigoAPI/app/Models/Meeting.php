<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'price', 'slots', 'start_at', 'end_at', 'is_private', 'creator_id'];

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
