@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.kategoriArtikel.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('kategori_artikel_create')
                    <a class="btn btn-indigo" href="{{ route('admin.kategori-artikels.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.kategoriArtikel.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('admin.kategori-artikel.index')

    </div>
</div>
@endsection