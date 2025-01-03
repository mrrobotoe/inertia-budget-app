<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\StoreBudgetRequest;
use App\Http\Requests\Api\V1\UpdateBudgetRequest;
use App\Http\Resources\V1\BudgetResource;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class BudgetController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            Gate::authorize('viewAny', Budget::class);

            if (auth()->user()->is_admin) {
                return Inertia::render('Budgets/Index', [
                    'budgets' => BudgetResource::collection(Budget::all()),
                    'is_admin' => auth()->user()->is_admin,
                    'error' => '',
                ]);
            } else {
                return Inertia::render('Budgets/Index', [
                    'budgets' => BudgetResource::collection(Budget::all()->where('user_id', auth()->user()->id)),
                    'is_admin' => auth()->user(),
                    'error' => '',
                ]);
            }
        } catch (AuthorizationException $e) {
            return Inertia::render('Budgets/Index', [
                'error' => 'You do not have permission to view budgets',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBudgetRequest $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        try {
            Gate::authorize('view', $budget);

            if (auth()->user()->is_admin) {
                return Inertia::render('Budgets/Show', [
                    'budget' => new BudgetResource($budget),
                    'is_admin' => auth()->user()->is_admin,
                    'error' => '',
                ]);
            } else {
                return Inertia::render('Budgets/Show', [
                    'budget' => new BudgetResource($budget),
                    'is_admin' => auth()->user()->is_admin,
                    'error' => '',
                ]);
            }
        } catch (AuthorizationException $e) {
            return Inertia::render('Budgets/Show', [
                'error' => 'You do not have permission to view budgets',
            ]);
        }
    }

    public function reflect(Budget $budget)
    {
        try {
            Gate::authorize('view', $budget);

            if (auth()->user()->is_admin) {
                return Inertia::render('Budgets/Reflect', [
                    'budget' => new BudgetResource($budget),
                    'is_admin' => auth()->user()->is_admin,
                    'error' => '',
                ]);
            } else {
                return Inertia::render('Budgets/Reflect', [
                    'budget' => new BudgetResource($budget),
                    'is_admin' => auth()->user()->is_admin,
                    'error' => '',
                ]);
            }
        } catch (AuthorizationException $e) {
            return Inertia::render('Budgets/Show', [
                'error' => 'You do not have permission to view budgets',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
