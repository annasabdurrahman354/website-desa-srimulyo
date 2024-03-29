<?php

namespace App\Http\Livewire\Admin\Carousel;

use App\Models\Carousel;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Carousel $carousel;

    public array $mediaToRemove = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    public function mount(Carousel $carousel)
    {
        $this->carousel         = $carousel;
        $this->mediaCollections = [
            'carousel_gambar' => $carousel->gambar,
        ];
    }

    public function render()
    {
        return view('livewire.admin.carousel.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->carousel->save();
        $this->syncMedia();

        return redirect()->route('admin.carousels.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->carousel->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        Carousel::where('id', $this->carousel->id)->first()->syncMediaName();
    }

    protected function rules(): array
    {
        return [
            'carousel.judul' => [
                'string',
                'required',
            ],
            'mediaCollections.carousel_gambar' => [
                'array',
                'required',
            ],
            'mediaCollections.carousel_gambar.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'carousel.link_tujuan' => [
                'string',
                'nullable',
            ],
            'carousel.is_aktif' => [
                'boolean',
            ],
        ];
    }
}
