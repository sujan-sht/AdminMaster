<?php

namespace SujanSht\AdminMaster\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (isset(request()->new_setting_group)) {
            $this->merge([
                'setting_group' => strtolower(str_replace(' ', '_', request()->new_setting_group)),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'setting_name' => 'required|max:255',
            'string_value' => 'nullable|max:255',
            'integer_value' => 'nullable|numeric',
            'text_value' => 'nullable|max:65000',
            'boolean_value' => 'nullable|boolean',
            'setting_type' => 'required|numeric',
            'setting_group' => 'required|max:20',
            'setting_custom' => 'nullable',
        ];
    }
}
