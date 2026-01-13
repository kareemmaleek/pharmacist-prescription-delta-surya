<?php 

namespace App\Services;

use App\Models\Examination;
use App\Models\Patient;
use App\Models\Transactions;

class DashboardService{

    public function getData()
    {
        $patient = Patient::query()->count();
        $examination = Examination::query();
        $transaction = Transactions::query();
        $tx_income = $transaction->select('payment_total')->get()->sum('payment_total');

        $getMedicine = $examination->where('status', 'served')->get();

        $medicine_sold = 0;
        foreach($getMedicine as $medicines){
           foreach($medicines->medicine_prescription_data['data'] as $medicine){
                $medicine_sold = $medicine['qty'] + $medicine_sold;
           }
        }

        return [
            'total_patient' => $patient,
            'total_examination' => $examination->count(),
            'total_transaction' => $transaction->count(),
            'tx_income' => $tx_income,
            'medicine_sold' => $medicine_sold
          

        ];
    }
}