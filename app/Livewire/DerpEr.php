<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Derp;
use Illuminate\Support\Facades\Auth;

class DerpEr extends Component
{
    public $derps;
    public $name, $desc, $corString;
    public $derpId;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:64',
        'desc' => 'nullable|string',
        'corString' => 'required|string',
    ];

    private function parseCors()
    {
        $parts = explode(',', $this->corString);
        $parts = array_map('trim', $parts);

        if (count($parts) !== 3) {
            return false;
        }

        if (!is_numeric($parts[0]) || !is_numeric($parts[1]) || !is_numeric($parts[2])) {
            return false;
        }

        return [
            'x' => (int)$parts[0],
            'y' => (int)$parts[1],
            'z' => (int)$parts[2],
        ];
    }

    public function mount()
    {
        if (Auth::check() && session()->has('pending_waypoint')) {
            $data = session()->pull('pending_waypoint');
            
            $this->name = $data['name'];
            $this->desc = $data['desc'];
            $this->corString = $data['corString'];

            $this->store();
        }

        $this->loadDerp();
    }

    public function loadDerp()
    {
        if (Auth::check()) {
            $this->derps = Derp::where('user_id', Auth::id())
                            ->latest()
                            ->get();
        } else {
            $this->derps = collect();
        }
    }

    public function store()
    {
        $this->validate();

        if (!Auth::check()) {
            session()->put('pending_waypoint', [
                'name' => $this->name,
                'desc' => $this->desc,
                'corString' => $this->corString,
            ]);

            return redirect()->route('login');
        }

        $coords = $this->parseCors();

        if (!$coords) {
            $this->addError('corString', 'Format salah! Gunakan: X, Y, Z (Contoh: 100, 64, -200)');
            return;
        }

        Derp::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'desc' => $this->desc,
            'cor_x' => $coords['x'],
            'cor_y' => $coords['y'],
            'cor_z' => $coords['z']
        ]);

        $this->resetInput();
        session()->flash('message', 'Waypoint Saved!');
        
        $this->loadDerp();
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $derp = Derp::findOrFail($id);
        
        if ($derp->user_id !== Auth::id()) {
            return;
        }

        $this->derpId = $id;
        $this->name = $derp->name;
        $this->desc = $derp->desc;
        $this->corString = "{$derp->cor_x}, {$derp->cor_y}, {$derp->cor_z}";
        $this->isEditing = true;
    }

    public function update()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();
        $coords = $this->parseCors();
        
        if (!$coords) {
            $this->addError('corString', 'Format salah! Gunakan: X, Y, Z');
            return;
        }

        if ($this->derpId) {
            $derp = Derp::findOrFail($this->derpId);
            
            if ($derp->user_id !== Auth::id()) {
                return;
            }

            $derp->update([
                'name' => $this->name,
                'desc' => $this->desc,
                'cor_x' => $coords['x'],
                'cor_y' => $coords['y'],
                'cor_z' => $coords['z']
            ]);
            
            $this->resetInput();
            session()->flash('message', 'Waypoint Updated!');
        }
    }

    public function delete($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $derp = Derp::find($id);
        
        if ($derp && $derp->user_id === Auth::id()) {
            $derp->delete();
            $this->loadDerp();
        }
    }

    public function resetInput()
    {
        $this->name = '';
        $this->desc = '';
        $this->corString = ''; 
        $this->derpId = null;
        $this->isEditing = false;
        $this->loadDerp();    
    }

    public function render()
    {
        return view('livewire.derp-er');
    }
}