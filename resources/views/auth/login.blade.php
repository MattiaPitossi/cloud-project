<style>
    .alert.alert-info  {
        color: red;
        padding-left: 100px;
    }
</style>

<x-guest-layout>



    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ url('/') }}/images/logo.png" width="250" height="auto" style="border-radius:110.75px">
            </a>
        </x-slot>

        @if (session('info'))
            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                {{ session('info') }}
            </div>
        @endif

        @if (session()->has('message'))
            <div class="alert alert-primary">
                {{ session()->get('message') }}
            </div>
        @endif


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>





            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>



            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-60 hover:text-gray-900" href="/register">
                    {{ __('Not registred? Create an account') }}
                </a>

                <a class="underline text-sm text-gray-60 hover:text-gray-900" href="/forgot-password">
                    {{ __('Forgot your password?') }}
                </a>

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>


            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
