<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationFiles extends Model
{
    protected $fillable = [
        "examination_id",
        "file_name",
        "file_path"
    ];
}
