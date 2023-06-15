<?php

namespace App\Http\Requests;

use App\Rules\UniqueAuthorByTitle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CulturalWorkRequest extends FormRequest
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
            'title' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u|unique:cultural_works,title',
            'year_of_stablishment' => 'required|numeric|digits:4|min:0',
            'location' => 'required',
            'restore_permission' => 'required',
            'state_of_disrepair' => 'required',
            'author_id' => ['required', 'exists:authors,id'],
            'review' => 'required',
            'budget' => 'required|numeric|min:1',
            'image' => 'required|image'
        ];

        if($this->isMethod('PUT')){
            $rules = [
                'title' => ['required', 'string', 'regex:/^[\p{L}\p{M} ]+$/u', Rule::unique('cultural_works')->ignore($this->route('culturalWork'))],
                'year_of_stablishment' => 'required|numeric|digits:4|min:0',
                'location' => 'required',
                'restore_permission' => 'required',
                'state_of_disrepair' => 'required',
                'author_id' => ['required', 'exists:authors,id'],
                'review' => 'required',
                'budget' => 'required|numeric|min:1',
                'image' => 'required|image'
            ];
        }

        return $rules;
    }
}
