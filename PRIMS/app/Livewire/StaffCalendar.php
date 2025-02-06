<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment; // Make sure you have this model
use Carbon\Carbon;

class StaffCalendar extends Component
{
    public $currentDate;
    public $calendarDays = [];
    public $appointments = [];
    public $selectedDate;

    public function mount()
    {
        $this->currentDate = Carbon::now();
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
        $endOfMonth = $this->currentDate->copy()->endOfMonth();
        $startOfWeek = $startOfMonth->copy()->startOfWeek();
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
    }


    public function approveAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $appointment->status = 'approved';
        $appointment->save();
        $this->loadAppointments(); // Reload the appointments after approval
        $this->generateCalendar(); // Reload the calendar after approval
    }

    public function declineAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $appointment->status = 'declined';
        $appointment->save();
        $this->loadAppointments(); // Reload the appointments after decline
    }

    public function render()
    {
        return view('livewire.staff-calendar', [
            'currentMonthYear' => $this->currentDate->format('F Y'),
        ]);
    }
}
