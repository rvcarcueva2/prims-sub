<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\Dispensed;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class InventoryDetails extends Component
{
    public $inventory;
    public $showDispenseModal = false;
    public $showDisposeModal = false;
    public $inventoryId;
    public $patientId = '';
    public $selectedPatient;
    public $amountDispensed;

    public function mount($id)
    {
        $this->inventory = Inventory::with('supply')->findOrFail($id);
    }

    public function updatedPatientId()
    {
        $this->selectedPatient = Patient::where('apc_id_number', $this->patientId)->first();
    }

    public function dispense()
    {
        $clinicStaff = DB::table('clinic_staff')->where('user_id', auth()->id())->first();

        // Calculate the total amount dispensed for this inventory item
            $totalDispensed = DB::table('dispensed')
            ->where('inventory_id', $this->inventory->id)
            ->sum('quantity_dispensed');

        // Compute remaining stock dynamically
        $quantityRemaining = $this->inventory->quantity_received - $totalDispensed;

        // Validate input with the dynamically calculated remaining stock
        $this->validate([
            'patientId' => 'required|exists:patients,apc_id_number',
            'amountDispensed' => 'required|integer|min:1|max:' . $quantityRemaining,
        ]);

        DB::transaction(function () use ($clinicStaff) {
            Dispensed::create([
                'inventory_id' => $this->inventory->id,
                'patient_id' => $this->selectedPatient->id,
                'quantity_dispensed' => $this->amountDispensed,
                'date_dispensed' => now(),
                'dispensed_by' => $clinicStaff->id,
            ]);
        });

        // Close modal and reset inputs
        $this->showDispenseModal = false;
        $this->reset(['patientId', 'amountDispensed']);

        // Show success message
        session()->flash('message', 'Medicine dispensed successfully.');
        $this->reset(['patientId', 'amountDispensed', 'selectedPatient']);
        $this->showDispenseModal = false;
    }

    public function confirmDispose()
    {
        DB::transaction(function () {
            $this->inventory->delete();
        });

        session()->flash('dispose-message', 'Medicine disposed successfully.');
        
        return redirect()->route('medical-inventory');
    }

    public function openDisposeModal()
    {
        $this->showDisposeModal = true;
    }

    public function openDispenseModal()
    {
        $this->showDispenseModal = true;
    }

    public function closeDispenseModal()
    {
        $this->showDispenseModal = false;
        $this->reset(['patientId', 'amountDispensed', 'selectedPatient']);
    }

    public function render()
    {
        return view('livewire.inventory-details', [
            'inventory' => $this->inventory
        ]);
    }
}
