<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProductForm extends Form
{
    public string|Product $model = Product::class;

    #[Rule('required|string|max:256', as: 'name')]
    public string $name = '';

    #[Rule('nullable|string|max:256', as: 'code')]
    public string|null $code = '';

    #[Rule('nullable|image|mimes:jpg,png|max:10240', as: 'cover image')] //10 MB
    public $image;

    public $currentImage;

    #[Rule('nullable|string|max:100000', as: 'note')]
    public string|null $note = '';

    private array $attributes = ['name', 'code', 'note'];


    public function setup($model): void
    {
        $this->model = $model;

        $this->name = $model->name;
        $this->code = $model->code;
        $this->currentImage = $model->getFirstMedia('image')?->getUrl('preview') ?? '';
        $this->note = $model->note;
    }

    public function store(): void
    {
        $this->validate();

        $model = new $this->model;

        $array = array_merge($this->only($this->attributes), [
            'number' => Product::generateNumber()
        ]);

        $model = $model->create($array);

        if ($this->image) {
            $name = uniqid();
            $model->addMedia($this->image)
                ->usingName($name)
                ->usingFilename($name . '.' . $this->image->getClientOriginalExtension())
                ->preservingOriginal()
                ->toMediaCollection('image');
        }

        $this->model = $model;
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(): void
    {
        $this->validate();

        if ($this->image) {

            $this->model->clearMediaCollection('image');

            $name = uniqid();
            $this->model->addMedia($this->image)
                ->usingName($name)
                ->usingFilename($name . '.' . $this->image->getClientOriginalExtension())
                ->preservingOriginal()
                ->toMediaCollection('image');
        }

        $this->model?->update($this->only($this->attributes));
    }


}
