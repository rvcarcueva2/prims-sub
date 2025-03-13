<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;

class MedicalRecordController extends Controller
{
    public $archiveRecord;

    public function view($id)
    {
        $record = MedicalRecord::findOrFail($id);
        return view('view-medical-record', compact('record'));
    }
    
    public function archiveRecord()
    {
        $archiveRecord = MedicalRecord::archived()->get();
        return view('archived-medical-records', compact('archiveRecord'));
    }
}

// MedicalRecordController.php
