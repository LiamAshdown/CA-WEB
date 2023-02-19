<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\CompanyCustomization;
use App\Models\Tax;
use App\Models\User;
use App\Policies\CompanyPolicy;
use App\Policies\CustomizationPolicy;
use App\Policies\TaxPolicy;
use App\Policies\UsersPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        CompanyCustomization::class => CustomizationPolicy::class,
        User::class => UsersPolicy::class,
        Tax::class => TaxPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
