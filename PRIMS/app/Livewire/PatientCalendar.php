<?php
namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClinicAppointmentNotif;
use App\Mail\PatientAppointmentNotif;


class PatientCalendar extends Component
{
    public $selectedDate;
    public $selectedTime;
    public $month;
    public $year;
    public $daysInMonth = [];
    public $availableTimes = [
        '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM',
        '11:30 AM', '12:00 PM', '12:30 PM', '1:00 PM',
        '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM'
    ];
    public $reasonForVisit;
    public $isConfirming = false; 
    public $hasUpcomingAppointment = false;

    public function mount()
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->generateCalendar();

        $this->hasUpcomingAppointment = Appointment::where('patient_id', Auth::id())
        ->where(function ($query) {
            $query->where('status', 'pending')
                  ->orWhere('appointment_date', '>=', Carbon::now());
        })
        ->exists();
    }

    public function generateCalendar()
    {
        $this->daysInMonth = [];
        $today = Carbon::today('Asia/Manila');
        $firstDay = Carbon::createFromDate($this->year, $this->month, 1)->dayOfWeek;
        $totalDays = Carbon::createFromDate($this->year, $this->month, 1)->daysInMonth;

        for ($i = 0; $i < $firstDay; $i++) {
            $this->daysInMonth[] = null;
        }

        for ($day = 1; $day <= $totalDays; $day++) {
            $date = Carbon::createFromDate($this->year, $this->month, $day)->toDateString();
            $this->daysInMonth[] = [
                'day' => $day,
                'date' => $date,
                'isToday' => $date === $today->toDateString()
            ];
        }
    }

    public function selectDate($date)
    {
        if (!is_numeric($date)) {
            return;
        }

        $this->selectedDate = Carbon::createFromDate($this->year, $this->month, (int) $date)->toDateString();
    }

    public function selectTime($time)
    {
        $this->selectedTime = $time;
    }

    // Show confirmation modal
    public function confirmAppointment()
    {
        // Ensure all required fields are set
        if (!$this->selectedDate || !$this->selectedTime || !$this->reasonForVisit) {
            session()->flash('error', 'Please select a date, time, and provide a reason.');
            return;
        }

        else $this->isConfirming = true;
    }

    // Handle the confirmation to book the appointment
    public function submitAppointment()
    {
        

        // Combine date and time into a valid DateTime format
        $appointmentDate = Carbon::createFromFormat('Y-m-d h:i A', $this->selectedDate . ' ' . $this->selectedTime);

        // Store the appointment
        $appointment = Appointment::create([
            'appointment_date' => $appointmentDate,
            'status' => 'pending',
            'reason_for_visit' => $this->reasonForVisit,
            'patient_id' => Auth::id(), // Ensure user is logged in
        ]);

        // Reset fields after submission
        $this->selectedDate = null;
        $this->selectedTime = null;
        $this->reasonForVisit = null;
        $this->isConfirming = false;  // Hide the confirmation modal

        session()->flash('success', 'Appointment successfully submitted!');

        Mail::to('prims.apc@gmail.com')->send(new ClinicAppointmentNotif($appointment));

        Mail::to(Auth::user()->email)->send(new PatientAppointmentNotif($appointment));
    }

    // Reset appointment selection if the patient cancels
    public function resetSelection()
    {
        $this->isConfirming = false;  // Hide the confirmation modal
        $this->selectedDate = null;
        $this->selectedTime = null;
        $this->reasonForVisit = null;
    }

    public function render()
    {
        return view('livewire.patient-calendar', [
            'monthName' => Carbon::create()->month((int) $this->month)->format('F'),
            'currentYear' => $this->year,
        ]);
    }
}
