<?php

namespace Spatie\MediaLibraryPro\Livewire;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use function Livewire\store;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibraryPro\Dto\ViewMediaItem;
use Spatie\MediaLibraryPro\WithAccessingMedia;

class LivewireMediaLibraryComponent extends Component
{
    use WithAccessingMedia;

    public ?string $name;
    public ?bool $multiple = null;
    public bool $sortable = true;
    public bool $editableName = true;
    public string|array $rules = [];
    public array $accept = [];
    public ?int $maxItems = null;

    #[Modelable]
    public array $media = [];

    public array $uploadedFiles = [];

    public ?HasMedia $model = null;
    public ?string $collection = null;
    public string $type;

    public ?string $view;
    public ?string $listView;
    public ?string $itemView;
    public ?string $propertiesView;
    public ?string $fieldsView;
    public ?string $listErrorMessage = null;

    public function mount(
        string $name = null,
        /** @property ?HasMedia */
        mixed $model = null,
        ?string $collection = null,
        bool $multiple = null,
        bool $sortable = true,
        bool $editableName = true,
        string|array $rules = [],
        array $accept = [],
        int $maxItems = null,
        array $media = [],
        string $view = null,
        string $listView = null,
        string $itemView = null,
        string $propertiesView = null,
        string $fieldsView = null,
    ): void {
        if ($collection && ! $model) {
            throw new Exception('Model is required when type is collection');
        }

        $this->name = $this->getBoundProperty() ?? $name ?? 'media';
        $this->model = $model;
        $this->collection = $collection;
        $this->type = ! is_null($collection) ? 'collection' : 'attachment';

        $this->media = $media ?? [];
        $this->multiple = $multiple ?? $this->type === 'collection';
        $this->sortable = $sortable;
        $this->editableName = $editableName;

        $this->rules = Arr::wrap($rules);
        $this->accept = $accept;
        $this->maxItems = $this->multiple ? $maxItems : 1;

        $this->view = $view ?? 'media-library::livewire.media-library';
        $this->listView = $listView ?? "media-library::livewire.partials.{$this->type}.list";
        $this->itemView = $itemView ?? "media-library::livewire.partials.{$this->type}.item";
        $this->propertiesView = $propertiesView ?? "media-library::livewire.partials.{$this->type}.properties";
        $this->fieldsView = $fieldsView ?? "media-library::livewire.partials.{$this->type}.fields";

        $this->listErrorMessage = $this->determineListErrorMessage();
    }

    public function loadMedia(): void
    {
        if (empty($this->media) && $this->type === 'collection') {
            $this->media = $this->getMedia($this->name, $this->model, $this->collection ?? 'default');
        }
    }

    public function getBoundProperty(): ?string
    {
        return array_search('media', store($this)->get('bindings') ?? []) ?: null;
    }

    protected function getListeners(): array
    {
        return [
            "{$this->name}:fileAdded" => 'onFileAdded',
            "{$this->name}:uploadError" => 'onUploadError',
            "{$this->name}:showListErrorMessage" => 'onShowListErrorMessage',
            "mediaComponentValidationErrors" => 'onMediaComponentValidationErrors',
        ];
    }

    public function onFileAdded(array $newMediaItem): void
    {
        if (! $this->allowsUpload($newMediaItem)) {
            return;
        }

        if (isset($this->media[$newMediaItem['oldUuid']])) {
            $existingMedia = $this->media[$newMediaItem['oldUuid']];
            $newMediaItem['order'] = $existingMedia['order'];

            unset($this->media[$newMediaItem['oldUuid']]);
        }

        $this->media[$newMediaItem['uuid']] = $newMediaItem;

        $this->media = collect($this->media)->sortBy('order')->toArray();
    }

    public function remove(string $uuid): void
    {
        $this->media = collect($this->media)
            ->reject(fn (array $mediaItem) => $mediaItem['uuid'] === $uuid)
            ->toArray();
    }

    public function allowsUpload(array $mediaItem): bool
    {
        if ($this->isReplacing($mediaItem)) {
            return true;
        }

        return $this->allowsUploads();
    }

    public function allowsUploads(): bool
    {
        if (is_null($this->maxItems)) {
            return true;
        }

        return (is_countable($this->media) ? count($this->media) : 0) < $this->maxItems;
    }

    public function isReplacing(array $newMediaItem): bool
    {
        if (! $newMediaItem['oldUuid']) {
            return false;
        }

        return collect($this->media)
            ->contains(fn (array $existingMediaItem): bool => $existingMediaItem['uuid'] === $newMediaItem['oldUuid']);
    }

    public function hideError(string $uuid): void
    {
        if (! isset($this->media[$uuid])) {
            return;
        }

        $this->media[$uuid]['hideError'] = true;
    }

    public function determineListErrorMessage(MessageBag $viewErrorBag = null): ?string
    {
        if ($viewErrorBag) {
            return $viewErrorBag->first($this->name);
        }

        $errors = session()->get('errors');

        if (! $errors instanceof ViewErrorBag) {
            return null;
        }

        return $errors->first($this->name);
    }

    public function clearListErrorMessage(): void
    {
        $this->listErrorMessage = null;
    }

    public function onUploadError(string $uuid, string $uploadError): void
    {
        if (! isset($this->media[$uuid])) {
            return;
        }

        $this->media[$uuid]['uploadError'] = $uploadError;
    }

    public function onShowListErrorMessage(string $message): void
    {
        $this->listErrorMessage = $message;
    }

    public function onMediaComponentValidationErrors(array $validationErrors): void
    {
        $property = $this->getBoundProperty();

        foreach ($validationErrors as $name => $error) {
            $name = str_replace("{$property}.", "media.", $name);
            $this->addError($name, $error);
        }
    }

    public function setCustomProperty(string $uuid, string $customPropertyName, $value): void
    {
        Arr::set($this->media, "{$uuid}.custom_properties.{$customPropertyName}", $value);

        $this->resetErrorBag();

        $property = $this->getBoundProperty();
        $this->dispatch("resetErrorBag", "{$property}.{$uuid}.custom_properties.{$customPropertyName}");
    }

    public function setNewOrder(array $newOrder): void
    {
        foreach ($newOrder as $newOrderItem) {
            Arr::set($this->media, "{$newOrderItem['uuid']}.order", $newOrderItem['order']);
        }

        $this->media = collect($this->media)
            ->sortBy('order')
            ->toArray();
    }

    public function render(): View
    {
        return view($this->view, [
            'sortedMedia' => collect($this->media)
                ->map(fn (array $mediaItem) => new ViewMediaItem($this->name, $mediaItem))
                ->sortBy('order')
                ->values(),
        ]);
    }
}
