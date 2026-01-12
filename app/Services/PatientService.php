<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PatientService {

    protected AuditLogsService $logs;

    public function __construct(AuditLogsService $logs)
    {
        $this->logs = $logs;
    }


    public function createNewPatient(array $data)
    {

        return DB::transaction(function () use ($data){
            $createUser = Patient::create([
                "fullname" => $data['full_name'],
                "phone_number" => $data['phone_number']
            ]);

            $this->logs->createLogs('CREATE USER', 'Has been created patient with patient_code: ' . $createUser->patient_code);

            return $createUser;
        }); 

    }
}