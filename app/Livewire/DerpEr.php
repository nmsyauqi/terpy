<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Derp;
use Illuminate\Support\Facades\Auth;

class DerpEr extends Component
{
    public $derps;
    public $name, $desc, $cor_x, $cor_y, $cor_z, $derpId;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:64',
        'desc' => 'nullable|string',
        'cor_x' => 'required|integer',
        'cor_y' => 'nullable|integer',
        'cor_z' => 'required|integer'
    ];

    public function mount()
    {
        $this->loadDerp();
    }
    public function loadDerp()
    {
        $this->derps = Derp::where('user_id', Auth::id())
                            ->latest()
                            ->get();
    }

    public function store()
    {
        $this->validate();

        Derp::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'desc' => $this->desc,
            'cor_x' => $this->cor_x,
            'cor_y' => $this->cor_y === '' ? null : $this->cor_y,
            'cor_z' => $this->cor_z
        ]);

        $this->resetInput();
        session()->flash('message', 'Waypoint Saved!');
    }

    public function edit($id)
    {
        $derp = Derp::findOrFail($id);
        
        $this->derpId = $id;
        $this->name = $derp->name;
        $this->desc = $derp->desc;
        $this->cor_x = $derp->cor_x;
        $this->cor_y = $derp->cor_y;
        $this->cor_z = $derp->cor_z;
        
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->derpId) {
            $derp = Derp::findOrFail($this->derpId);
            
            $derp->update([
                'name' => $this->name,
                'desc' => $this->desc,
                'cor_x' => $this->cor_x,
                // LOGIKA PERBAIKAN: Ubah string kosong jadi NULL
                'cor_y' => $this->cor_y === '' ? null : $this->cor_y,
                'cor_z' => $this->cor_z
            ]);
            
            $this->resetInput();
            session()->flash('message', 'Waypoint Updated!');
        }
    }

    public function delete($id)
    {
        Derp::find($id)->delete();
        $this->loadDerp();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->desc = '';
        $this->cor_x = '';
        $this->cor_y = '';
        $this->cor_z = '';
        $this->derpId = null;
        $this->isEditing = false;
        $this->loadDerp();
    }
    public function render()
    {
        return view('livewire.derp-er');
    }
}
