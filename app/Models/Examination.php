<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

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
        "status",
        "pharmacist_id",
        "served_at"
    ];

    protected $casts = [
        'served_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($examination) {
            DB::transaction(function () use ($examination) {
                $period = now()->format('Ym');

                $lastNumber = static::where('examination_code', 'LIKE', '%EXAM-' . $period . '%')
                ->select(DB::raw('SUBSTRING(examination_code, -4) AS code'))
                ->orderBy('id', 'desc')
                ->limit(1)
                ->first();

                $nextNumber = $lastNumber ? (int) $lastNumber->code + 1 : 1;
                // dd(str_pad($nextNumber, 4, '0', STR_PAD_LEFT));
              
                $examination->examination_code = 'EXAM-' . $period . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            });
        });
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function pharmacist(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pharmacist_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function getMedicinePrescriptionDataAttribute()
    {
        $items = DB::table('prescription_items')
            ->join('prescriptions', 'prescriptions.id', '=', 'prescription_items.prescription_id')
            ->where('prescriptions.examination_id', $this->id)
            ->select([
                'prescription_items.medicine_id as id',
                'prescription_items.medicine_name as name',
                'prescription_items.qty',
                'prescription_items.price as unit_price',
                'prescription_items.subtotal',
            ])
            ->get();

        $grandTotal = $items->sum('subtotal');

        return [
            'data' => $items->map(fn($item) => (array) $item)->toArray(),
            'grand_total' => $grandTotal,
        ];
            
    }

    public function examinationFiles():HasMany
    {
        return $this->hasMany(ExaminationFiles::class, 'examination_id');
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescriptions::class, 'examination_id', 'id');
    }
}
