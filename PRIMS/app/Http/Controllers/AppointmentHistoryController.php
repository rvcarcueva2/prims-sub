<?php

namespace App\Http\Controllers;

use App\Models\AppointmentHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentHistoryController extends Controller
{
    public function showAppointmentHistory()
    {
        $appointmentHistory = Appointment::where('patient_id', Auth::id())
        ->orderBy('appointment_date', 'desc')
        ->get();

        $user = Auth::user();
        if (!$user || !$user->hasRole('patient')) {
            abort(403); // Forbidden
        }

        $hasUpcomingAppointment = Appointment::where('patient_id', Auth::id())
            ->where('appointment_date', '>=', Carbon::now())
            ->where('status', 'approved')
            ->orderBy('appointment_date', 'asc') // Get the next closest appointment
            ->first();

        return view('appointment-history', compact('appointmentHistory', 'hasUpcomingAppointment')); 
    }
}