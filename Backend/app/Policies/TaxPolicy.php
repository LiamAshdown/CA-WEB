<?php

namespace App\Policies;

use App\Models\Tax;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tax  $tax
     * @return mixed
     */
    public function view(User $user, Tax $tax)
    {
        return $user->company_id === $tax->company__id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tax  $tax
     * @return mixed
     */
    public function update(User $user, Tax $tax)
    {
        return $user->company_id === $tax->company__id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tax  $tax
     * @return mixed
     */
    public function delete(User $user, Tax $tax)
    {
        return $user->company_id === $tax->company__id;
    }
}
