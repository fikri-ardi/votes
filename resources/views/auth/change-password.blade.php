<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/polls">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form x-data="{ password:'', password_confirm:'' }" method="POST" action="{{ route('password.store') }}">
            @csrf
            @method('patch')

            <!-- Email Address -->
            <div>
                <x-label for="old_password" :value="__('Old Password')" />
                <x-input id="old_password" class="block mt-1 w-full" type="password" name="old_password" :value="old('old_password')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input x-model="password" id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input x-model="password_confirm" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                <small x-show.transition="password_confirm != 0 && password != password_confirm" class="text-red-500 bg-red-200 px-1.5 py-0.5 rounded-lg mt-2 inline-block">Password confirm doesn't match.</small>
                <small x-show.transition="password_confirm != 0 && password == password_confirm" class="text-green-500 bg-green-200 px-1.5 py-0.5 rounded-lg mt-2 inline-block">Password confirm match.</small>
            </div>

            <div class="flex items-center justify-between mt-4">
                <a href="/polls">Ignore</a>
            
                <x-button x-show.transition="password_confirm != 0 || password == password_confirm" >
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
        
    </x-auth-card>
</x-guest-layout>
