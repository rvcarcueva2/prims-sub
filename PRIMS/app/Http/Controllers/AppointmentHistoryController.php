<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentHistory;

class AppointmentHistoryController extends Controller
{
    public function showAppointmentHistory()
    {
        $appointmentHistory = AppointmentHistory::all(); // Fetch all records
        return view('appointment-history', compact('appointmentHistory')); // Pass to the view
    }
}