@extends('auth.layout')

@section('title', 'Log in')

@section('content')
    <div class="flex items-center w-full 2xl:w-2/4">
        <div class="flex flex-col items-center gap-2 text-center mx-auto">
            <a href="/" class="size-10 dark:invert 2xl:hidden rounded-full">
                <x-app-logo-icon />
            </a>
            <h1 class="text-xl font-medium">Log in to your account</h1>
            <p class="text-muted-foreground text-sm text-balance">
                Enter your email and password below to log in.
            </p>
        </div>
    </div>
@endsection
