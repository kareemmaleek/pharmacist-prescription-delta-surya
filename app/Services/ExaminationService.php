<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\Examination;
use App\Models\ExaminationFiles;
use App\Models\PrescriptionItems;
use App\Models\Prescriptions;
use App\Services\ExternalApiAuth;
use Illuminate\Support\Facades\DB;

use function Illuminate\Support\now;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ExaminationService{

    public function createNewExamination(array $data, ?array $attachment, $service)
    {

        return DB::transaction(function () use ($data, $service, $attachment){

            

            $patient_id = Patient::query()->where('patient_code', '=', $data['patient'])->value('id');
            $doctor_id = Auth::user()->id;

            $exam = Examination::create([
                "patient_id" => $patient_id,
                "doctor_id" => $doctor_id,
                "examined_at" => now(),
                "height" => $data['height'] ?? null,
                "weight" => $data['weight'] ?? null,
                "systole" => $data['systole'] ?? null,
                "diastole" => $data['diastole'] ?? null,
                "heart_rate" => $data['heart_rate'] ?? null,
                "respiration_rate" => $data['respiration_rate'] ?? null,
                "body_temp" => $data['body_temp'] ?? null,
                "doctor_notes" => $data['doctor_notes'] ?? null,
                "status" => "prescribed"
            ]);

            $prescripion = Prescriptions::create([
                "examination_id" => $exam->id,
                "prescribed_at" => now()
            ]);

          

            foreach ($data['medicines'] as $medicine) {
                $getPrice           = $service->getMedicinePrice($medicine['id']);
                $dataPrice          = $getPrice['prices'] ?? [];
                if(empty($dataPrice)) return throw new \Exception('Price not found for medicine ID: ' . $medicine['id']);
                $lastUnitPrice      = $dataPrice[array_key_last($dataPrice)]["unit_price"];
                $calc               = $medicine['qty'] * $lastUnitPrice;

                PrescriptionItems::create([
                    "prescription_id" => $prescripion->id,
                    "medicine_id" => $medicine['id'],
                    "medicine_name" => $medicine['name'],
                    "price" => $lastUnitPrice,
                    "qty" => $medicine['qty'],
                    "subtotal" => $calc,
                ]);

            }

           

            $uploadedFile = [];

            if(!empty($attachment)){
                foreach ($attachment as $file){
                    $fileName = Uuid::uuid4() . '.' . $file->extension();

                    $filePath = $file->storeAs('uploads/examinations', $fileName, 'public');

                    if (!$filePath) {
                        throw new \Exception('File upload failed');
                    }

                    $uploadedFile[] = [
                        "file_name" => $fileName,
                        "file_path" => $filePath
                    ];
                }

                foreach ($uploadedFile as $file){
                    ExaminationFiles::create([
                        "examination_id" => $exam->id,
                        "file_name" => $file['file_name'],
                        "file_path" => $file['file_path']
                    ]);
                }
            }

            

            
        });

        

    }
}