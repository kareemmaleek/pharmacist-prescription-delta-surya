<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
            DB::transaction(function () use ($patient) {
                $period = now()->format('Ym');

                $lastNumber = static::where('patient_code', 'LIKE', '%PX-' . $period . '%')
                ->select(DB::raw('SUBSTRING(patient_code, -4) AS code'))
                ->orderBy('id', 'desc')
                ->limit(1)
                ->first();

                $nextNumber = $lastNumber ? (int) $lastNumber->code + 1 : 1;
                $patient->patient_code = 'PX-' . $period . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            });
        });
    }
}
