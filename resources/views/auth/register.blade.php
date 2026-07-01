<x-layouts.auth title="Sign up">
    <div class="w-full flex flex-col justify-center gap-6 2xl:w-2/4">
        <div class="flex flex-col items-center gap-2 text-center mx-auto">
            <a href="/" class="size-10 dark:invert 2xl:hidden rounded-full">
                <x-app-logo-icon />
            </a>
            <h1 class="text-xl font-medium">{{ $hasAdmin ? 'Register User' : 'Register Admin' }}</h1>
            <p class="text-muted-foreground text-sm text-balance">
                Enter your details below to create your account.
            </p>
        </div>
        <form action="{{ route('register.post') }}" method="POST" class="w-full max-w-xs flex flex-col gap-6 mx-auto">
            @csrf
            <div class="flex flex-col gap-4">
                <x-input label="Name" name="name" type="text" placeholder="Full name" :value="old('name')"
                    :error="$errors->first('name')" required />
                <x-input label="Email address" name="email" type="email" placeholder="email@example.com"
                    :value="old('email')" :error="$errors->first('email')" required />
                <x-input label="Password" name="password" type="password" placeholder="Password" :error="$errors->first('password')"
                    required />
                <x-input label="Confirm your password." name="password_confirmation" type="password"
                    placeholder="Confirm your password." :error="$errors->first('password_confirmation')" required />
            </div>

            <x-button type="submit" class="w-full">Create an account</x-button>
        </form>
        <div class="text-muted-foreground text-center text-sm">
            You already have an account!&nbsp;&nbsp;
            <x-text-link href="/login">Log in</x-text-link>
        </div>
    </div>
</x-layouts.auth>
