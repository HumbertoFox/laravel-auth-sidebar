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

Route::prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        View::share('user', [
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Humberto Sales',
            'email' => 'humberto@example.com',
            'password' => 'senha-fake-hash',
            'role' => 'Admin',
            'avatar' => 'https://i.pravatar.cc/150?img=33',
            'email_verified' => null, // null = não verificado; string (data) = verificado
            'password_changed_at' => null,
            'deleted_at' => null,
            'created_at' => now()->subMonths(3)->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);

        Route::get('/', function () {
            $breadcrumbItems = [
                ['text' => 'Dashboard'],
            ];
            return view('dashboard.index', compact('breadcrumbItems'));
        })->name('index');

        Route::prefix('admins')
            ->name('admins.')
            ->group(function () {
                Route::get('/', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'Admins']
                    ];
                    return view('dashboard.admins.index', compact('breadcrumbItems'));
                })->name('index');

                Route::get('/register', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'Register']
                    ];
                    return view('dashboard.admins.register', compact('breadcrumbItems'));
                })->name('register');

                Route::get('/users', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'Users']
                    ];
                    return view('dashboard.admins.users', compact('breadcrumbItems'));
                })->name('users');
            });

        Route::prefix('settings')
            ->name('settings.')
            ->group(function () {
                Route::get('/', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'settings']
                    ];
                    return view('dashboard.settings.index', compact('breadcrumbItems'));
                })->name('index');

                Route::get('/verifyemail', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'Verify Email']
                    ];
                    return view('dashboard.settings.verifyemail', compact('breadcrumbItems'));
                })->name('verifyemail');

                Route::get('/appearance', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'Appearance']
                    ];
                    return view('dashboard.settings.appearance', compact('breadcrumbItems'));
                })->name('appearance');

                Route::get('/password', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'Password']
                    ];
                    return view('dashboard.settings.password', compact('breadcrumbItems'));
                })->name('password');

                Route::get('/profile', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'Profile']
                    ];
                    return view('dashboard.settings.profile', compact('breadcrumbItems'));
                })->name('profile');
            });

        Route::prefix('user')
            ->name('user.')
            ->group(function () {
                Route::get('/', function () {
                    $breadcrumbItems = [
                        ['text' => 'Dashboard', 'href' => route('dashboard.index')],
                        ['text' => 'User']
                    ];
                    return view('dashboard.user.index', compact('breadcrumbItems'));
                })->name('index');
            });
    });
