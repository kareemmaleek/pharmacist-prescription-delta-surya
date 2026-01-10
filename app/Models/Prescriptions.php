<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    protected $fillable = [
        "examination_id",
        "prescribed_at"
    ];
}
