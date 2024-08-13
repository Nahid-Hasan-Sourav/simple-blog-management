<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <h2 class="text-xl fw-bold text-center fs-1">Forgot Password?</h2>
            <p class="text-center">No worries we will send you reset instructions</p>
        </div>
        <!-- Email Address -->
        <div class="mt-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4 mb-4 w-100">
            <x-primary-button>
                {{ __('Password Reset Link') }}
            </x-primary-button>

        </div>
        <div id="emailHelp" class="my-2 form-text text-dark">
            <a href="{{route('login')}}" class="mb-3 text-dark fw-bold">

                {{ __('Back to login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
