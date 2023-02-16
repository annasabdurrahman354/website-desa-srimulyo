<?php

namespace App\Http\Livewire\Guest\Artikel;

use App\Models\Artikel;
use Livewire\Component;

class GuestArtikelShow extends Component
{
    public $artikel;

    public function mount($slug)
    {
        $this->artikel = Artikel::where('slug', $slug)->with(['penulis', 'kategori'])->first();
    }

    public function render()
    {
        return view('livewire.guest.artikel.show')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
