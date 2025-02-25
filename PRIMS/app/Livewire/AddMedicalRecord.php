<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalRecord;

class AddMedicalRecord extends Component
{
    public $first_name, $last_name, $dob, $address, $reason, $description, $allergies;

    public function submit()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date',
            'address' => 'required',
            'reason' => 'required',
            'description' => 'required',
            'allergies' => 'nullable',
        ]);

        MedicalRecord::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'address' => $this->address,
            'reason' => $this->reason,
            'description' => $this->description,
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
