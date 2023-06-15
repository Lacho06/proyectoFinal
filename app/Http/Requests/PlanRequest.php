<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
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
            'year' => 'required|unique:restoration_plans,year|numeric|digits:4|min:0',
            'annual_budget' => 'required|numeric|min:1',
            'approval' => 'nullable',
        ];

        if($this->isMethod('PUT')){
            $rules = [
                'year' => ['required', 'numeric', 'digits:4', 'min:0', Rule::unique('restoration_plans')->ignore($this->route('restorationPlan'))],
                'annual_budget' => 'required|numeric|min:1',
                'approval' => 'nullable',
            ];
        }

        return $rules;
    }
}
