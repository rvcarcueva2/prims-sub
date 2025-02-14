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
        $appointment = Appointment::find($this->cancelAppointmentId);
        if ($appointment) {
            $appointment->status = 'cancelled';
            $appointment->save();
        }

        $schedule = DoctorSchedule::where('doctor_id', $appointment->clinic_staff_id)
                ->where('date', Carbon::parse($appointment->appointment_date)->format('Y-m-d'))
                ->first();

        if ($schedule) {
            $availableTimes = json_decode($schedule->available_times, true) ?? [];

            // Add the canceled time back if it's not already there
            $newTime = Carbon::parse($appointment->appointment_date)->format('g:i A');
            if (!in_array($newTime, $availableTimes)) {
                $availableTimes[] = $newTime;
            }

            // Save the updated available times
            $schedule->update(['available_times' => json_encode($availableTimes)]);
        }

        $this->showCancelModal = false;
        $this->cancelReason = '';
        $this->cancelAppointmentId = null;
        $this->showCancelSuccessModal = true;

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