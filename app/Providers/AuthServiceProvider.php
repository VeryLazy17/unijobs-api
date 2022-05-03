<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->role->name == 'superadmin') {
                return true;
            } else {
                $permissions = $user->role->permissions;
                //read,update

                foreach ($permissions as $permission) {
                    $p = explode('|', $permission['action']);

                    if (in_array($ability, $p)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        });
    }
}
