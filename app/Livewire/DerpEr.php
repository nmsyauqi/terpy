<?php

namespace App\Livewire;

use Livewire\Component;

class DerpEr extends Component
{
    public $derps;
    public $title = '';
    public $content = '';
    public function loadDerp()
    {
        $this->derps = Derp::where('user_id', Auth::id)
                            ->latest()
                            ->get();
    }

    public function createDerp()
    {
        $this->validate([
            'title' => 'required|string|max:64',
            'content' => 'nullable|string',
        ]);

        Derp::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->reset(['title', 'content']);
        $this->loadDerp();
    }

    public function render()
    {
        return view('livewire.derp-er');
    }
}
