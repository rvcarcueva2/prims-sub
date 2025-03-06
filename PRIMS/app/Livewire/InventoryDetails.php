<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;

class InventoryDetails extends Component
{
    public $inventory;

    public function mount($id)
    {
        $this->inventory = Inventory::with('supply')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.inventory-details', [
            'inventory' => $this->inventory
        ]);
    }
}
