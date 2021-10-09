<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // Relations

    /**
     * Every Quiz will be created by a user (author)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Every Quiz has many questions
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
