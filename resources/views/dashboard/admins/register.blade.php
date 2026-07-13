<x-layouts.sidebar title="Register User">
    <x-sidebar.main-header :items="$breadcrumbItems" />

    <div class="w-full max-w-xs flex flex-col gap-6">
        <div class="flex flex-col items-center gap-2 text-center mx-auto">
            <h1 class="text-xl font-medium">Register User Acount</h1>
            <p class="text-muted-foreground text-sm text-balance">
                Enter the details below to create account.
            </p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-6">
            @csrf
            <div class="flex flex-col gap-4">

                {{-- Avatar --}}
                <div class="grid gap-2">
                    <label for="avatar" class="text-sm font-medium mx-auto">
                        Profile picture <span class="text-muted-foreground">(optional)</span>
                    </label>
                    <div class="flex flex-col items-center gap-3">

                        <div class="relative w-24 h-24 rounded-full overflow-hidden border border-gray-300">
                            <img id="avatar-preview" src="" alt="Preview avatar"
                                class="object-cover w-full h-full hidden" />
                            <div id="avatar-placeholder"
                                class="w-full h-full flex items-center justify-center text-sm text-gray-400 bg-gray-50">
                                No image
                            </div>
                        </div>

                        <label for="avatar" id="avatar-label" title="Select profile picture"
                            class="cursor-pointer px-3 py-1 text-sm border rounded-md hover:bg-gray-50 dark:hover:bg-gray-800">
                            Select image
                        </label>

                        <input id="avatar" name="avatar" type="file" accept="image/jpeg, image/png, image/webp"
                            class="hidden" />

                        <p id="avatar-error" class="text-sm text-red-500 hidden"></p>

                        @error('avatar')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>
                </div>

                <x-input label="Name" name="name" type="text" placeholder="Full name" :value="old('name')"
                    :error="$errors->first('name')" required />

                <x-input label="Email address" name="email" type="email" placeholder="email@example.com"
                    :value="old('email')" :error="$errors->first('email')" required />

                <x-input label="Password" name="password" type="password" placeholder="Password" :error="$errors->first('password')"
                    required />

                <x-input label="Confirm your password." name="password_confirmation" type="password"
                    placeholder="Confirm your password." :error="$errors->first('password_confirmation')" required />

            </div>

            <x-button type="submit" id="submit-btn" class="w-full">
                Create an account
            </x-button>

        </form>
    </div>
</x-layouts.sidebar>
