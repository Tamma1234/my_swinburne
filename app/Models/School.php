<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "school";

    protected $guarded;

    public function province() {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
