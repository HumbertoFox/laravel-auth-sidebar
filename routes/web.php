<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');

    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');

    Route::post('/logout', 'logout')->name('logout');
});

Route::prefix('dashboard')->group(function () {
    View::share('user', [
        'name' => 'Humberto Sales',
        'email' => 'humberto@example.com',
    ]);

    Route::get('/', function () {
        $breadcrumbItems = [
            ['text' => 'Dashboard'],
        ];
        return view('dashboard.dashboard', compact('breadcrumbItems'));
    })->name('dashboard');

    Route::prefix('admins')->group(function () {
        Route::get('/', function () {
            return view('dashboard.admins.admins');
        })->name('admins');

        Route::get('/register', function () {
            return view('dashboard.admins.register');
        })->name('register');

        Route::get('/users', function () {
            return view('dashboard.admins.users');
        })->name('users');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', function () {
            $breadcrumbItems = [
                ['text' => 'Dashboard', 'href' => route('dashboard')],
                ['text' => 'settings'],
            ];
            return view('dashboard.settings.settings', compact('breadcrumbItems'));
        })->name('settings');

        Route::get('/appearance', function () {
            $breadcrumbItems = [
                ['text' => 'Dashboard', 'href' => route('dashboard')],
                ['text' => 'settings'],
            ];
            return view('dashboard.settings.appearance', compact('breadcrumbItems'));
        })->name('appearance');

        Route::get('/password', function () {
            $breadcrumbItems = [
                ['text' => 'Dashboard', 'href' => route('dashboard')],
                ['text' => 'settings'],
            ];
            return view('dashboard.settings.password', compact('breadcrumbItems'));
        })->name('password');

        Route::get('/profile', function () {
            $breadcrumbItems = [
                ['text' => 'Dashboard', 'href' => route('dashboard')],
                ['text' => 'settings'],
            ];
            return view('dashboard.settings.profile', compact('breadcrumbItems'));
        })->name('profile');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', function () {
            $breadcrumbItems = [
                ['text' => 'Dashboard', 'href' => route('dashboard')],
                ['text' => 'User'],
            ];
            return view('dashboard.user.user', compact('breadcrumbItems'));
        })->name('user');
    });
});
