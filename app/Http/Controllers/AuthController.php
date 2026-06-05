<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        $hasAdmin = User::where('role', UserRole::ADMIN)->exists();

        return view('auth.register', compact('hasAdmin'));
    }
}
