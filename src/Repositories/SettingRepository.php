<?php

namespace SujanSht\LaraAdmin\Repositories;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use SujanSht\LaraAdmin\Models\Admin\Setting;
use SujanSht\LaraAdmin\Http\Requests\SettingRequest;
use SujanSht\LaraAdmin\Contracts\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    // Setting Index
    public function indexSetting()
    {
        $settings = Setting::all();
        $setting_grouped = Setting::where('setting_type', '<>', 11)->get()->groupBy('setting_group');
        return compact('settings','setting_grouped');
    }

    // Setting Create
    public function createSetting()
    {
        $setting_groups = Setting::all()->pluck('setting_group')->toArray();
        return compact('setting_groups');
    }

    // Setting Store
    public function storeSetting(SettingRequest $request)
    {
        Setting::create($request->validated());
    }

    // Setting Show
    public function showSetting(Setting $setting)
    {
        return compact('setting');
    }

    // Setting Edit
    public function editSetting(Setting $setting)
    {
        $setting_groups = Setting::all()->pluck('setting_group')->toArray();

        return compact('setting', 'setting_groups');
    }

    // Setting Update
    public function updateSetting(SettingRequest $request, Setting $setting)
    {
        $setting->update($request->validated());
    }

    // Setting Destroy
    public function destroySetting(Setting $setting)
    {
        $setting->delete();
    }

    public function setting_store(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $setting = Setting::where('setting_name', $key)->first();
            if (isset($setting)) {
                if ($key != '_token') {
                    $request->validate([
                        $key => $this->getValidationRule($setting),
                    ]);

                    $this->store_setting_value($setting, $key, $value);
                }
            }
        }
    }

    private function getValidationRule(Setting $setting)
    {
        if ($setting->getRawOriginal('setting_type') == Setting::STRING) {
            return 'max:255';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::INTEGER) {
            return 'numeric';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::TEXT) {
            return 'max:3000';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::TEXTEDITOR) {
            return 'max:65000';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::SWITCH) {
            return 'boolean';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::CHECKBOX) {
            return 'numeric';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::SELECT) {
            return 'sometimes';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::MULTIPLE) {
            return 'sometimes';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::TAG) {
            return 'sometimes';
        } elseif ($setting->getRawOriginal('setting_type') == Setting::IMAGE) {
            return 'image|file|max:3000';
        }
    }

    private function store_setting_value(Setting $setting, $key, $value)
    {
        if ($setting->getRawOriginal('setting_type') == Setting::STRING || $setting->getRawOriginal('setting_type') == Setting::IMAGE) {
            $setting->update([
                'string_value' => $value,
            ]);
            if ($setting->getRawOriginal('setting_type') == Setting::IMAGE) {
                if (request()->has($key)) {
                    $setting->update([
                        'string_value' => $value->store('admin/setting', 'public'),
                    ]);
                    $image = Image::make($value->getRealPath());
                    $image->save(public_path('storage/'.$setting->string_value));
                }
            }
        } elseif ($setting->getRawOriginal('setting_type') == Setting::INTEGER || $setting->getRawOriginal('setting_type') == Setting::CHECKBOX || $setting->getRawOriginal('setting_type') == Setting::SELECT) {
            $setting->update([
                'integer_value' => $value,
            ]);
        } elseif ($setting->getRawOriginal('setting_type') == Setting::TEXT || $setting->getRawOriginal('setting_type') == Setting::TEXTEDITOR) {
            $setting->update([
                'text_value' => $value,
            ]);
        } elseif ($setting->getRawOriginal('setting_type') == Setting::SWITCH) {
            $setting->update([
                'boolean_value' => $value,
            ]);
        } elseif ($setting->getRawOriginal('setting_type') == Setting::MULTIPLE || $setting->getRawOriginal('setting_type') == Setting::TAG) {
            $setting->update([
                'setting_json' => $value,
            ]);
        } else {
            $setting->update([
                'string_value' => $value,
            ]);
        }
    }
}
