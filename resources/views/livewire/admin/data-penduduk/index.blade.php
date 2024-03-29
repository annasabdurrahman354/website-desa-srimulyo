<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('data_penduduk_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="DataPenduduk" format="csv" />
                <livewire:excel-export model="DataPenduduk" format="xlsx" />
                <livewire:excel-export model="DataPenduduk" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.dataPenduduk.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.judul') }}
                            @include('components.table.sort', ['field' => 'judul'])
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.slug') }}
                            @include('components.table.sort', ['field' => 'slug'])
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.tahun_pembaruan') }}
                            @include('components.table.sort', ['field' => 'tahun_pembaruan'])
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.deskripsi') }}
                            @include('components.table.sort', ['field' => 'deskripsi'])
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.berkas_data') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.is_grafik') }}
                            @include('components.table.sort', ['field' => 'is_grafik'])
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.is_tabel') }}
                            @include('components.table.sort', ['field' => 'is_tabel'])
                        </th>
                        <th>
                            {{ trans('cruds.dataPenduduk.fields.is_aktif') }}
                            @include('components.table.sort', ['field' => 'is_aktif'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataPenduduks as $dataPenduduk)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $dataPenduduk->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $dataPenduduk->id }}
                            </td>
                            <td>
                                {{ $dataPenduduk->judul }}
                            </td>
                            <td>
                                {{ $dataPenduduk->slug }}
                            </td>
                            <td>
                                {{ $dataPenduduk->tahun_pembaruan }}
                            </td>
                            <td class="line-clamp-6">
                                {{ $dataPenduduk->deskripsi }}
                            </td>
                            <td>
                                @foreach($dataPenduduk->berkas_data as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dataPenduduk->is_grafik ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dataPenduduk->is_tabel ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dataPenduduk->is_aktif ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('data_penduduk_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.data-penduduks.show', $dataPenduduk) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('data_penduduk_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.data-penduduks.edit', $dataPenduduk) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('data_penduduk_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $dataPenduduk->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $dataPenduduks->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush