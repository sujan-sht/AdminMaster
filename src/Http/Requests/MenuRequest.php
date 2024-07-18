<?php

namespace SujanSht\AdminMaster\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'route' => strtolower(Str::plural($this->name))
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id=$this->menu->id ?? '';
        return [
            'name' => 'required|max:150|unique:menus,name,'.$id,
            'route' => 'required|unique:menus,route,'.$id,
            'icon' => 'nullable',
            'position' =>'numeric|nullable',
        ];
    }
}
