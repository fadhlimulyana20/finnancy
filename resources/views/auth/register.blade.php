<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{--<a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>--}}
        </x-slot>

    <div class="w-full sm:max-w-md mt-6 px-0.5 py-4 bg-white  overflow-auto ">
        <div class="min-h-full flex flex-col items-center pt-6 sm:pt-0 bg-green-200 py-16 sm:rounded-lg">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Title -->
            <div>
                <x-label class="mb-16 mt-10  text-3xl font-bold text-center justify-center" for="name" :value="__('Create Your Account')" />
            </div>

            <!-- Name -->
            <div>
                <x-label class="text-lg"  for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label class="text-lg" for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label class="text-lg" for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label class="text-lg" for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-center mt-4">
                <a class="underline text-sm text-gray-600 hover:text-black-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button class="ml-4 mt-5">
                    {{ __('Register') }}
                </x-button>
            </div>
            
        </form>
        </div>
    </div>
    </x-auth-card>
</x-guest-layout>
