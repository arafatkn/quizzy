<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;

    const CREATED_AT = 'started_at';

    protected $guarded = ['id'];

    protected $dates = [
        'submitted_at',
        'examined_at',
    ];

    protected $casts = [
        'answers' => 'object',
    ];

    // Custom Attributes

    public function getTimeRemainingAttribute()
    {
        return $this->quiz->time_limit - now()->diffInSeconds($this->started_at);
    }

    public function getQuestionsAttribute()
    {
        return Question::where('quiz_id', $this->quiz_id)->whereIn('id', array_keys(get_object_vars($this->answers)))->get();
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

    // Helper Functions

    public function examine()
    {
        if (! $this->questions) {
            return false;
        }

        $questions = $this->questions->mapWithKeys(function ($item) {
            return [$item->id => $item->answer];
        });

        $corrects = 0;
        $wrongs = 0;

        foreach ($this->answers as $qid => $answer) {
            if ($answer == $questions[$qid]) {
                $corrects++;
            } elseif ($answer !== null) {
                $wrongs++;
            }
        }

        $this->corrects = $corrects;
        $this->wrongs = $wrongs;
        $this->marks = $this->corrects * $this->quiz->marks_per_question;
        $this->marks = is_int($this->marks) ? $this->marks : round($this->marks, 2);
        $this->examined_at = now();

        return $this->save();
    }
}
