<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = "exam";

    protected $fillable = [
        'date_test',
        'time_id'
    ];

    public function questions() {
        return $this->belongsToMany(Question::class, 'exam_question', 'exam_id', 'question_id');
    }
}
