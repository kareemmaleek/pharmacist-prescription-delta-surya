<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = "patients";

    protected $fillable = [
        "fullname",
        "phone_number",
    ];

    protected static function booted()
    {
        static::creating(function ($patient) {
            $patient->patient_code = 'PX-' . random_int(10000, 99999);
        });
    }
}
