<?php

namespace App\Http\Controllers;

use App\Http\Requests\patient\NewPatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function indexPatient()
    {
        $query = Patient::query();

        $patients = $query->paginate(15)->withQueryString();

        return view('patient.index', compact('patients'));
    }

    public function indexNewPatient()
    {
        return view('patient.newpatient');
    }

    public function proceedNewPatient(NewPatientRequest $request, PatientService $service)
    {

        if(Auth::user()->role !== 0) return redirect()->back()->with('error', 'No Permission!');

        $service->createNewPatient($request->validated());

        return redirect()
        ->route('patient')
        ->with('success', 'New Patient Created Successfully!');
    }
}
