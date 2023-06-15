<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
            'email' => 'required|email|unique:authors,email',
            'phone' => 'required|numeric|digits:8|starts_with:5,7'
        ];

        if($this->isMethod('PUT')){
            return [
                'name' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u',
                'lastname' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u',
                'email' => ['required', 'email', Rule::unique('authors')->ignore($this->route('author'))],
                'phone' => 'required|numeric|digits:8|starts_with:5,7'
            ];
        }else{
            return $rules;
        }

    }
}
