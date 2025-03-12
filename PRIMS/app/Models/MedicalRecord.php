<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'apc_id_number',
        'first_name',
        'mi',
        'last_name',
        'dob',
        'gender',
        'contact_number',
        'street_number',
        'barangay',
        'city',
        'province',
        'zip_code',
        'country',
        'nationality',
        'reason',
        'description',
        'diagnosis',
        'allergies',
        'past_medical_history',
        'family_history',
        'social_history',
        'pe',
        'prescription',
    ];
}
