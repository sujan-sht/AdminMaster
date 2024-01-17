<?php

namespace Spatie\MediaLibraryPro\Livewire\Concerns;

/** @mixin \Livewire\Component */
trait WithMedia
{
    public function bootWithMedia(): void
    {
        $this->listeners["resetErrorBag"] = 'onResetErrorBag';
    }

    public function onResetErrorBag($field): void
    {
        $this->resetErrorBag($field);
    }

    public function renderingWithMedia(): void
    {
        $this->dispatch("mediaComponentValidationErrors", $this->getErrorBag()->toArray());
    }
}
