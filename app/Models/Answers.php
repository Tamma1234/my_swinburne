<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answers extends Model
{
    protected $table = "answers";

    protected $fillable = [
        'answers',
        'question_id',
        'file_image'
    ];
    use HasFactory, SoftDeletes;

    public function questions() {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
