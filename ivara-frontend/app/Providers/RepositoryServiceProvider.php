<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Repositories\MySQL\MySQLUserRepository;
use App\Repositories\MongoDB\MongoDBUserRepository;

/**
 * Repository Service Provider
 * 
 * This provider binds the correct repository implementation
 * based on the database driver configured in .env
 * 
 * When DB_CONNECTION=mysql → MySQLUserRepository
 * When DB_CONNECTION=mongodb → MongoDBUserRepository
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind UserRepositoryInterface to the correct implementation
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            $driver = config('database.default');

            return match ($driver) {
                'mongodb' => $app->make(MongoDBUserRepository::class),
                default => $app->make(MySQLUserRepository::class),
            };
        });

        // Bind OrderRepositoryInterface
        $this->app->bind(\App\Contracts\Repositories\OrderRepositoryInterface::class, function ($app) {
            $driver = config('database.default');

            return match ($driver) {
                'mongodb' => $app->make(\App\Repositories\MongoDB\MongoDBOrderRepository::class),
                default => $app->make(\App\Repositories\MySQL\MySQLOrderRepository::class),
            };
        });

        // Bind SuperAdminRepositoryInterface
        $this->app->bind(\App\Contracts\Repositories\SuperAdminRepositoryInterface::class, function ($app) {
            return $app->make(\App\Repositories\Api\ApiSuperAdminRepository::class);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
