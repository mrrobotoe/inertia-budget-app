<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;

class UpdateCategoryRequest extends BaseCategoryRequest
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
            'data.attributes.name' => 'sometimes|string|max:30|unique:categories,name',
            'data.attributes.hidden' => 'sometimes|boolean',
            'data.relationships.budget.data.id' => 'prohibited',
            'data.relationships.author.data.id' => 'prohibited',
        ];

        if ($this->user()->tokenCan(Abilities::UpdateCategory)) {
            $rules['data.relationships.author.data.id'] = 'sometimes|integer|exists:users,id';
            $rules['data.relationships.budget.data.id'] = 'sometimes|integer|exists:budgets,id';
        }

        return $rules;
    }
}
