<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Proof;
use Illuminate\Auth\Access\Response;

class ProofPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Proof $proof): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    public function edit(User $user, Proof $proof): Response
    {
        return $user->id === $proof->user_id
            ? Response::allow()
            : Response::deny('Bạn không được chỉnh sửa nội dung này');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Proof $proof): Response
    {
        return $user->id === $proof->user_id
            ? Response::allow()
            : Response::deny('Bạn không được cập nhật nội dung này');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Proof $proof): Response
    {
        return $user->id === $proof->user_id
            ? Response::allow()
            : Response::deny('Bạn không được xóa nội dung này');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Proof $proof): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Proof $proof): bool
    {
        return false;
    }
}
