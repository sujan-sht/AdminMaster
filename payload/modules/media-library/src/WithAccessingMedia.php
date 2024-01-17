<?php

namespace Spatie\MediaLibraryPro;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait WithAccessingMedia
{
    protected function getMedia(string $name, HasMedia $model, string $collection): array
    {
        return old($name) ? old($name) : $model
            ->getMedia($collection)
            ->map(function (Media $media) {
                return [
                    'name' => $media->name,
                    'file_name' => $media->file_name,
                    'uuid' => $media->uuid,
                    'preview_url' => $media->hasGeneratedConversion('preview') ? $media->getUrl('preview') : '',
                    'order' => $media->order_column,
                    'custom_properties' => $media->custom_properties,
                    'extension' => $media->extension,
                    'size' => $media->size,
                    'created_at' => $media->created_at->timestamp,
                ];
            })
            ->keyBy('uuid')
            ->toArray();
    }
}
