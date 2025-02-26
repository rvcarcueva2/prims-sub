<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalRecord;

class ViewMedicalRecord extends Component
{
    public $record;

    // Use $record instead of $id for proper binding
    public function mount(MedicalRecord $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.view-medical-record', ['record' => $this->record]);
    }
}



