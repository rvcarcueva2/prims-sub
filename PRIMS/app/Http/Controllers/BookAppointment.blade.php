<?php
use App\Services\GoogleCalendarService;
use App\Notifications\AppointmentBooked;
use Illuminate\Support\Facades\Notification;

// Save appointment in DB (example)
$appointment = Appointment::create([
    'patient_name' => request('patient_name'),
    'doctor_name' => request('doctor_name'),
    'date' => request('date'),
    'time' => request('time'),
    'patient_email' => request('patient_email'),
    'doctor_email' => request('doctor_email')
]);

// Add event to Google Calendar
$googleCalendar = new GoogleCalendarService();
$calendarLink = $googleCalendar->createEvent($appointment);

// Send confirmation email with Calendar link
mail($appointment->patient_email, "Appointment Confirmed", "Your appointment has been scheduled. View here: " . $calendarLink);

// **Trigger Notification After Booking (Added Code)**
Notification::route('mail', $appointment->patient_email)
    ->notify(new AppointmentBooked($appointment));

Notification::route('mail', $appointment->doctor_email)
    ->notify(new AppointmentBooked($appointment));

?>