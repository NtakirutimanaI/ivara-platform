<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

      $middleware->alias([
            'role'         => \App\Http\Middleware\RoleMiddleware::class,
            'admin'        => \App\Http\Middleware\AdminMiddleware::class,
            'manager'      => \App\Http\Middleware\ManagerMiddleware::class,
            'supervisor'   => \App\Http\Middleware\SupervisorMiddleware::class,
            'businessperson' => \App\Http\Middleware\BusinessPersonMiddleware::class,
            'technician'   => \App\Http\Middleware\TechnicianMiddleware::class,
            'mechanic'     => \App\Http\Middleware\MechanicMiddleware::class,
            'tailor'       => \App\Http\Middleware\TailorMiddleware::class,
            'craftsperson' => \App\Http\Middleware\CraftspersonMiddleware::class,
            'mediator'     => \App\Http\Middleware\MediatorMiddleware::class,
            'client'       => \App\Http\Middleware\ClientMiddleware::class,
            'ivara_role'   => \App\Http\Middleware\IvaraRoleMiddleware::class,
            'category_access' => \App\Http\Middleware\CategoryAccessMiddleware::class,
        ]);


    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
