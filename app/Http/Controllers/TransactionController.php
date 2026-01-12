<?php

namespace App\Http\Controllers;

use App\Http\Requests\transaction\NewTransactionRequest;
use App\Models\Transactions;
use App\Services\ExaminationService;
use App\Services\TransactionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class TransactionController extends Controller
{
    public function indexTransaction()
    {
        $txData = Transactions::query()->paginate(10);

        return view('transaction.index', compact('txData'));
    }

    public function indexNewTransaction($exam_id, ExaminationService $service)
    {
        $examData = $service->examinationData($exam_id);

        if($examData->status == 'served') return redirect()->route('transaction')->with('error', 'Examination already served!');

        return view('transaction.newTransaction', compact('examData'));
    }

    public function indexReceipt($tx_code)
    {
        try{
            $tx = Transactions::query()->where('tx_code', '=', $tx_code)->firstOrFail();

            return view('utilities.receipt', compact('tx'));
        }catch(\Exception $e){
            return redirect()->route('transaction')->with('error', 'Uh-oh!, Something when wrong');
        }
    }

    public function createReceipt($tx_code)
    {   
        try{
            $tx = Transactions::query()->where('tx_code', '=', $tx_code)->firstOrFail();

            $pdf = Pdf::loadView('utilities.receipt', ["tx" => $tx]);

            return $pdf->download($tx_code . '.pdf');
        }catch(\Exception $e){
            return redirect()->route('transaction')->with('error', 'Uh-oh!, Something when wrong');
        }
    }

    public function createNewTransaction($exam_id, TransactionService $service, NewTransactionRequest $request)
    {
        try{
            $service->createNewTransaction($request->validated() , $exam_id);

            return redirect()->route('transaction')->with('success', 'New Transaction Successfully Created!');
        }catch(\Exception $e){
            return redirect()->route('transaction')->with('error', 'Uh-oh!, Something when wrong');
        }
        
    }
}
