<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class StaffSummaryReportController extends Controller
{
    public function index()
    {
        // Fetch appointment counts
        $attendedCount = Appointment::where('status', 'completed')->count();
        $cancelledCount = Appointment::where('status', 'cancelled')->count();
        $totalAppointments = $attendedCount + $cancelledCount;
        $attendedPercentage = ($totalAppointments > 0) ? ($attendedCount / $totalAppointments) * 100 : 0;

        // Return the view with data
        return view('staff-summary-report', [
            'attendedCount' => $attendedCount,
            'cancelledCount' => $cancelledCount,
            'totalAppointments' => $totalAppointments,
            'attendedPercentage' => $attendedPercentage
        ]);
    }
}
