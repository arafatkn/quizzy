<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;

    const CREATED_AT = "started_at";

    protected $guarded = ['id'];

    protected $casts = [
        'answers' => 'object',
    ];

    // Custom Attributes

    public function getTimeRemainingAttribute()
    {
        return $this->quiz->time_limit - now()->diffInSeconds($this->started_at);
    }

    // Relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
