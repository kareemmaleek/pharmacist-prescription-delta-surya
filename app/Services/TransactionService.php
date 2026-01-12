<?php 

namespace App\Services;

use App\Models\Examination;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class TransactionService{

    protected AuditLogsService $logs;

    public function __construct(AuditLogsService $logs)
    {
        $this->logs = $logs;
    }

    public function createNewTransaction(array $data, $exam_id)
    {

        $user = Auth::user();

        $examData = Examination::where('examination_code', '=', $exam_id)->firstOrFail();

        if($examData->status != 'served'){
            $createTx = DB::transaction(function () use ($data, $examData, $user){
                $tx = Transactions::create([
                    "examination_id"    => $examData->id,
                    "pharmacist_id"     => $user->id,
                    "payment_method"    => $data['payment_method'],
                    "payment_total"     => $data['payment_total'],
                    "payment_amount"    => $data['payment_amount'],
                    "payment_change"    => $data['payment_change'],
                    "status" => 'paid'
                ]);

                $examData->update([
                    "status" => 'served',
                    "pharmacist_id" => $user->id,
                    "served_at" => now(),
                ]);

                $this->logs->createLogs('NEW TRANSACTION', $user->email . ' has been create a new transaction with code: ' . $tx->tx_code);
            });

            return $createTx;
        }else{
            throw new \Exception('Examination already served!');
        }

        
    }
}