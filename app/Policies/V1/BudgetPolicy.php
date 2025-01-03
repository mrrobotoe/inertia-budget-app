<?php

namespace App\Policies\V1;

use App\Models\Budget;
use App\Models\User;
use App\Permissions\V1\Abilities;

class BudgetPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Budget $budget): bool
    {
        if ($user->tokenCan(Abilities::DeleteBudgets)) {
            return true;
        } else if ($user->tokenCan(Abilities::DeleteOwnBudgets)) {
            return $user->id == $budget->user_id;
        }

        return false;
    }

    public function store(User $user): bool
    {
        return $user->tokenCan(Abilities::CreateBudgets);
    }

    public function update(User $user, Budget $budget): bool
    {
        if ($user->tokenCan(Abilities::UpdateBudgets))
        {
            return true;
        } else if ($user->tokenCan(Abilities::UpdateOwnBudgets)) {
            return $user->id == $budget->user_id;
        }

        return false;
    }

    public function view(User $user, Budget $budget): bool
    {
        if ($user->tokenCan(Abilities::ViewOwnBudgets) && $user->id == $budget->user_id) {
            return true;
        } else if ($user->tokenCan(Abilities::ViewBudgets)) {
            return true;
        }

        return false;
    }

    public function viewAny(User $user): bool
    {
        return $user->tokenCan(Abilities::ViewBudgets) || $user->tokenCan(Abilities::ViewOwnBudgets);
    }
}
