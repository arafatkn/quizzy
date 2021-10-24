<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'author_id'];

    // Custom Attribute
    public function getMarksPerQuestionAttribute()
    {
        return $this->total_marks / $this->total_questions;
    }

    public function getAuthorDigestAsTextAttribute(): string
    {
        return $this->author_digest ? 'On' : 'Off';
    }

    public function getTimeLimitAsTextAttribute(): string
    {
        $time = intdiv($this->time_limit, 60).' Min ';

        if (($this->time_limit % 60) == 0) {
            return $time;
        }

        return $time.($this->time_limit % 60).' Sec';
    }

    public function getStatusAsTextAttribute(): string
    {
        return $this->status ? 'Public' : 'Hidden';
    }

    // Override
    public function delete()
    {
        $this->questions()->delete();
        $this->attempts()->delete();

        return parent::delete();
    }

    // Relations

    /**
     * Every Quiz will be created by a user (author).
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Every Quiz has many questions.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Every Quiz has many attempts.
     */
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    // Scopes

    /**
     * Filter only public quizzes.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopePublic(Builder $query): Builder
    {
        return $query->where('status', 1);
    }

    /**
     * Filter only specific author's quizzes.
     *
     * @param  Builder  $query
     * @param  User|int  $author
     * @return Builder
     */
    public function scopeOfAuthor(Builder $query, $author): Builder
    {
        if ($author instanceof User) {
            $author = $author->id;
        }

        return $query->where('author_id', $author);
    }

    /**
     * Exclude specific author's quizzes.
     *
     * @param  Builder  $query
     * @param  User|int  $author
     * @return Builder
     */
    public function scopeExceptAuthor(Builder $query, $author): Builder
    {
        if ($author instanceof User) {
            $author = $author->id;
        }

        return $query->where('author_id', '!=', $author);
    }

    /**
     * Filter only specific matched quizzes.
     *
     * @param  Builder  $query
     * @param  string  $search
     * @return Builder
     */
    public function scopeSearchBy(Builder $query, string $search): Builder
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }
}
