<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalRecord;
use App\Models\Patient;

class AddMedicalRecord extends Component
{
    public $apc_id_number, $email, $first_name, $mi, $last_name, $contact_number, $dob, $gender, $address, $reason, $nationality, $description, $diagnosis, $allergies;

    public $past_medical_history = [
        'Mumps' => null,
        'Heart Disorder' => null,
        'Bleeding Problem' => null,
        'Hepatitis' => null,
        'Chicken Pox' => null,
        'Dengue' => null,
        'Kidney Disease' => null,
        'Covid-19' => null
    ];

    public $family_history = [
        'Bronchial Asthma' => null,
        'Diabetes Mellitus' => null,
        'Thyroid Disorder' => null,
        'Cancer' => null,
        'Hypertension' => null,
        'Liver Disease' => null,
        'Epilepsy' => null
    ];

    public $social_history = [
        'Smoker' => null,
        'Vape' => null,
        'Alcohol' => null,
        'Medications' => null
    ];

    public function searchPatient()
    {
        \Log::info('Searching for patient with ID: ' . $this->apc_id_number); // Debugging

        $patient = Patient::where('apc_id_number', $this->apc_id_number)->first();

        if ($patient) {
            \Log::info('Patient Found:', $patient->toArray()); // Debugging

            $this->email = $patient->email;
            $this->first_name = $patient->first_name;
            $this->mi = $patient->middle_initial;
            $this->last_name = $patient->last_name;
            $this->dob = $patient->date_of_birth;
            $this->gender = $patient->gender;
            $this->address = $patient->address;
            $this->contact_number = $patient->contact_number;
            $this->nationality = $patient->nationality;
        } else {
            \Log::warning('No patient found for ID: ' . $this->apc_id_number);

            // Clear values
            $this->email = null;
            $this->first_name = null;
            $this->mi = null;
            $this->last_name = null;
            $this->dob = null;
            $this->gender = null;
            $this->address = null;
            $this->contact_number = null;
            $this->nationality = null;
        }
    }


    public function submit()
    {
        // dd($this->all()); // Debug: Check if all fields contain expected values
        
        $this->validate([
            'email' => 'required',
            'apc_id_number' => 'required',
            'first_name' => 'required',
            'mi' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'contact_number' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'reason' => 'required',
            'description' => 'required',
            'diagnosis' => 'required',
            'allergies' => 'nullable',
            'past_medical_history' =>'required',
            'family_history' => 'required',
            'social_history' => 'required',
        ]);

        MedicalRecord::create([
            'email' => $this->email,
            'apc_id_number' => $this->first_name,
            'first_name' => $this->first_name,
            'mi' => $this->mi,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'contact_number' => $this->contact_number,
            'address' => $this->address,
            'nationality' => $this->nationality,
            'reason' => $this->reason,
            'description' => $this->description,
            'diagnosis' => $this->diagnosis,
            'allergies' => $this->allergies,
            'past_medical_history' => json_encode($this->past_medical_history),
            'family_history' => json_encode($this->family_history),
            'social_history' => json_encode($this->social_history),
            'last_visited' => now(),
        ]);

        $this->reset();

        $this->dispatch('recordAdded'); // Refresh table
    }

    public function render()
    {
        return view('livewire.add-medical-record');
    }
}
