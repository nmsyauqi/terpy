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
        // 1. Pecah berdasarkan koma
        $parts = explode(',', $this->corString);

        // 2. Bersihkan spasi (misal user ketik "12,  64" jadi "12","64")
        $parts = array_map('trim', $parts);

        // 3. Cek apakah ada 3 bagian?
        if (count($parts) !== 3) {
            return false; // Gagal kalau tidak ada 3 angka
        }

        // 4. Pastikan semuanya angka
        if (!is_numeric($parts[0]) || !is_numeric($parts[1]) || !is_numeric($parts[2])) {
            return false;
        }

        // 5. Kembalikan hasil bersih
        return [
            'x' => (int)$parts[0],
            'y' => (int)$parts[1],
            'z' => (int)$parts[2],
        ];
    }

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

        $coords = $this->parseCors(); // <--- Sesuaikan dengan nama fungsi private di atas

        if (!$coords) {
            $this->addError('corString', 'Format salah! Gunakan: X, Y, Z (Contoh: 100, 64, -200)');
            return;
        }

        Derp::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'desc' => $this->desc,
            // Masukkan hasil potongan ke database
            'cor_x' => $coords['x'],
            'cor_y' => $coords['y'],
            'cor_z' => $coords['z']
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
        $this->corString = "{$derp->cor_x}, {$derp->cor_y}, {$derp->cor_z}";
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();
        $coords = $this->parseCors();
        
        if (!$coords) {
            $this->addError('corString', 'Format salah! Gunakan: X, Y, Z');
            return;
        }

        if ($this->derpId) {
            $derp = Derp::findOrFail($this->derpId);
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
        Derp::find($id)->delete();
        $this->loadDerp();
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
