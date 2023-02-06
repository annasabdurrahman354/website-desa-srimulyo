<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('aparatur_desa_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="AparaturDesa" format="csv" />
                <livewire:excel-export model="AparaturDesa" format="xlsx" />
                <livewire:excel-export model="AparaturDesa" format="pdf" />
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
                            {{ trans('cruds.aparaturDesa.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.aparaturDesa.fields.nama') }}
                            @include('components.table.sort', ['field' => 'nama'])
                        </th>
                        <th>
                            {{ trans('cruds.aparaturDesa.fields.foto') }}
                        </th>
                        <th>
                            {{ trans('cruds.aparaturDesa.fields.posisi') }}
                            @include('components.table.sort', ['field' => 'posisi'])
                        </th>
                        <th>
                            {{ trans('cruds.aparaturDesa.fields.is_aktif') }}
                            @include('components.table.sort', ['field' => 'is_aktif'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aparaturDesas as $aparaturDesa)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $aparaturDesa->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $aparaturDesa->id }}
                            </td>
                            <td>
                                {{ $aparaturDesa->nama }}
                            </td>
                            <td>
                                @foreach($aparaturDesa->foto as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $aparaturDesa->posisi }}
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $aparaturDesa->is_aktif ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('aparatur_desa_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.aparatur-desas.show', $aparaturDesa) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('aparatur_desa_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.aparatur-desas.edit', $aparaturDesa) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('aparatur_desa_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $aparaturDesa->id }})" wire:loading.attr="disabled">
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
            {{ $aparaturDesas->links() }}
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