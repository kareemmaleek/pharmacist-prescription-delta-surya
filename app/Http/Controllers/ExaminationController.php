<?php

namespace App\Http\Controllers;

use App\Http\Requests\examination\NewExaminationRequest;
use App\Http\Requests\examination\UpdateExaminationRequest;
use App\Models\Examination;
use App\Models\Patient;
use App\Services\ExaminationService;
use App\Services\ExternalApiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    public function indexExamination()
    {
        $query = Examination::where('status', '!=', 'deleted');
        $exam = $query->paginate(5);

        return view('examination.index', compact('exam'));
    }

    public function indexNewExamination(ExternalApiAuth $service)
    {

        $query = Patient::query();
        $patients = $query->get();

        $medicines = $service->getMedicine();

        return view('examination.newExam', compact('patients', 'medicines'));
    }

    public function indexEditExamination($exam_id, ExaminationService $service, ExternalApiAuth $serviceExternal)
    {
        $medicines  = $serviceExternal->getMedicine();
        $exam       = $service->examinationData($exam_id);
        
        if($exam->status == 'served') return redirect()->route('examination')->with('error', 'Examination Already Served!');
        
        
        return view('examination.editExam', compact('medicines', 'exam'));
    }

    public function createNewExamination(NewExaminationRequest $request, ExaminationService $service, ExternalApiAuth $serviceExternal)
    {
        try{
            if(Auth::user()->role !== 2) return back()->with('error', 'No Permission!');

            $service->createNewExamination($request->validated(), $request->file('attachments'), $serviceExternal);

            return redirect()
            ->route('examination')
            ->with('success', 'Examination Successfully Created!');
        }catch(\Exception $e){
            return redirect()->route('examination')->with('error', 'Uh-oh!, Something when wrong');
        }
    }

    public function updateExamination($exam_id, UpdateExaminationRequest $request, ExaminationService $service, ExternalApiAuth $serviceExternal)
    {
        try{
            $medicineData = $request->input('medicines', []);
            $service->updateExamination($request->validated(), $exam_id, $medicineData, $serviceExternal);

            return redirect()
            ->route('examination')
            ->with('success', 'Examination Successfully Updated!');
        }catch(\Exception $e){
            return redirect()->route('examination')->with('error', 'Uh-oh!, Something when wrong');
        }
    }

    public function deleteExamination($exam_id, ExaminationService $service)
    {
        try{
            $service->deleteExamination($exam_id);

            return redirect()
            ->route('examination')
            ->with('success', 'Examination: '. $exam_id .' Successfully Deleted!');
        }catch(\Exception $e){
            return redirect()->route('examination')->with('error', 'Uh-oh!, Something when wrong');
        }
    }

}
