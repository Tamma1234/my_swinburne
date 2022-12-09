<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "district";

    protected $fillable = [
        'name',
        'type',
        'province_id'
    ];

    public function provinces() {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
