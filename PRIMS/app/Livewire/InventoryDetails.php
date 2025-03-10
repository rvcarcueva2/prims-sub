<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\Dispensed;
use Illuminate\Support\Facades\DB;

class InventoryDetails extends Component
{
    public $inventory;
    public $showDispenseModal = false;
    public $showDisposeModal = false;
    public $patientId;
    public $amountDispensed;

    public function mount($id)
    {
        $this->inventory = Inventory::with('supply')->findOrFail($id);
    }

    public function dispense()
    {
        $this->validate([
            'patientId' => 'required|exists:patients,id',
            'amountDispensed' => 'required|integer|min:1|max:' . $this->inventory->quantity_remaining,
        ]);

        DB::transaction(function () {
            // Deduct the dispensed amount
            $this->inventory->decrement('quantity_remaining', $this->amountDispensed);

            // Log the dispensation
            Dispensed::create([
                'inventory_id' => $this->inventory->id,
                'patient_id' => $this->patientId,
                'quantity_dispensed' => $this->amountDispensed,
                'date_dispensed' => now(),
                'dispensed_by' => auth()->id(),
            ]);
        });

        // Close modal and reset inputs
        $this->showDispenseModal = false;
        $this->reset(['patientId', 'amountDispensed']);

        // Show success message
        session()->flash('message', 'Medicine dispensed successfully.');
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

    public function render()
    {
        return view('livewire.inventory-details', [
            'inventory' => $this->inventory
        ]);
    }
}
