<?php

namespace App\Http\Controllers;

use App\Http\Requests\examination\NewExaminationRequest;
use App\Models\Patient;
use App\Services\ExaminationService;
use App\Services\ExternalApiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    public function indexExamination()
    {
        return view('examination.index');
    }

    public function indexNewExamination(ExternalApiAuth $service)
    {

        $query = Patient::query();
        $patients = $query->get();

        $medicines = $service->getMedicine();

        return view('examination.newExam', compact('patients', 'medicines'));
    }

    public function createNewExamination(NewExaminationRequest $request, ExaminationService $service, ExternalApiAuth $serviceExternal)
    {
        if(Auth::user()->role !== 2) return back()->with('error', 'No Permission!');

        $service->createNewExamination($request->validated(), $request->file('attachments'), $serviceExternal);
    
        return redirect()
        ->route('examination')
        ->with('success', 'Examination Successfully Created!');
    }

}
