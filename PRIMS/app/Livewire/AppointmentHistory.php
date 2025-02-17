<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DoctorSchedule;

class AppointmentHistory extends Component
{
    public $patient;
    public $appointmentHistory;
    public $hasUpcomingAppointment;
    public $showCancelModal = false;
    public $cancelAppointmentId;
    public $cancelReason;
    public $showCancelSuccessModal = false;

    public function mount()
    {
        $this->patient = Auth::user()->patient;
        $this->appointmentHistory = Appointment::where('patient_id', $this->patient->id)->get();
        $this->hasUpcomingAppointment = Appointment::where('patient_id', $this->patient->id)
            ->where('appointment_date', '>=', now())
            ->whereIn('status', ['pending', 'approved'])
            ->first();
    }

    public function confirmCancel($appointmentId)
    {
        $this->cancelAppointmentId = $appointmentId;
        $this->showCancelModal = true;
    }

    public function cancelAppointment()
    {
        $appointment = Appointment::find($this->cancelAppointmentId);  true;

        // Refresh the appointment history and upcoming appointment
        $this->appointmentHistory = Appointment::where('patient_id', $this->patient->id)->get();
        $this->hasUpcomingAppointment = Appointment::where('patient_id', $this->patient->id)
            ->where('appointment_date', '>=', now())
            ->whereIn('status', ['pending', 'approved'])
            ->first();
    }

    public function render()
    {
        return view('livewire.appointment-history', [
            'appointmentHistory' => $this->appointmentHistory,
            'hasUpcomingAppointment' => $this->hasUpcomingAppointment,
        ]);
    }
}