<?php

namespace SujanSht\AdminMaster\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * AdminMaster User.
 */
trait SpartanImageUpload
{
    /**
     * Handle image model upload and deletion.
     *
     * @param mixed $model
     */
    protected function handleImageGallery($model,$fieldName)
    {
        // Handle deletion of previous images
        if (request()->has('previous_photos')) {
            $data = request('previous_photos');
            $previous_images = $model->getMedia($fieldName)->pluck('id')->toArray();
            $deleted_medias = array_diff($previous_images, $data);
            if (!empty($deleted_medias)) {
                foreach ($deleted_medias as $media_id) {
                    $media = Media::findOrFail($media_id);
                    $media->delete();
                }
            }
        }

        // Handle uploading new images
        if (request()->has($fieldName)) {
            foreach (request($fieldName) as $image) {
                $model
                    ->addMedia($image)
                    ->toMediaCollection($fieldName);
            }
        }
    }
}
