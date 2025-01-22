<x-guest-layout>
    <style>
        :root {
            --primary-color: #a3d9a5; /* Light Green */
            --primary-hover: #8cc89d; /* Darker Light Green */
            --primary-dark: #6db381; /* Dark Green */
            --text-color: #333; /* Text Color */
        }

        body {
        margin: 0;
        padding: 0;
        height: 100vh; 
        background: linear-gradient(to top, #6db381, #ffffff 50%, transparent 50%); 
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .register-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            padding: 2rem;
            margin: 2rem auto;
        }

        .register-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: var(--text-color);
            text-align: center;
        }

        .register-btn {
            background-color: var(--primary-dark);
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .register-btn:hover {
            background-color: var(--primary-hover);
        }

        .text-link {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .text-link:hover {
            color: var(--primary-hover);
        }

        .form-check-label {
            color: var(--text-color);
        }
    </style>

    {{-- <div class="flex items-center justify-center min-h-screen"> --}}
        {{-- <div class="register-container"> --}}
            <h1 class="register-title">{{ __('Register a New Account') }}</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-link hover:text-green-600" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4 register-btn">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        {{-- </div>
    </div> --}}
</x-guest-layout>
