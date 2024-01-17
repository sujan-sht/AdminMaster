<div class="media-library
    {{ $multiple ? 'media-library-multiple' : 'media-library-single' }}
    {{ $sortable ? 'media-library-sortable' : '' }}
    {{ count($sortedMedia) == 0 ? 'media-library-empty' : 'media-library-filled' }}"
wire:init="loadMedia">
    @include('media-library::livewire.partials.list-error')

    @include($listView)

    <div class="{{ !$this->allowsUploads() ? 'media-library-hidden' : 'media-library-uploader' }}">
        <livewire:media-library-uploader
            :key="'media-library-' . $this->name"
            :name="$this->name"
            :rules="$rules"
            :accept="$accept"
            :multiple="$multiple"
            :add="true"
        />
    </div>
</div>
