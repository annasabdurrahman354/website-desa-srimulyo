@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.kategoriProduk.title_singular') }}:
                    {{ trans('cruds.kategoriProduk.fields.id') }}
                    {{ $kategoriProduk->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.kategori-produk.edit', [$kategoriProduk])
        </div>
    </div>
</div>
@endsection