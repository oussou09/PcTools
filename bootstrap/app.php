<?php

use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\UserIsAuth;
use App\Http\Middleware\UserIsGuest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'AuthAdmin' => AdminAuth::class,
            'AuthUser' => UserIsAuth::class,
            'AuthGuest' => UserIsGuest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
