<?php

namespace App\Http\Requests;

use App\Rules\ValidSolapin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u',
            'lastname' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits:8|starts_with:5,7',
            'solapin' => ['required', 'unique:users,solapin', new ValidSolapin],
            'password' => 'required|min:8',
            'image' => 'nullable|image',
            'role' => 'required'
        ];
        if($this->isMethod('PUT')){
            return [
                'name' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u',
                'lastname' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u',
                'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('user'))],
                'phone' => 'required|numeric|digits:8|starts_with:5,7',
                'solapin' => ['required', Rule::unique('users')->ignore($this->route('user')), new ValidSolapin],
                'password' => 'nullable|min:8',
                'image' => 'nullable|image',
                'role' => 'required'
            ];
        }
        else{
            return $rules;
        }
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
