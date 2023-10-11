<?php

use App\Models\Admin\Page;
use SujanSht\LaraAdmin\Models\Admin\Menu;
use SujanSht\LaraAdmin\Models\Admin\Setting;

if (! function_exists('getClassesList')) {
    function getClassesList($dir)
    {
        $classes = \File::allFiles($dir);
        foreach ($classes as $class) {
            $class->classname = str_replace(
                [app_path(), '/', '.php'],
                ['App', '\\', ''],
                $class->getRealPath()
            );
        }

        return $classes;
    }
}
if (! function_exists('getAllModelNames')) {
    function getAllModelNames($dir)
    {
        $modelNames = [];
        $models = getClassesList($dir);
        foreach ($models as $model) {
            $model_name = explode('\\', $model->classname);
            $modelNames[] = end($model_name);
        }

        return $modelNames;
    }
}

if(! function_exists('adminMenus')){
    function adminMenus()
    {
        return Menu::active()->position()->get();
    }

}
// custom pages
if (! function_exists('other_custom_pages')) {
    function other_custom_pages()
    {
        return Page::where('type',Page::OTHER)->active()->featured()->position()->get();
    }
}
if (! function_exists('about_custom_pages')) {
    function about_custom_pages()
    {
        return Page::where('type',Page::ABOUT)->active()->featured()->position()->get();
    }
}

if (! function_exists('setting')) {
    function setting($setting_name, $default = null)
    {
        $valid_setting_name = strtolower(str_replace(' ', '_', $setting_name));
        $setting = Setting::where('setting_name', $valid_setting_name)->first();

        return isset($setting->value) ? $setting->value : ($default ?? null);
    }
}

if (! function_exists('getImg')) {
    function getImg($img, $default)
    {
        if (isset($img)) {
            if (file_exists(public_path('storage/'.$img))) {
                return asset('storage/'.$img);
            } elseif (file_exists(public_path($img))) {
                return asset($img);
            } else {
                return asset($default);
            }
        } else {
            return asset($default);
        }
    }
}

if (! function_exists('post_status')) {
    function post_status()
    {
        return config('lara-admin.post_status') ?? ['Not Approved','Publish','Pending','Draft'];
    }
}
if (! function_exists('post_type')) {
    function post_type()
    {
        return config('lara-admin.post_type') ?? ['Blog','Story'];
    }
}
if (! function_exists('page_type')) {
    function page_type()
    {
        return config('lara-admin.page_type') ?? ['Other','About'];
    }
}
if (! function_exists('parseYoutube')) {
    function parseYoutube($video)
    {
        return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" style="width: 100%;height: 30vh;" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></div>', $video);
    }
}


if (! function_exists('logo')) {
    function logo()
    {
        return getImg(! is_null(setting('logo')) ? setting('logo') : config('lara-admin.logo', 'lara-admin/assets/static-img/logo.png'), config('lara-admin.logo', 'lara-admin/assets/static-img/logo.png'));
    }
}
if (! function_exists('favicon')) {
    function favicon()
    {
        return getImg(! is_null(setting('favicon')) ? setting('favicon') : config('lara-admin.favicon', 'lara-admin/assets/static-img/favicon.png'), config('lara-admin.favicon', 'lara-admin/assets/static-img/favicon.png'));
    }
}
if (! function_exists('title')) {
    function title()
    {
        return !is_null(setting('title')) ? setting('title') : config('lara-admin.title');
    }
}
if (! function_exists('meta_description')) {
    function meta_description()
    {
        return !is_null(setting('meta_description')) ? setting('meta_description') : config('lara-admin.meta_description');
    }
}
if (! function_exists('keywords')) {
    function keywords()
    {
        return !is_null(setting('keywords')) ? setting('keywords') : config('lara-admin.keywords');
    }
}

if (! function_exists('address')) {
    function address()
    {
        return !is_null(setting('address')) ? setting('address') : config('lara-admin.address');
    }
}
if (! function_exists('phone')) {
    function phone()
    {
        return !is_null(setting('phone')) ? setting('phone') : config('lara-admin.phone');
    }
}
if (! function_exists('facebook')) {
    function facebook()
    {
        return !is_null(setting('facebook')) ? setting('facebook') : config('lara-admin.facebook');
    }
}
if (! function_exists('instagram')) {
    function instagram()
    {
        return !is_null(setting('instagram')) ? setting('instagram') : config('lara-admin.instagram');
    }
}
if (! function_exists('youtube')) {
    function youtube()
    {
        return !is_null(setting('youtube')) ? setting('youtube') : config('lara-admin.youtube');
    }
}
if (! function_exists('tiktok')) {
    function tiktok()
    {
        return !is_null(setting('tiktok')) ? setting('tiktok') : config('lara-admin.tiktok');
    }
}
if (! function_exists('description')) {
    function description()
    {
        return !is_null(setting('description')) ? setting('description') : config('lara-admin.description');
    }
}
if (! function_exists('about_image')) {
    function about_image()
    {
        return getImg(! is_null(setting('about_image')) ? setting('about_image') : config('lara-admin.logo', 'lara-admin/assets/static-img/logo.png'), config('lara-admin.logo', 'lara-admin/assets/static-img/logo.png'));

    }
}

if (! function_exists('getting_section')) {
    function getting_section()
    {
        return getImg(! is_null(setting('getting_section')) ? setting('getting_section') : config('lara-admin.logo', 'lara-admin/assets/static-img/logo.png'), config('lara-admin.logo', 'lara-admin/assets/static-img/logo.png'));

    }
}

