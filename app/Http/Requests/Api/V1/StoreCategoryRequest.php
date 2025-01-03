<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;

class StoreCategoryRequest extends BaseCategoryRequest
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
        $authorIdAttr = $this->routeIs('categories.store') ? 'data.relationships.author.data.id' : 'author';
        $budgetIdAttr = $this->routeIs('categories.store') ? 'data.relationships.budget.data.id' : 'budget';
        $authorRule = 'required|integer|exists:users,id';
        $user = $this->user();

        $rules = [
            'data.attributes.name' => 'required|string|max:30|unique:categories,name',
            'data.attributes.hidden' => 'boolean',
            $budgetIdAttr => 'required|integer|exists:budgets,id',
            $authorIdAttr => $authorRule . '|size:' . $user->id,
        ];

        if ($user->tokenCan(Abilities::CreateCategories)) {
            $rules[$authorIdAttr] = $authorRule;
        }

        return $rules;
    }

    protected function prepareForValidation() {
        if ($this->routeIs('authors.budgets.categories.store')) {
            $this->merge([
                'author' => $this->route('author'),
                'budget' => $this->route('budget'),
            ]);
        }
    }

//    public function messages() {
//       return [
//           'data.attributes.name' => 'The name has already been taken.',
//           'data.attributes.hidden' => 'The hidden field must be a boolean.'
//       ];
//    }
}
