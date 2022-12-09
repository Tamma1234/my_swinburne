<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "student_user";

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone_number',
        'address',
        'parent_name',
        'is_active',
        'branch_id',
        'after_exam',
        'transition',
        'english_level',
        'ielts',
        'toefl',
        'hash_id',
        'path',
        'certificate',
        'participation',
        'scholarship_exam',
        'province_id',
        'district_id',
        'ward_id'
    ];

    public function provinces() {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district() {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function wards() {
        return $this->belongsTo(Wards::class, 'ward_id', 'id');
    }
}
