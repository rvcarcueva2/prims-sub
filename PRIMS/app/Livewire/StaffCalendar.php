<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicStaff;

class StaffCalendar extends Component
{

    public $currentDate;
    public $calendarDays = [];
    public $appointments = [];
    public $selectedDate;
    public $approvedAppointments = [];

    

    public function mount()
    {
        $this->currentDate = Carbon::now('Asia/Manila');
        $this->selectedDate = Carbon::now('Asia/Manila')->toDateString();
        $this->generateCalendar();
        $this->loadAppointments();
    }

    public function changeMonth($offset)
    {
        $this->currentDate->addMonths($offset);
        $this->generateCalendar();
        $this->loadAppointments();
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;
        $this->loadAppointments(); // Fetch appointments for the selected date
    }

    public function generateCalendar()
    {
        $startOfMonth = $this->currentDate->copy()->startOfMonth();
        $startOfWeek = $startOfMonth->copy()->locale('en')->startOfWeek(Carbon::SUNDAY); 
        $endOfMonth = $this->currentDate->copy()->endOfMonth();
        $endOfWeek = $endOfMonth->copy()->endOfWeek();

        $this->calendarDays = [];

        // Fetch all pending appointments for the current month
        $pendingAppointments = Appointment::whereBetween('appointment_date', [$startOfMonth, $endOfMonth])
                                        ->where('status', 'pending')
                                        ->get();

        // Prepare a list of dates with pending appointments
        $pendingDates = $pendingAppointments->map(function($appointment) {
            return \Carbon\Carbon::parse($appointment->appointment_date)->toDateString();
        })->toArray();

        for ($date = $startOfWeek->copy(); $date->lte($endOfWeek); $date->addDay()) {
            $this->calendarDays[] = [
                'day' => $date->day,
                'date' => $date->toDateString(),
                'isToday' => $date->isToday(),
                'isCurrentMonth' => $date->month === $this->currentDate->month,
                'hasPendingAppointments' => in_array($date->toDateString(), $pendingDates),
            ];
        }
    }


    public function loadAppointments()
    {
        // Eager load the 'patient' relationship to avoid the null error
        $this->appointments = Appointment::whereDate('appointment_date', $this->selectedDate ?? $this->currentDate->toDateString())
            ->where('status', 'pending')
            ->with('patient') // Make sure to eager load the patient relationship
            ->get();

        $this->approvedAppointments = Appointment::whereDate('appointment_date', $this->selectedDate)
            ->where('status', 'approved')
            ->orderBy('appointment_date', 'asc')
            ->get();
    }

    public function approveAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if ($appointment) {

            $clinicStaffId = ClinicStaff::where('user_id', Auth::id())->value('id');

            $appointment->status = 'approved';
            $appointment->status_updated_by = $clinicStaffId;
            $appointment->save();

            $this->loadAppointments();
            $this->generateCalendar();
        }
    }

    public function declineAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $clinicStaffId = ClinicStaff::where('user_id', Auth::id())->value('id'); 

            $appointment->status = 'declined';
            $appointment->status_updated_by = $clinicStaffId; 
            $appointment->save();

            $this->loadAppointments();
            $this->generateCalendar();
        }
    }

    public function updateAppointmentStatus($appointmentId, $newStatus)
    {
        $clinicStaffId = ClinicStaff::where('user_id', Auth::id())->value('id');

        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = $newStatus;
        $appointment->status_updated_by = $clinicStaffId;
        $appointment->save();

        session()->flash('success', 'Appointment status updated successfully.');
    }

    public function render()
    {
        return view('livewire.staff-calendar', [
            'currentMonthYear' => $this->currentDate->format('F Y'),
        ]);
    }
}
