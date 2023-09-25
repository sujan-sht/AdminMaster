@php
    use SujanSht\LaraAdmin\Models\Admin\Setting;
@endphp
<div class="row">

    <div class="col-md-6 mb-3">
        <label for="setting_name">Setting Name</label><span class="text-danger">*</span>
        <input type="text" name="setting_name" class="form-control" value="{{$setting->setting_name ?? old('setting_name')}}" placeholder="Enter Setting Name">
        @error('setting_name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="setting_type">Setting Type</label><span class="text-danger">*</span>
        <select name="setting_type" class="select2 form-control" data-toggle="select2">
            <option selected disabled>Select Setting Type ...</option>
            <option value="{{Setting::STRING}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::STRING ? 'selected' : '') : '' }}>
                    String
                </option>
                <option value="{{Setting::INTEGER}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::INTEGER ? 'selected' : '') : '' }}>
                    Integer
                </option>
                <option value="{{Setting::TEXT}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::TEXT ? 'selected' : '') : '' }}>
                    Text
                </option>
                <option value="{{Setting::TEXTEDITOR}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::TEXTEDITOR ? 'selected' : '') : '' }}>
                    Rich Text
                </option>
                <option value="{{Setting::SWITCH}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::SWITCH ? 'selected' : '') : '' }}>
                    Switch
                </option>
                <option value="{{Setting::CHECKBOX}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::CHECKBOX ? 'selected' : '') : '' }}>
                    Check Box
                </option>
                <option value="{{Setting::SELECT}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::SELECT ? 'selected' : '') : '' }}>
                    Select
                </option>
                <option value="{{Setting::MULTIPLE}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::MULTIPLE ? 'selected' : '') : '' }}>
                    Multiple
                </option>
                <option value="{{Setting::TAG}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::TAG ? 'selected' : '') : '' }}>
                    Tag
                </option>
                <option value="{{Setting::IMAGE}}"
                    {{ isset($setting->setting_type) ? ($setting->getRawOriginal('setting_type') == Setting::IMAGE ? 'selected' : '') : '' }}>
                    Image
                </option>
        </select>
        @error('setting_type')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-md-5 mb-3">
        <label for="setting_group">Setting Group</label>
        <select name="setting_group" class="select2 form-control" data-toggle="select2">
            <option selected disabled>Select Setting Group ...</option>
            @isset($setting_groups)
                @foreach (array_unique($setting_groups) as $group)
                    <option value="{{ $group }}" {{$setting->setting_group == $group ? 'selected' : ''}}>{{ $group }}</option>
                @endforeach
            @endisset
        </select>
    </div>
    <div class="col-md-1 mb-3">
        <h2>OR</h2>

    </div>
    <div class="col-md-6 mb-3">
        <label for="new_setting_group">New Setting Group</label>
        <input name="new_setting_group" class="form-control btn-square" id="new_setting_group" type="text" placeholder="Enter New Setting Group" value="{{ old('new_setting_group') }}">
    </div>
    <div class="row">
        <x-lara-admin-add-edit-button :model="$model ?? ''" name="setting"></x-add-edit-button>
    </div>
</div>

