<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class PropertyList extends Component
{
    public function render()
    {
        return view('livewire.property-list', [
            'properties' => Property::where('status', 'available')->latest()->get(),
        ]);
    }
}
