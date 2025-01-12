<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{

    /**
     * Display a listing of the patients.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

     /**
     * Show the details of a specific patient.
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        // Access the user's email via relationship
        $userEmail = $patient->user->email;

        return view('patients.show', compact('patient', 'userEmail'));
    }

}
