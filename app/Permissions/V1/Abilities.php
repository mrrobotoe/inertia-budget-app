<?php

namespace App\Permissions\V1;

use App\Models\User;

final class Abilities {
    public const ViewBudgets = 'budgets:view';

    public const CreateBudgets = 'budget:create';
    public const UpdateBudgets = 'budget:update';
    public const ReplaceBudgets = 'budget:replace';
    public const DeleteBudgets = 'budget:delete';

    public const CreateOwnBudgets = 'budgets:own:create';
    public const ViewOwnBudgets = 'budgets:own:view';
    public const UpdateOwnBudgets = 'budgets:own:update';
    public const DeleteOwnBudgets = 'budgets:own:delete';
    public const ReplaceOwnBudgets = 'budgets:own:replace';

    public const ViewCategories = 'categories:view';
    public const CreateCategories = 'category:create';
    public const UpdateCategories = 'category:update';
    public const ReplaceCategories = 'category:replace';
    public const DeleteCategories = 'category:delete';

    public const CreateOwnCategories = 'categories:own:create';
    public const ViewOwnCategories = 'categories:own:view';
    public const UpdateOwnCategories = 'categories:own:update';
    public const DeleteOwnCategories = 'categories:own:delete';
    public const ReplaceOwnCategories = 'categories:own:replace';

    public const DeleteUser = 'user:delete';
    public const UpdateUser = 'user:update';
    public const ReplaceUser = 'user:replace';
    public const ViewUser = 'user:view';
    public const CreateUser = 'user:create';


    public static function getAbilities(User $user) {
        // DON'T ASSIGN AN *
        if ($user->is_admin) {
            return [
                self::ViewBudgets,
                self::CreateBudgets,
                self::UpdateBudgets,
                self::ReplaceBudgets,
                self::DeleteBudgets,
                self::ViewCategories,
                self::CreateCategories,
                self::UpdateCategories,
                self::ReplaceCategories,
                self::DeleteCategories,
                self::CreateUser,
                self::DeleteUser,
                self::UpdateUser,
                self::ReplaceUser,
                self::ViewUser,
            ];
        } else {
            return [
                self::CreateOwnBudgets,
                self::ViewOwnBudgets,
                self::UpdateOwnBudgets,
                self::DeleteOwnBudgets,
                self::ReplaceOwnBudgets,
                self::ViewOwnCategories,
                self::CreateOwnCategories,
                self::UpdateOwnCategories,
                self::DeleteOwnCategories,
                self::ReplaceOwnCategories,
            ];
        }
    }
}
