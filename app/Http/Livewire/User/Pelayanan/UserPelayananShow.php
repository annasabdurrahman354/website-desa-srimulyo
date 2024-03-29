<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Models\Pelayanan;
use Livewire\Component;

class UserPelayananShow extends Component
{
    public Pelayanan $pelayanan;
    public $berkasPelayananByType;
  
    public function mount(Pelayanan $pelayanan)
    {
        $this->pelayanan =  $pelayanan->load('pemohon', 'jenisLayanan');
        if ($pelayanan->pemohon_id != auth()->user()->id) {
            abort(403, 'Access denied');
        }
        $this->berkasPelayananByType =  $pelayanan->berkasPelayananByType();
    }

    public function nilai(){
        $this->validate();
        $this->pelayanan->save();
        redirect(route("user.pelayanan.show", $this->pelayanan));
    }

    protected function rules(): array
    {
        return [
            'pelayanan.rating' => [
                'required',
                'in:' . implode(',', array_keys($this->pelayanan::RATING_RADIO)),
            ],
            'pelayanan.penilaian_pemohon' => [
                'string',
                'nullable',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.user.pelayanan.show')->extends('layouts.user');
    }
}
