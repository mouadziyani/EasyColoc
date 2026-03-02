<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Payment $payment): bool
    {
        $coloc = $payment->colocation;
        return $user->is_global_admin || $coloc->members->contains($user) || $coloc->owner_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Colocation $colocation): bool
    {
        return $user->is_global_admin || $colocation->members->contains($user) || $colocation->owner_id == $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Payment $payment): bool
    {
        $coloc = $payment->colocation;
        return $user->is_global_admin || $coloc->owner_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Payment $payment): bool
    {
        $coloc = $payment->colocation;
        return $user->is_global_admin || $coloc->owner_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Payment $payment): bool
    {
        return $user->is_global_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Payment $payment): bool
    {
        return $user->is_global_admin;
    }
}
