<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentUser extends Model
{
    protected $table = "student_user";

    protected $fillable =[
        'full_name',
        'email',
        'password',
        'phone_number',
        'address',
        'parent_name',
        'is_active',
        'information_id',
        'business_id',
        'media_id',
        'after_exam',
        'transition',
        'english_level',
        'ielts',
        'toefl',
        'certificate',
        'participation',
        'scholarship_exam'
    ];
    use HasFactory, SoftDeletes;
}
