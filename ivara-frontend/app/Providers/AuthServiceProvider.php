<?php

namespace App\Providers;

use App\Models\Course;
use App\Policies\CoursePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
        // Other policies...
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        \Illuminate\Support\Facades\Auth::provider('session_api', function ($app, array $config) {
            return new \App\Services\Auth\SessionUserProvider();
        });
    }
}
