<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Auth\App\Http\Controllers\Admin\LoginController as AdminLoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Sensiple\Auth\App\Http\Controllers\Admin\ProfileController;

Route::get('auth', function () {
    dd('auth package');
});

Route::middleware(['web'])->prefix('auth')->group(function () {


    Route::get('/email/verify', function () {

        return view('auth::email.verify');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('user/user/dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        $request->session()->put('message', 'Verification link sent!');
        return back();
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('mail', function () {
        dd('Hello');
    })->middleware(['verified']);


    Route::prefix('admin')->group(function () {

        Route::get('login', [AdminLoginController::class, 'viewLogin']);
        Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login');

        Route::middleware(['userauthcheck'])->group(function () {
            Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        });
    });
});

// Route::middleware(['web', 'userauthcheck'])->prefix('user')->group(function () {

//     Route::prefix('admin')->group(function () {
//         Route::resource('profile', ProfileController::class);
//         Route::put('update', [ProfileController::class, 'update']);
//         Route::put('update-password', [ProfileController::class, 'updatePassword']);
//     });
// });
