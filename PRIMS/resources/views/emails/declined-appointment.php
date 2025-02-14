<!DOCTYPE html>
<html>
<head>
    <title>Appointment Status</title>
</head>
<body>
    <p>Dear {{ $appointment->patient->first_name }} {{ $appointment->patient->middle_initial }}. {{ $appointment->patient->last_name }},</p>
    <p>We are soorry to inform you that your appointment on {{ $appointment->appointment_date }} has been declined due to *insert reasons*.</p>

    <p>Kindly book another appointment.</p>

    <p>Thank you for your consideration.</p>

    <p>Thank you,
    <br>PRIMS - APC Clinic</p>
</body>
</html>