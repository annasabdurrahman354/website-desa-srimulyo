<?php

namespace App\Http\Livewire\Admin\KategoriArtikel;

use App\Models\KategoriArtikel;
use Livewire\Component;

class Edit extends Component
{
    public KategoriArtikel $kategoriArtikel;

    public function mount(KategoriArtikel $kategoriArtikel)
    {
        $this->kategoriArtikel = $kategoriArtikel;
    }

    public function render()
    {
        return view('livewire.admin.kategori-artikel.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->kategoriArtikel->save();

        return redirect()->route('admin.kategori-artikels.index');
    }

    protected function rules(): array
    {
        return [
            'kategoriArtikel.kategori' => [
                'string',
                'required',
                'unique:kategori_artikels,kategori,' . $this->kategoriArtikel->id,
            ],
        ];
    }
}
