<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseCategoryRequest extends FormRequest
{
    public function mappedAttributes(array $otherAttributes = []) {
        $attributeMap = array_merge([
            'data.attributes.name' => 'name',
            'data.attributes.hidden' => 'hidden',
            'data.attributes.createdAt' => 'created_at',
            'data.attributes.updatedAt' => 'updated_at',
            'data.relationships.budget.data.id' => 'budget_id',
            'data.relationships.author.data.id' => 'author_id',
        ], $otherAttributes);

        $attributesToUpdate = [];

        foreach ($attributeMap as $key => $attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$attribute] = $this->input($key);
            }
        }

        return $attributesToUpdate;
    }
    public function messages() {
       return [
           'data.attributes.hidden' => 'The hidden field must be a boolean.'
       ];
    }
}
