<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = [
        "patient_id",
        "doctor_id",
        "examined_at",
        "height",
        "weight",
        "systole",
        "diastole",
        "heart_rate",
        "respiration_rate",
        "body_temp",
        "doctor_notes",
        "status"
    ];
}
