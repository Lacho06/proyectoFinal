<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'solapin' => 'required',
            'password' => 'required|min:8',
            'image' => 'nullable|image',
            'role' => 'nullable'
        ];
        // TODO pendiente la regla de validacion del correo
        if($this->method('PUT')){
            return [
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'solapin' => 'required',
                'image' => 'nullable|image',
                'role' => 'nullable'
            ];
        }else{
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
