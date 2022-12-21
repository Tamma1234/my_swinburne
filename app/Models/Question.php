<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "question";

    protected $fillable = [
        'question_type',
        'question_type_name',
        'question_content',
        'file_image'
    ];

    public function answers() {
        return $this->hasMany(Answers::class, 'question_id', 'id');
    }
}
