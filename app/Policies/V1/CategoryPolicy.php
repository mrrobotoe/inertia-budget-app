<?php

namespace App\Policies\V1;

use App\Models\Category;
use App\Models\User;
use App\Permissions\V1\Abilities;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Category $category): bool {
        if ($user->tokenCan(Abilities::DeleteCategories)) {
            return true;
        } else if ($user->tokenCan(Abilities::DeleteOwnCategories)) {
            return $user->id == $category->user_id;
        }

        return false;
    }

    public function replace(User $user, Category $category): bool
    {
        if ($user->tokenCan(Abilities::ReplaceCategories)) {
            return true;
        } else if ($user->tokenCan(Abilities::ReplaceOwnCategories)) {
            return $user->id == $category->user_id;
        }
        return false;
    }

    public function store(User $user): bool {
        return $user->tokenCan(Abilities::CreateCategories);
    }

    public function update(User $user, Category $category): bool
    {
        if ($user->tokenCan(Abilities::UpdateCategories)) {
            return true;
        } else if ($user->tokenCan(Abilities::UpdateOwnCategories)) {
            return $user->id == $category->user_id;
        }
        return false;
    }

    public function view(User $user, Category $category): bool {
        if ($user->tokenCan(Abilities::ViewOwnCategories) && $user->id == $category->user_id) {
            return true;
        } else if ($user->tokenCan(Abilities::ViewCategories)) {
            return true;
        }

        return false;
    }

    public function viewAny(User $user): bool
    {
        return $user->tokenCan(Abilities::ViewCategories) || $user->tokenCan(Abilities::ViewOwnCategories);
    }
}
