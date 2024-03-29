<?php

namespace App\Http\Livewire\Guest\Umkm;

use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Umkm;
use Livewire\Component;
use Livewire\WithPagination;

class GuestUmkmEtalasae extends Component
{
    use WithPagination;

    public $umkm;

    public $kategoris = [];

    public string $kategoriNama = 'Semua Kategori';

    public string $kategoriId = "";

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setKategori($kategoriId, $kategoriNama){
        $this->kategoriNama = $kategoriNama;
        $this->kategoriId = $kategoriId;
    }

    public function mount($slug)
    {
        $this->umkm = Umkm::where('slug', $slug)->firstOrFail();
        if(request()->kategori){
            $this->kategoriId          = request()->kategori;
            if(KategoriProduk::where('id', $this->kategoriId)->first()){
                $this->kategoriNama        = KategoriProduk::where('id', $this->kategoriId)->first()->kategori;
            }
        }
        if(request()->search){
            $this->search = request()->search;
        }
        $this->kategoris    = $this->umkm->produks->pluck('kategori')->unique();
    }

    public function render()
    {
        if($this->umkm->is_aktif == false) {
            $message = "UMKM tidak diaktifkan oleh pemilik!";
            $route = route('guest.umkm.index');
            return view('livewire.guest.guest-error', compact('message', 'route'))->extends('layouts.guest');
        }

        $query = Produk::with(['satuan', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $produks = $query->where('umkm_id', $this->umkm->id);
        if($this->kategoriId != ""){
            $produks = $produks->where('kategori_id', $this->kategoriId);
        }
        $produks = $produks->where('is_tampilkan', true)->paginate(9);

        return view('livewire.guest.umkm.umkm-etalase', compact('produks', 'query'))->extends('layouts.guest');
    }
}
