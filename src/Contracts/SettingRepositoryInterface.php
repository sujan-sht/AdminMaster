<?php

namespace SujanSht\LaraAdmin\Contracts;

use Illuminate\Http\Request;
use SujanSht\LaraAdmin\Models\Admin\Setting;
use SujanSht\LaraAdmin\Http\Requests\SettingRequest;

interface SettingRepositoryInterface
{
    public function indexSetting();

    public function createSetting();

    public function storeSetting(SettingRequest $request);

    public function showSetting(Setting $setting);

    public function editSetting(Setting $setting);

    public function updateSetting(SettingRequest $request, Setting $setting);

    public function destroySetting(Setting $setting);

    public function setting_store(Request $request);
}
