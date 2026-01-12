<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transactions extends Model
{
    protected $fillable = [
        "tx_code",
        "examination_id",
        "pharmacist_id",
        "payment_total",
        "payment_method",
        "payment_amount",
        "payment_change",
        "status"
    ];

    protected static function booted()
    {
        static::creating(function ($tx) {
            DB::transaction(function () use ($tx) {
                $period = now()->format('Ym');

                $lastNumber = static::where('tx_code', 'LIKE', '%TRX-' . $period . '%')
                ->select(DB::raw('SUBSTRING(tx_code, -4) AS code'))
                ->orderBy('id', 'desc')
                ->limit(1)
                ->first();

                $nextNumber = $lastNumber ? (int) $lastNumber->code + 1 : 1;
                $tx->tx_code = 'TRX-' . $period . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            });
        });
    }

    public function examination(): BelongsTo
    {
        return $this->belongsTo(Examination::class, 'examination_id');
    }
}
