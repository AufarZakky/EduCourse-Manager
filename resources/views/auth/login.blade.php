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

        .login-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            padding: 2rem;
            margin: 2rem auto;
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: var(--text-color);
            text-align: center;
        }

        .login-btn {
            background-color: var(--primary-dark);
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
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
        {{-- <div class="login-container"> --}}
            <div class="flex items-center justify-center">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <h1 class="login-title">{{ __('Log in to Your Account') }}</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-500" name="remember">
                        <span class="ms-2 text-sm form-check-label">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-link hover:text-green-600" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <x-primary-button class="ms-3 login-btn">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        {{-- </div>
    </div> --}}
</x-guest-layout>
