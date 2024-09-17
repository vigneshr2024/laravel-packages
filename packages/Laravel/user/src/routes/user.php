<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Laravel\User\App\Http\Controllers\Admin\UserController;
use Laravel\User\App\Http\Controllers\Admin\DashboardController;

Route::get('user', function () {
    dd('user package');
});

Route::middleware(['web', 'userauthcheck'])->prefix('user')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard']);
        Route::resource('user', UserController::class);
    });
});
