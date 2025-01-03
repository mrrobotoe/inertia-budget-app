<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'category',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'hidden' => $this->hidden,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at
            ],
            'relationships' => [
                'budget' => [
                    'data' => [
                        'type' => 'budget',
                        'id' => $this->budget_id
                    ],
                    'links' => [
//                        'self' => route('budgets.show', ['budget' => $this->budget_id])
                    ]
                ],
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ],
                    'links' => [
//                        'self' => route('authors.show', ['author' => $this->user_id])
                    ]
                ]
            ],
            'includes' => new BudgetResource($this->whenLoaded('budget')),
            'links' => [
//                'self' => route('categories.show', ['category' => $this->id])
            ]
        ];
    }
}
