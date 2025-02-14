<!DOCTYPE html>
<html>
<head>
    <title>Appointment Notification</title>
</head>
<body>
    <p>Dear Nurse Ana,</p>
    <p>{{ $appointment->patient->first_name }} {{ $appointment->patient->middle_initial }}. {{ $appointment->patient->last_name }} booked an appointment on {{ $appointment->appointment_date }}.</p>
    <p>Reason for visit: {{ $appointment->reason_for_visit }}</p>

    <p>Thank you,
    <br>PRIMS - APC Clinic</p>
</body>
</html>