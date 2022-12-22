<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;
    protected $table = "question_type";

    protected $fillable = [
        'question_type',
        'name'
    ];

    public function questions() {
        return $this->hasMany(Question::class, 'question_type', 'id');
    }
}
