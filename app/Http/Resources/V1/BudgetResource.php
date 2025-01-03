<?php

namespace App\Http\Resources\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
{
//    public static $wrap = 'budget';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'type' => 'budget',
            'id' => $this->id,
            'uuid' => $this->uuid,
            'attributes' => [
                'name' => $this->name,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ],
                    'links' => [
//                        'self' => route('authors.show', ['author' => $this->user_id])
                    ]
                ],
            ],
            'includes' => [new UserResource($this->whenLoaded('author')), CategoryResource::collection(Category::all()->where('budget_id', $this->id))],
            'links' => [
//                'self' => route('budgets.show', ['budget' => $this->id])
            ]
        ];
    }
}
