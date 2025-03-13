<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dispensed;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffSummaryReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->hasRole('clinic staff')) {
            abort(403); // Forbidden
        }

        // Get the month and year from the request, default to current month and year
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Fetch appointment counts
        $attendedCount = Appointment::where('status', 'completed')->count();
        $cancelledCount = Appointment::where('status', 'cancelled')->count();
        $totalAppointments = $attendedCount + $cancelledCount;
        $attendedPercentage = ($totalAppointments > 0) ? ($attendedCount / $totalAppointments) * 100 : 0;

        // Fetch the top 5 most prescribed medications for the given month and year
        $medications = Dispensed::select('inventory_id', \DB::raw('SUM(quantity_dispensed) as total_dispensed'))
            ->whereMonth('date_dispensed', $month)
            ->whereYear('date_dispensed', $year)
            ->groupBy('inventory_id')
            ->orderByDesc('total_dispensed')
            ->take(5) // Take top 5
            ->get()
            ->map(function($dispensed) {
                $inventory = $dispensed->inventory;
                return [
                    'name' => $inventory->supply->name, // Get the medication name from the supply model
                    'quantity_dispensed' => $dispensed->total_dispensed,
                ];
            });

        // Return the view with data
        return view('staff-summary-report', [
            'attendedCount' => $attendedCount,
            'cancelledCount' => $cancelledCount,
            'totalAppointments' => $totalAppointments,
            'attendedPercentage' => $attendedPercentage,
            'medications' => $medications,
            'selectedMonth' => $month,
            'selectedYear' => $year,
        ]);
    }
}
