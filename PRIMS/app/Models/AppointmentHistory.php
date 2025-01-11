<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentHistory extends Model
{
    protected $table = 'appointment_history';
    protected $fillable = [
        'student_number',
        'date',
        'time',
        'nurse_doctor',
        'status',
];
}
