<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckInternetConnection;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) { 
        
        $middleware->append(CheckInternetConnection::class); // disable this for no internet connection

        $middleware->alias(['isAuthenticated' => \App\Http\Middleware\CheckSession::class]);
    }) 
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
