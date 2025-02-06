<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class StaffCalendar extends Component
{
    public $currentDate;
    public $calendarDays = [];
    public $appointments = [];

    public function mount()
    {
        $this->currentDate = Carbon::now();
        $this->generateCalendar();
    }

    public function changeMonth($offset)
    {
        $this->currentDate->addMonths($offset);
        $this->generateCalendar();
    }

    public function currentDate($date)
    {
        $this->currentDate = Carbon::parse($date);
        // $this->loadAppointments();
    }

    public $selectedDate;

    public function selectDate($date)
    {
        $this->selectedDate = $date;
    }

    public function generateCalendar()
    {
        $startOfMonth = $this->currentDate->copy()->startOfMonth();
        $endOfMonth = $this->currentDate->copy()->endOfMonth();
        $startOfWeek = $startOfMonth->copy()->startOfWeek();
        $endOfWeek = $endOfMonth->copy()->endOfWeek();

        $this->calendarDays = [];

        for ($date = $startOfWeek->copy(); $date->lte($endOfWeek); $date->addDay()) {
            $this->calendarDays[] = [
                'day' => $date->day,
                'date' => $date->toDateString(),
                'isToday' => $date->isToday(),
                'isCurrentMonth' => $date->month === $this->currentDate->month,
            ];
        }

        // $this->loadAppointments();
    }

    // public function loadAppointments()
    // {
    //     $this->appointments = Appointment::whereDate('appointment_date', $this->currentDate->toDateString())
    //         ->where('status', 'approved')
    //         ->with('patient')
    //         ->get();
    // }

    public function render()
    {
        return view('livewire.staff-calendar', [
            'currentMonthYear' => $this->currentDate->format('F Y'),
        ]);
    }
}
