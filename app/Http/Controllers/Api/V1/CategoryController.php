<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\CategoryFilter;
use App\Http\Requests\Api\V1\ReplaceCategoryRequest;
use App\Http\Requests\Api\V1\StoreCategoryRequest;
use App\Http\Requests\Api\V1\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Gate::authorize('viewAny', Category::class);

            if (auth()->user()->is_admin) {
                if ($this->include('author')) {
                    return CategoryResource::collection(Category::with('user')->get());
                }
                return CategoryResource::collection(Category::all());
            } else {
                if ($this->include('author')) {
                    return CategoryResource::collection(Category::with('user')->get()->where('user_id', auth()->user()->id));
                }

                return CategoryResource::collection(Category::all()->where('user_id', auth()->user()->id));
            }
        } catch (AuthorizationException $exception) {
            return $this->error('Unauthorized to view resources');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $budget = Budget::findOrFail($request->input('data.relationships.budget.data.id'));

            Gate::authorize('store', Category::class);

            $model = [
                'name' => $request->input('data.attributes.name'),
                'budget_id' => $budget->id,
                'hidden' => $request->input('data.attributes.hidden') ?? false,
            ];

            return new CategoryResource(Category::create($model));
        } catch (ModelNotFoundException $exception) {
            return $this->ok('Budget not found', [
                'error' => 'Budget not found'
            ]);
        } catch (AuthorizationException $exception) {
            return $this->error('Unauthorized to store resource');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            Gate::authorize('view', $category);

            if ($this->include('author')) {
                return new CategoryResource($category->load('user'));
            }
            return new CategoryResource($category);

        } catch (AuthorizationException $exception) {
            return $this->error('Unauthorized to view resource');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function edit(Category $category)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $category_id)
    {
        // PATCH
        try {
            $category = Category::findOrFail($category_id);

            Gate::authorize('update', $category);

            $category->update($request->mappedAttributes());

            return new CategoryResource($category);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Budget or Category could not found', status: 404);
        } catch (AuthorizationException $exception) {
            return $this->error('Unauthorized to update resource');
        }
    }

    /**
     * Replace the specified resource in storage.
     */
    public function replace(ReplaceCategoryRequest $request, $category_id)
    {
        // PUT
        try {
            $category = Category::findOrFail($category_id);

            Gate::authorize('replace', $category);

            $model = [
                'budget_id' => $request->input('data.relationships.budget.data.id'),

            ];

            if ($category->budget_id == $model['budget_id']) {
                $category->update($request->mappedAttributes());
                return new CategoryResource($category);
            }

            return $this->error('Category does not belong to user or budget', status: 403);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Budget or Category could not found', status: 404);
        } catch (AuthorizationException $exception) {
            return $this->error('Unauthorized to replace resource');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        try {
            $category = Category::findOrFail($category_id);

            Gate::authorize('delete', $category);

            $category->delete();

            return $this->ok('Category successfully deleted');
        } catch (ModelNotFoundException $exception) {
            return $this->error('Category not found', status: 404);
        } catch (AuthorizationException $exception) {
            return $this->error('Unauthorized to delete resource');
        }
    }
}
