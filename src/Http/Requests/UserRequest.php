<?php

namespace SujanSht\AdminMaster\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id=$this->user->id ?? '';
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required'
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'password' => 'required|same:confirm_password|min:8|max:30',
                'confirm_password' => 'required|same:password'
            ];
        }

        if ($this->getMethod() == 'PATCH' || $this->getMethod() == 'PUT') {
            if ($this->password) {
                $rules += [
                    'password' => 'required|same:confirm_password|min:8|max:30',
                    'confirm_password' => 'required|same:password'
                ];
            }
        }

        return $rules;
    }
}
