<?php

namespace App\Http\Requests;

use App\Rules\UniqueAuthorByTitle;
use Illuminate\Foundation\Http\FormRequest;

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
            'title' => 'required|string|regex:/^[\p{L}\p{M} ]+$/u',
            'year_of_stablishment' => 'required|numeric|digits:4|min:0',
            'location' => 'required',
            'restore_permission' => 'required',
            'state_of_disrepair' => 'required',
            'author_id' => ['required'],
            'review' => 'required',
            'budget' => 'required|numeric|min:1',
            'image' => 'required|image'
        ];

        return $rules;
    }
}
