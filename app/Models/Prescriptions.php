<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prescriptions extends Model
{
    protected $fillable = [
        "examination_id",
        "prescribed_at"
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PrescriptionItems::class, 'prescription_id');
    }
}
