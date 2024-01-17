<?php

namespace Spatie\MediaLibraryPro\Livewire;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\MediaLibraryPro\Actions\ConvertLivewireUploadToMediaAction;

class LivewireUploaderComponent extends Component
{
    use WithFileUploads {
        _uploadErrored as protected uploadErroredTrait;
    }

    public array $rules = [];

    public ?string $name;

    public TemporaryUploadedFile|array|null $upload = null;

    public ?string $uuid;

    public bool $multiple = false;

    public bool $add;

    public ?string $uploadError;

    public array $accept;

    public function mount(
        array $rules,
        string $name,
        bool $multiple = false,
        string $uuid = null,
        bool $add = false,
        array $accept = []
    ): void {
        $this->rules = $rules;
        $this->name = $name;
        $this->multiple = $multiple;
        $this->uuid = $uuid ?? (string)Str::uuid();
        $this->add = $add;
        $this->accept = $accept;
    }

    public function updatedUpload(): void
    {
        $uploadError = $this->getUploadError();

        if (! is_null($uploadError)) {
            $this->uploadError = $uploadError;

            if (! $this->add) {
                $this->dispatch("{$this->name}:uploadError", $this->uuid, $uploadError);
            }

            return;
        }

        $uploads = $this->multiple
            ? $this->upload
            : [$this->upload];

        foreach ($uploads as $upload) {
            $this->handleUpload($upload);
        }
    }

    protected function getUploadError(): ?string
    {
        $uploadError = null;

        $field = $this->multiple ? 'upload.*' : 'upload';

        try {
            $this->validate([
                $field => $this->rules,
            ], ["{$field}.mimes" => __('media-library::validation.type')]);
        } catch (ValidationException $validationException) {
            $uploadError = Arr::flatten($validationException->errors())[0];

            if ($this->add) {
                $this->dispatch("{$this->name}:showListErrorMessage", $uploadError);
            }
        }

        return $uploadError;
    }

    protected function handleUpload(TemporaryUploadedFile $upload): void
    {
        $media = (new ConvertLivewireUploadToMediaAction())->execute($upload);

        $this->dispatch("{$this->name}:fileAdded", [
            'name' => $media->name,
            'file_name' => $media->file_name,
            'oldUuid' => $this->uuid,
            'uuid' => $media->uuid,
            'preview_url' => $media->hasGeneratedConversion('preview') ? $media->getUrl('preview') : '',
            'order' => $media->order_column,
            'size' => $media->size,
            'mime_type' => $media->mime_type,
            'extension' => pathinfo($media->file_name, PATHINFO_EXTENSION),
        ]);
    }

    public function _uploadErrored($name, $errorsInJson, $isMultiple)
    {
        try {
            $this->uploadErroredTrait($name, $errorsInJson, $isMultiple);
        } catch (ValidationException $exception) {
            $uploadError = str_replace('.0', '', $exception->validator->errors()->first());

            $this->add
                ? $this->dispatch("{$this->name}:showListErrorMessage", $uploadError)
                : $this->dispatch("{$this->name}:uploadError", $this->uuid, $exception->validator->errors()->first());
        }
    }

    public function render()
    {
        return view('media-library::livewire.uploader');
    }
}
