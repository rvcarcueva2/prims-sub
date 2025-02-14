<?php
namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\ClinicStaff;
use App\Models\DoctorSchedule; // Assuming this is your table for doctor availability
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClinicAppointmentNotif;
use App\Mail\PatientAppointmentNotif;


class PatientCalendar extends Component
{
    public $patient;
    public $selectedDate;
    public $selectedTime;
    public $selectedDoctor;
    public $month;
    public $year;
    public $daysInMonth = [];
    public $availableTimes = [];
    public $reasonForVisit;
    public $doctors = [];
    public $availableDoctors = [];
    public $availableDates = [];
    public $isConfirming = false;
    public $hasUpcomingAppointment = false;
    public $showErrorModal = false;
    public $errorMessage = '';
    public $showSuccessModal = false;
    public $successMessage = '';
    public $existingAppointment = false;
    public $allTimes = [];

    public function mount()
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $this->patient = Auth::user()->patient;
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->generateCalendar();
        
        // Fetch all doctors initially
        $this->doctors = ClinicStaff::where('clinic_staff_role', 'doctor')->get();
        $this->fetchAvailableDoctors(); // Ensure availableDoctors is populated initially

        // Initialize all possible times
        $this->allTimes = [
            '7:30 AM', '8:00 AM', '8:30 AM', '9:00 AM', '9:30 AM',
            '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '12:00 PM', 
            '12:30 PM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM',
            '3:00 PM', '3:30 PM', '4:00 PM', '4:30 PM', '5:00 PM',
        ];
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
                'isToday' => $date === $today->toDateString(),
                'isAvailable' => false
            ];
        }

        $this->fetchAvailableDates();
    }

    public function selectDoctor($doctorId)
    {
        // If the same doctor is clicked again, unselect them
        if ($this->selectedDoctor && $this->selectedDoctor->id === $doctorId) {
            $this->selectedDoctor = null;
            $this->selectedDate = null;  // Reset date selection
            $this->selectedTime = null;  // Reset time selection
            $this->availableDates = [];
            $this->availableTimes = [];
            return;
        }
    
        // Select new doctor
        $this->selectedDoctor = ClinicStaff::find($doctorId);
        
        if ($this->selectedDoctor) {
            $this->fetchAvailableDates();
            $this->selectedDate = null;
            $this->selectedTime = null;
            $this->availableTimes = [];
        }
    }
    

    public function fetchAvailableDates()
    {
        if (!$this->selectedDoctor) {
            return;
        }

        $this->availableDates = DoctorSchedule::where('doctor_id', $this->selectedDoctor->id)
            ->pluck('date')
            ->toArray();

        // Update the calendar to highlight available dates
        foreach ($this->daysInMonth as &$day) {
            if ($day && in_array($day['date'], $this->availableDates)) {
                $day['isAvailable'] = true;
            }
        }
    }

    public function selectDate($date)
    {
        $formattedDate = Carbon::createFromDate($this->year, $this->month, (int) $date)->toDateString();
    
        // If the same date is clicked again, unselect it
        if ($this->selectedDate === $formattedDate) {
            $this->selectedDate = null;
            $this->selectedTime = null; // Reset time as well
            $this->availableTimes = [];
            return;
        }
    
        $this->selectedDate = $formattedDate;
        $this->fetchAvailableDoctors();
        $this->fetchAvailableTimes();
    }    

    public function fetchAvailableDoctors()
    {
        $this->availableDoctors = DoctorSchedule::where('date', $this->selectedDate)
            ->pluck('doctor_id')
            ->toArray();
    }

    public function fetchAvailableTimes()
    {
        if (!$this->selectedDoctor || !$this->selectedDate) return;
    
        $schedule = DoctorSchedule::where('doctor_id', $this->selectedDoctor->id)
            ->where('date', $this->selectedDate)
            ->first();
    
        // Ensure $availableTimes is always an array
        $availableTimes = is_array($schedule->available_times) 
            ? $schedule->available_times 
            : json_decode($schedule->available_times, true) ?? [];
    
        // Store available times properly
        $this->availableTimes = [];
        foreach ($this->allTimes as $time) {
            $this->availableTimes[] = [
                'time' => $time,
                'isAvailable' => in_array($time, $availableTimes) // Ensure only actual available slots are marked
            ];
        }
    }    


    public function selectTime($time)
    {
        // If the same time is clicked again, unselect it
        if ($this->selectedTime === $time) {
            $this->selectedTime = null;
            return;
        }
    
        $this->selectedTime = $time;
    }
    

    public function confirmAppointment()
    {
        if (!$this->selectedDate || !$this->selectedTime || !$this->reasonForVisit || !$this->selectedDoctor) {
            $this->errorMessage = 'Please select a date, time, doctor, and provide a reason.';
            $this->showErrorModal = true;
            return;
        }

        $this->isConfirming = true;
    }

    public function submitAppointment()
    {
        $appointmentDate = Carbon::createFromFormat('Y-m-d h:i A', $this->selectedDate . ' ' . $this->selectedTime);

        $existingAppointment = Appointment::where('patient_id', Auth::id())
            ->where(function ($query) {
                $query->whereIn('status', ['pending', 'approved'])
                    ->where('appointment_date', '>=', Carbon::now());
            })
            ->exists();

        if ($existingAppointment) {
            session()->flash('error', 'You already have an upcoming or pending appointment.');
            return;
        }

        $appointment = Appointment::create([
            'appointment_date' => $appointmentDate,
            'status' => 'pending',
            'reason_for_visit' => $this->reasonForVisit,
            'patient_id' => Auth::id(),
            'clinic_staff_id' => $this->selectedDoctor->id,
        ]);

        $this->resetSelection();        
        $this->hasUpcomingAppointment = true;
        $this->showSuccessModal = true;
        $this->successMessage = 'Your appointment request has been received.';
        session()->flash('success', 'Appointment successfully submitted!');

        Mail::to('prims.apc@gmail.com')->send(new ClinicAppointmentNotif($appointment));

        Mail::to(Auth::user()->email)->send(new PatientAppointmentNotif($appointment));
    }

    public function resetSelection()
    {
        $this->isConfirming = false;
        $this->selectedDate = null;
        $this->selectedTime = null;
        $this->selectedDoctor = null;
        $this->reasonForVisit = null;
        $this->availableTimes = [];
    }

    public function closeErrorModal()
    {
        $this->showErrorModal = false;
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
    }

    public function render()
    {
        return view('livewire.patient-calendar', [
            'monthName' => Carbon::create()->month((int) $this->month)->format('F'),
            'currentYear' => $this->year,
            'doctors' => $this->doctors,
            'availableDoctors' => $this->availableDoctors,
        ]);
    }
}
