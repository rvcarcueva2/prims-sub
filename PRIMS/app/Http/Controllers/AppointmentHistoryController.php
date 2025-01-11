<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentHistory;
use Illuminate\Support\Facades\Auth;

class AppointmentHistoryController extends Controller
{
    public function showAppointmentHistory()
    {
        $appointmentHistory = AppointmentHistory::all(); // Fetch all records

        $user = Auth::user();
        if (!$user || !$user->hasRole('patient')) {
            abort(403); // Forbidden
        }

        return view('appointment-history', compact('appointmentHistory')); // Pass to the view
    }
}