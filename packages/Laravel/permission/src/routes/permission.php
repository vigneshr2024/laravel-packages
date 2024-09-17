<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Permission\App\Http\Controllers\Admin\PermissionController;
use Laravel\Permission\App\Http\Controllers\Admin\PermissionGroupController;
use Laravel\Permission\App\Http\Controllers\Admin\RoleController;
use Laravel\Permission\App\Http\Controllers\Admin\UserRolePermissionController;

Route::get('permission', function () {
    dd('permission');
});
Route::middleware(['web', 'userauthcheck'])->prefix('permission')->group(function () {



    Route::prefix('admin')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('permissions-groups', PermissionGroupController::class);
        Route::resource('users-roles-permissions', UserRolePermissionController::class);
    });
});
