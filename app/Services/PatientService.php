<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PatientService {


    public function createNewPatient(array $data)
    {
     
        return Patient::create([
            "fullname" => $data['full_name'],
            "phone_number" => $data['phone_number']
        ]);

    }
}