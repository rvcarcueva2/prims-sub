<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalRecord;

class ArchiveMedicalRecord extends Component
{
    public function archiveRecord($id)
    {
        MedicalRecord::where('id', $id)->update(['archived_at' => now()]);

        session()->flash('message', 'Medical Record archived successfully.');
    }

    public function render()
    {
        return view('livewire.archive-medical-record');
    }
}
