<?php

namespace App\Livewire;

use App\Models\Buyer;
use App\Models\Property;
use Livewire\Component;

class PropertyDetail extends Component
{
    public $property;
    public $name, $email, $phone;

    public function mount($id)
    {
        $this->property = Property::findOrFail($id);
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        Buyer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'property_id' => $this->property->id,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Pendaftaran berhasil dikirim!');
        $this->reset(['name', 'email', 'phone']);
    }

    public function render()
    {
        return view('livewire.property-detail');
    }
}
