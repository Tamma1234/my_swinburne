<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wards extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "wards";

    protected $fillable = [
        'name',
        'type',
        'district_id'
    ];

    public function districts() {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
