<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalRecord; // Ensure the correct model is imported

class ViewMedicalRecord extends Component
{
    public $record;

    public function mount(MedicalRecord $record) // Laravel auto-resolves the record from the route
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.view-medical-record')
            ->layout('layouts.app'); // Ensure it uses the correct layout
    }
}


