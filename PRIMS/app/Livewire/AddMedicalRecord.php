<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalRecord;
use App\Models\Patient;

class AddMedicalRecord extends Component
{
    public $apc_id_number, $first_name, $last_name, $dob, $address, $reason, $description, $diagnosis, $allergies;

    public function searchPatient()
    {
        \Log::info('Searching for patient with ID: ' . $this->apc_id_number); // Debugging

        $patient = Patient::where('apc_id_number', $this->apc_id_number)->first();

        if ($patient) {
            \Log::info('Patient Found:', $patient->toArray()); // Debugging

            $this->first_name = $patient->first_name;
            $this->last_name = $patient->last_name;
            $this->dob = $patient->date_of_birth;
            $this->address = $patient->address;
            $this->contact_number = $patient->contact_number;
        } else {
            \Log::warning('No patient found for ID: ' . $this->apc_id_number);

            // Clear values
            $this->first_name = null;
            $this->last_name = null;
            $this->dob = null;
            $this->address = null;
            $this->contact_number = null;
        }
    }


    public function submit()
    {
        // dd($this->all()); // Debug: Check if all fields contain expected values
        
        $this->validate([
            'apc_id_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date',
            'address' => 'required',
            'reason' => 'required',
            'description' => 'required',
            'diagnosis' => 'required',
            'allergies' => 'nullable',
        ]);

        MedicalRecord::create([
            'apc_id_number' => $this->first_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'address' => $this->address,
            'reason' => $this->reason,
            'description' => $this->description,
            'diagnosis' => $this->diagnosis,
            'allergies' => $this->allergies,
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
