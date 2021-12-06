<?php

namespace App\Policies;

use App\Models\CompanyCustomization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomizationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyCustomization  $companyCustomization
     * @return mixed
     */
    public function view(User $user, CompanyCustomization $companyCustomization)
    {
        if ($user->can(CompanyCustomization::PERMISSIONS['view'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyCustomization  $companyCustomization
     * @return mixed
     */
    public function update(User $user, CompanyCustomization $companyCustomization)
    {
        if ($user->can(CompanyCustomization::PERMISSIONS['update'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyCustomization  $companyCustomization
     * @return mixed
     */
    public function delete(User $user, CompanyCustomization $companyCustomization)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyCustomization  $companyCustomization
     * @return mixed
     */
    public function restore(User $user, CompanyCustomization $companyCustomization)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyCustomization  $companyCustomization
     * @return mixed
     */
    public function forceDelete(User $user, CompanyCustomization $companyCustomization)
    {
        return true;
    }
}
