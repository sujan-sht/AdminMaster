<?php

namespace SujanSht\AdminMaster\Http\Controllers\Admin;

use SujanSht\AdminMaster\Contracts\SettingRepositoryInterface;
use SujanSht\AdminMaster\Http\Controllers\Controller;
use SujanSht\AdminMaster\Http\Requests\SettingRequest;
use SujanSht\AdminMaster\Models\Admin\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingRepositoryInterface;

    public function __construct(SettingRepositoryInterface $settingRepositoryInterface)
    {
        $this->settingRepositoryInterface = $settingRepositoryInterface;
        $this->authorizeResource(Setting::class,'setting');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-master::admin.setting.index',$this->settingRepositoryInterface->indexSetting());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-master::admin.setting.create',$this->settingRepositoryInterface->createSetting());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $this->settingRepositoryInterface->storeSetting($request);
        return redirect(adminRedirectRoute('settings'))->with('message','Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return view('admin-master::admin.setting.show',$this->settingRepositoryInterface->showSetting($setting));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin-master::admin.setting.edit',$this->settingRepositoryInterface->editSetting($setting));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting)
    {

        $this->settingRepositoryInterface->updateSetting($request, $setting);
        return redirect(adminRedirectRoute('settings'))->with('info','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $this->settingRepositoryInterface->destroySetting($setting);
        return redirect(adminRedirectRoute('settings'))->with('error','Deleted Successfully');
    }

    public function setting_store(Request $request)
    {
        $this->settingRepositoryInterface->setting_store($request);

        return redirect(adminRedirectRoute('settings'))->with('Settings Saved !.');
    }
}
