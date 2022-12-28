<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "exam";

    protected $fillable = [
        'date_test',
        'time_id',
        'question_type'
    ];

    public function questions() {
        return $this->belongsToMany(Question::class, 'exam_question', 'exam_id', 'question_id');
    }

    public function groups() {
        return $this->belongsTo(GroupTest::class, 'time_id', 'id');
    }
}
