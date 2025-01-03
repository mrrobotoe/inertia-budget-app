<?php

namespace App\Http\Requests\Api\V1;

class ReplaceCategoryRequest extends BaseCategoryRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'data.attributes.name' => 'required|string|max:30',
            'data.attributes.hidden' => 'boolean',
            'data.relationships.budget.data.id' => 'required|integer|exists:budgets,id',
            'data.relationships.author.data.id' => 'required|integer|exists:users,id',
        ];

        return $rules;
    }

    public function messages() {
       return [
           'data.attributes.hidden' => 'The hidden field must be a boolean.'
       ];
    }
}
