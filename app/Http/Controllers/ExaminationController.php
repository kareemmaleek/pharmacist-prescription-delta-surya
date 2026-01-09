<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function indexExamination()
    {
        return view('examination.index');
    }
}
