<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;


class MedicalInventory extends Component
{
    public $search = '';
    public $sortField = 'supplies.name';
    public $sortDirection = 'asc';
    public $itemIdToDispose;
    protected $listeners = ['disposeItem', 'show-confirm-modal'];

    public function updatedSearch()
    {
        $this->render();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmDisposal($itemId)
    {
        $this->itemIdToDispose = $itemId;
        $this->dispatch('show-confirm-modal'); 
    }

    public function disposeItem()
    {
        if ($this->itemIdToDispose) {
            Inventory::find($this->itemIdToDispose)?->delete();
            $this->itemIdToDispose = null;
            session()->flash('message', 'Item disposed successfully.');
        }
    }
    
    public function render()
    {
        $inventory = Inventory::with('supply')
            ->join('supplies', 'inventory.supply_id', '=', 'supplies.id')
            ->orderBy($this->sortField, $this->sortDirection) // Sort alphabetically by name
            ->select('inventory.*', 'supplies.name as supply_name', 'supplies.brand', 'supplies.category', 'supplies.dosage_strength', 'supplies.dosage_form')
            ->when(strlen($this->search) > 0, function ($query) { 
                $query->where(function ($q) {
                    $q->where('supplies.name', 'like', '%' . trim($this->search) . '%')
                      ->orWhere('supplies.brand', 'like', '%' . trim($this->search) . '%')
                      ->orWhere('supplies.category', 'like', '%' . trim($this->search) . '%');
                });
            })
            ->get();


        return view('livewire.medical-inventory', compact('inventory'));
    }
}
