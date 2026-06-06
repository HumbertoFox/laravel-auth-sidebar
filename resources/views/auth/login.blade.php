@extends('auth.layout')

@section('title', 'Log in')

@section('content')
    <div class="w-full flex flex-col justify-center gap-6 2xl:w-2/4">
        <div class="flex flex-col items-center gap-2 text-center mx-auto">
            <a href="/" class="size-10 dark:invert 2xl:hidden rounded-full">
                <x-app-logo-icon />
            </a>
            <h1 class="text-xl font-medium">Log in to your account</h1>
            <p class="text-muted-foreground text-sm text-balance">
                Enter your email and password below to log in.
            </p>
        </div>
        <form action="{{ route('login.post') }}" method="POST" class="w-full max-w-xs flex flex-col gap-6 mx-auto">
            @csrf
            <div class="flex flex-col gap-4">
                <x-ui.input label="Email address" name="email" type="email" placeholder="email@example.com" :value="old('email')"
                    :error="$errors->first('email')" required />
                <x-ui.input label="Password" name="password" type="password" placeholder="Password" :error="$errors->first('password')" required />
            </div>

            <x-ui.button type="submit" class="w-full">Log in</x-ui.button>
        </form>

        <div class="text-muted-foreground text-center text-sm">
            There is no account!&nbsp;&nbsp;
            <x-text-link href="/register">Sign up</x-text-link>
        </div>
    </div>
@endsection
