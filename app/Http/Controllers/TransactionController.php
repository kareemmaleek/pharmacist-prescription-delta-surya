<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use function Laravel\Prompts\error;
use App\Services\ExaminationService;
use App\Services\TransactionService;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\transaction\NewTransactionRequest;

class TransactionController 
{
    public function indexTransaction()
    {
        if(Auth::user()->role !== 1 && Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');
        
        $txData = Transactions::query()->paginate(10);

        return view('transaction.index', compact('txData'));
    }

    public function indexNewTransaction($exam_id, ExaminationService $service)
    {

        if(Auth::user()->role !== 1 && Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');

        $examData = $service->examinationData($exam_id);

        if($examData->status == 'served') return redirect()->route('transaction')->with('error', 'Examination already served!');

        return view('transaction.newTransaction', compact('examData'));
    }

    public function indexReceipt($tx_code)
    {
        try{
            if(Auth::user()->role !== 1 && Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');

            $tx = Transactions::query()->where('tx_code', '=', $tx_code)->firstOrFail();

            return view('utilities.receipt', compact('tx'));
        }catch(\Exception $e){
            return redirect()->route('transaction')->with('error', 'Uh-oh!, Something when wrong');
        }
    }

    public function createReceipt($tx_code)
    {   
        try{
            if(Auth::user()->role !== 1 && Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');

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
            if(Auth::user()->role !== 1 && Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');

            $service->createNewTransaction($request->validated() , $exam_id);

            return redirect()->route('transaction')->with('success', 'New Transaction Successfully Created!');
        }catch(\Exception $e){
            return redirect()->route('transaction')->with('error', 'Uh-oh!, Something when wrong');
        }
        
    }
}
