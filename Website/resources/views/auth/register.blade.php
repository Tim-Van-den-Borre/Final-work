<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <br />
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" >
            @csrf

            <x-jet-label value="{{ __('Register as a patient') }}" style="border-bottom: solid #108fc2;"/>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="birthdate" value="{{ __('Birthdate') }}" />
                <x-jet-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="phonenumber" value="{{ __('Phone (format: 0999 99 99 99)') }}" />
                <x-jet-input id="phonenumber" class="block mt-1 w-full" type="tel" name="phonenumber" pattern="[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}" :value="old('phonenumber')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <input id="privacy_policy" type="checkbox" class="form-checkbox" name="privacy_policy">
                <span class="ml-2 text-sm text-gray-600"><a href="{{ route('privacy-policy')}}" target="_blank"><u>Accept Privacy Policy</u></a></span>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
            <br />
            <x-jet-label style="border-bottom: solid #108fc2;"/>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>