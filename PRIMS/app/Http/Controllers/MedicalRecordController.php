<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;

class MedicalRecordController extends Controller
{
    public function show($id)
    {
        $record = MedicalRecord::findOrFail($id);
        return view('view-medical-record', compact('record'));
    }
}
