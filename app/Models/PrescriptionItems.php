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

    public function customData()
    {
        return [
            "id" => $this->medicine_id,
            "name" => $this->medicine_name,
            "qty" => $this->qty,
        ];
    }
}
