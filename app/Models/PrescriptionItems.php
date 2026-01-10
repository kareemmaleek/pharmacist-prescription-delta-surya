<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionItems extends Model
{
    protected $fillable = [
        "prescription_id",
        "medicine_id",
        "medicine_name",
        "price",
        "qty",
        "subtotal"
    ];

    protected $table = 'prescription_items';
}
