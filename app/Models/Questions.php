<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "questions";

    protected $fillable = [
        'question_type',
        'question_content',
        'file_image',
        'type_answers',
        'parent_id',
        'locekd'
    ];

    public function questionType() {
        return $this->belongsTo(QuestionType::class, 'question_type', 'id');
    }
}
