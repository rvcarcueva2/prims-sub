<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\ClinicStaff;
use Carbon\Carbon;

class MedicalRecordController extends Controller
{
    public $archiveRecord, $appointmentId, $appointment;

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

    public function create(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $appointment = Appointment::with('patient')->find($appointmentId);

        return view('livewire.add-medical-record', 
        [
            // 'patient' => $appointment->patient,
            // 'appointmentId' => $appointment->id,
            'email' => $appointment->patient->email,
            'apc_id_number' => $appointment->patient->apc_id_number,
            'first_name' => $appointment->patient->first_name,
            'mi' => $appointment->patient->middle_initial,
            'last_name' => $appointment->patient->last_name,
            'dob' => $appointment->patient->date_of_birth,
            'gender' => $appointment->patient->gender,
            'street_number' => $appointment->patient->street_number,
            'barangay' => $appointment->patient->barangay,
            'city' => $appointment->patient->city,
            'province' => $appointment->patient->province,
            'zip_code' => $appointment->patient->zip_code,
            'country' => $appointment->patient->country,
            'contact_number' => $appointment->patient->contact_number,
            'nationality' => $appointment->patient->nationality,
            'age' => Carbon::parse($appointment->patient->date_of_birth)->age,
        ]);
    }

}

// MedicalRecordController.php
