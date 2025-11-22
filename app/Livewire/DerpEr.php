<?php

namespace App\Livewire;

use Livewire\Component;

class DerpEr extends Component
{
    public $derps;
    public $name, $desc, $cor_x, $cor_y, $cor_z;

    protected $rules = [
        'name' => 'required|string|max:64',
        'desc' => 'nullable|string',
        'cor_x' => 'nullable|integer',
        'cor_y' => 'nullable|integer',
        'cor_z' => 'nullable|integer'
    ];
    public function loadDerp()
    {
        $this->derps = Derp::where('user_id', Auth::id)
                            ->latest()
                            ->get();
    }

    public function saveDerp()
    {
        $this->validate([
            'name' => 'required|string|max:64',
            'desc' => 'nullable|string',
            'cor_x' => 'nullable|integer',
            'cor_y' => 'nullable|integer',
            'cor_z' => 'nullable|integer'
        ]);

        Derp::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'desc' => $this->desc,
            'cor_x' => $this->cor_x,
            'cor_y' => $this->cor_y,
            'cor_z' => $this->cor_z
        ]);

        $this->name = '';
        $this->desc = '';
        $this->cor_x = null;
        $this->cor_y = null;
        $this->cor_z = null;
        $this->loadDerp();

        $this->reset();
    }
    public function render()
    {
        return view('livewire.derp-er');
    }
}
