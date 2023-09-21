<?php

namespace SujanSht\LaraAdmin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id=$this->role->id ?? null;
        return [
            'name'=>'required|max:50|unique:roles,name,'.$id,
            'description'=>'nullable|max:255'
        ];
    }
}
