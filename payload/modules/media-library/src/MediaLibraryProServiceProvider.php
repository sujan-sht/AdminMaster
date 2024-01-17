<?php

namespace Spatie\MediaLibraryPro;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\MediaLibraryPro\Commands\DeleteTemporaryUploadsCommand;
use Spatie\MediaLibraryPro\Http\Components\MediaLibraryAttachmentComponent;
use Spatie\MediaLibraryPro\Http\Components\MediaLibraryCollectionComponent;
use Spatie\MediaLibraryPro\Http\Controllers\MediaLibraryPostS3Controller;
use Spatie\MediaLibraryPro\Http\Controllers\MediaLibraryUploadController;
use Spatie\MediaLibraryPro\Livewire\LivewireMediaLibraryComponent;
use Spatie\MediaLibraryPro\Livewire\LivewireUploaderComponent;
use Spatie\MediaLibraryPro\Models\TemporaryUpload;
use Spatie\MediaLibraryPro\Support\TemporaryUploadPathGenerator;

class MediaLibraryProServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'media-library');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'media-library');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang/');

        $this
            ->registerPublishables()
            ->registerBladeComponents()
            ->registerLivewireComponents()
            ->registerRouteMacros()
            ->registerTemporaryUploaderPathGenerator();
    }

    public function register()
    {
        parent::register();

        $this->registerBladeDirectives();

        $this->commands([
            DeleteTemporaryUploadsCommand::class,
        ]);
    }

    protected function registerPublishables(): self
    {
        if (! class_exists('CreateTemporaryUploadsTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_temporary_uploads_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_temporary_uploads_table.php'),
            ], 'media-library-pro-migrations');
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/media-library'),
        ], 'media-library-pro-views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => "{$this->app['path.lang']}/vendor/media-library",
        ], 'media-library-pro-lang');

        return $this;
    }

    public function registerBladeComponents(): self
    {
        Blade::component('media-library-attachment', MediaLibraryAttachmentComponent::class);
        Blade::component('media-library-collection', MediaLibraryCollectionComponent::class);
        Blade::component('media-library::components.media-library-icon', 'media-library-icon');
        Blade::component('media-library::components.media-library-button', 'media-library-button');

        return $this;
    }

    public function registerLivewireComponents(): self
    {
        if (! class_exists(Livewire::class)) {
            return $this;
        }

        Livewire::component('media-library', LivewireMediaLibraryComponent::class);
        Livewire::component('media-library-uploader', LivewireUploaderComponent::class);

        return $this;
    }

    public function registerRouteMacros(): self
    {
        RateLimiter::for('medialibrary-pro-uploads', function (Request $request) {
            return [
                Limit::perMinute(10)->by($request->ip()),
            ];
        });

        Route::macro('mediaLibrary', function (string $baseUrl = 'media-library-pro') {
            Route::prefix($baseUrl)->group(function () {
                if (config('media-library.enable_vapor_uploads')) {
                    Route::post("post-s3", '\\' . MediaLibraryPostS3Controller::class)
                        ->name('media-library-post-s3')
                        ->middleware(['throttle:medialibrary-pro-uploads']);

                    return;
                }

                Route::post("uploads", '\\' . MediaLibraryUploadController::class)
                    ->name('media-library-uploads')
                    ->middleware(['throttle:medialibrary-pro-uploads']);
            });
        });

        return $this;
    }

    public function registerTemporaryUploaderPathGenerator(): self
    {
        $configuredValues = config('media-library.custom_path_generators', []);

        if (! array_key_exists(TemporaryUpload::class, $configuredValues)) {
            $configuredValues[TemporaryUpload::class] = TemporaryUploadPathGenerator::class;
        }

        config()->set('media-library.custom_path_generators', $configuredValues);

        return $this;
    }

    public function registerBladeDirectives(): self
    {
        Blade::directive('mediaLibraryScripts', function () {
            $scripts = '';

            if (config('media-library.include_dragula_cdn_script', true)) {
                $scripts .= <<<html
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js" defer></script>
                html;
            }

            $scripts .= <<<html
                <script>
                    function querySelectorAllArray(selector) {
                        return Array.prototype.slice.call(
                            document.querySelectorAll(selector), 0
                        );
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        dragula(querySelectorAllArray('.media-library-dragula-container'), {
                            moves(el, source, handle) {
                                // Only allow dragging with the drag handle
                                if (!handle) {
                                    return false;
                                }

                                return Boolean(handle.closest('.dragula-handle'));
                            },
                            accepts(el, target, source, sibling) {
                                // Only allow sorting in the same container
                                if (target !== source) {
                                    return false;
                                }

                                return true;
                            }
                        }).on('drop', (el, target, source) => {
                            source.querySelectorAll('[data-order]').forEach((el, i) => el.value = i);

                            const collectionName = source.getAttribute('data-media-library-component-name');

                            const event = new CustomEvent(`media-library-sorted-\${collectionName}`);

                            document.dispatchEvent(event);
                        });
                    }, false);
                </script>
            html;


            return $scripts;
        });

        Blade::directive('mediaLibraryStyles', function () {
            return <<<html
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="icon-add" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M46.12,30.07h-12v-12c0-1.1-0.9-2-2-2s-2,0.9-2,2v12h-12c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h12v12c0,1.1,0.9,2,2,2
                            s2-0.9,2-2v-12h12c1.1,0,2-0.9,2-2C48.12,30.97,47.22,30.07,46.12,30.07z" />
                    </symbol>

                    <symbol id="icon-not-allowed" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M32.12,8.07c-13.25,0-24,10.75-24,24c0,13.25,10.75,24,24,24s24-10.75,24-24C56.12,18.82,45.37,8.07,32.12,8.07z
                    M32.12,12.07c4.8,0,9.2,1.7,12.65,4.52L16.64,44.72c-2.82-3.45-4.52-7.85-4.52-12.65C12.12,21.04,21.09,12.07,32.12,12.07z
                    M32.12,52.07c-4.8,0-9.2-1.7-12.65-4.52l28.13-28.13c2.82,3.45,4.52,7.85,4.52,12.65C52.12,43.1,43.14,52.07,32.12,52.07z" />
                    </symbol>

                    <symbol id="icon-success" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M28.6,45.71c-0.82,0-1.61-0.34-2.18-0.93l-9.87-10.39c-1.14-1.2-1.09-3.1,0.11-4.24c1.2-1.14,3.1-1.09,4.24,0.11l7.47,7.86
                        L42.9,19.45c1.02-1.31,2.9-1.54,4.21-0.53c1.31,1.02,1.54,2.9,0.53,4.21L30.97,44.55c-0.54,0.69-1.35,1.11-2.22,1.15
                        C28.7,45.71,28.65,45.71,28.6,45.71z" />
                    </symbol>

                    <symbol id="icon-error" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M32.12,16.07c-1.66,0-3,1.34-3,3v16c0,1.66,1.34,3,3,3s3-1.34,3-3v-16C35.12,17.41,33.77,16.07,32.12,16.07z" />
                        <circle class="media-library-icon-fill" cx="32.12" cy="45.07" r="3" />
                    </symbol>

                    <symbol id="icon-replace" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M40.12,39.28H20.77l2.17-2.17c0.78-0.78,0.78-2.05,0-2.83c-0.78-0.78-2.05-0.78-2.83,0l-5.59,5.59
                                        c-0.38,0.38-0.59,0.88-0.59,1.41s0.21,1.04,0.59,1.41l5.59,5.59c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59
                                        c0.78-0.78,0.78-2.05,0-2.83l-2.18-2.18h19.35c1.1,0,2-0.9,2-2S41.22,39.28,40.12,39.28z" />
                        <path class="media-library-icon-fill" d="M49.71,23.86l-8-8c-0.78-0.78-2.05-0.78-2.83,0c-0.78,0.78-0.78,2.05,0,2.83l4.59,4.59H15.94c-1.1,0-2,0.9-2,2s0.9,2,2,2
                            h27.53l-4.59,4.59c-0.78,0.78-0.78,2.05,0,2.83c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59l8-8
                            C50.49,25.91,50.49,24.64,49.71,23.86z" />
                    </symbol>

                    <symbol id="icon-drag" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M46,30H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,30.9,47.1,30,46,30z" />
                        <path class="media-library-icon-fill" d="M46,42H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,42.9,47.1,42,46,42z" />
                        <path class="media-library-icon-fill" d="M18,22h28c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2H18c-1.1,0-2,0.9-2,2C16,21.1,16.9,22,18,22z" />
                    </symbol>

                    <symbol id="icon-up" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M41.41,27.82l-8-8c-0.78-0.78-2.05-0.78-2.83,0l-8,8c-0.78,0.78-0.78,2.05,0,2.83c0.78,0.78,2.05,0.78,2.83,0L30,26.06v16.7
                    c0,1.1,0.9,2,2,2s2-0.9,2-2v-16.7l4.59,4.59c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59C42.2,29.87,42.2,28.6,41.41,27.82z" />
                    </symbol>

                    <symbol id="icon-down" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M22.59,36.18l8,8c0.78,0.78,2.05,0.78,2.83,0l8-8c0.78-0.78,0.78-2.05,0-2.83c-0.78-0.78-2.05-0.78-2.83,0L34,37.94v-16.7
                    c0-1.1-0.9-2-2-2s-2,0.9-2,2v16.7l-4.59-4.59c-0.39-0.39-0.9-0.59-1.41-0.59s-1.02,0.2-1.41,0.59C21.8,34.13,21.8,35.4,22.59,36.18z
                    " />
                    </symbol>

                    <symbol id="icon-remove" viewBox="0 0 64 64">
                        <path class="media-library-icon-fill" d="M43.4,40.6l-8.5-8.5l8.5-8.5c0.8-0.8,0.8-2.1,0-2.8s-2.1-0.8-2.8,0l-8.5,8.5l-8.5-8.5c-0.8-0.8-2.1-0.8-2.8,0
                        c-0.8,0.8-0.8,2.1,0,2.8l8.5,8.5l-8.5,8.5c-0.8,0.8-0.8,2.1,0,2.8c0.8,0.8,2.1,0.8,2.8,0l8.5-8.5l8.5,8.5c0.8,0.8,2.1,0.8,2.8,0
                        C44.2,42.6,44.2,41.3,43.4,40.6z"/>
                    </symbol>
                </svg>
            html;
        });

        return $this;
    }
}
