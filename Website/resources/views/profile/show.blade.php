<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Profile') }}</h3>
    </x-slot>

    <div>
            <ul class="nav nav-pills max-w-7xl mx-auto sm:px-6 lg:px-8" id="myTab" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link btn-sm active" id="profile-information" data-toggle="tab" href="#profileInformation" role="tab" aria-controls="profileInformation" aria-selected="true">Profile Information</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link btn-sm" id="update-password" data-toggle="tab" href="#updatePassword" role="tab" aria-controls="updatePassword" aria-selected="false">Update Password</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link btn-sm" id="user-data" data-toggle="tab" href="#userData" role="tab" aria-controls="userData" aria-selected="false">User Data</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link btn-sm" id="privacy-policy" data-toggle="tab" href="#privacyPolicy" role="tab" aria-controls="privacyPolicy" aria-selected="false">Privacy Policy</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link btn-sm" id="two-factor-auth" data-toggle="tab" href="#authentication" role="tab" aria-controls="authentication" aria-selected="false">Two Factor Authentication</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link btn-sm" id="browser-sessions" data-toggle="tab" href="#browserSessions" role="tab" aria-controls="browserSessions" aria-selected="false">Browser Sessions</a>
                </li>
                @if(Auth::user()->role == 'Patient')
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link btn-sm" id="delete-account" data-toggle="tab" href="#deleteAccount" role="tab" aria-controls="deleteAccount" aria-selected="false">Delete Account</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="profileInformation" role="tabpanel" aria-labelledby="profile-information">
                    <div class="max-w-7xl mx-auto pt-10 sm:px-6 lg:px-8">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="updatePassword" role="tabpanel" aria-labelledby="update-password">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.update-password-form')
                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="userData" role="tabpanel" aria-labelledby="user-data">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <div id="requestUserDataLine" class="mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">User Data</h3>
                                    <p class="mt-1 text-sm text-gray-600">Request your data</p>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <div class="px-4 py-3 sm:p-6 bg-white shadow sm:rounded-lg">
                                        <div class="max-w-xl text-sm text-gray-600">
                                            If necessary, you can download the data in 'JSON' format that we are keeping from you.
                                        </div>
                                        <div class="mt-2">
                                                <a style="text-decoration: none;" href="{{route('personal-data')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                                    Download your personal data
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="privacyPolicy" role="tabpanel" aria-labelledby="privacy-policy">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <div id="requestPrivacyPolicyLine" class="mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">Privacy Policy</h3>
                                    </div>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <div class="px-4 py-3 sm:p-6 bg-white shadow sm:rounded-lg">
                                        <div class="max-w-xl text-sm text-gray-600">
                                            If necessary, you can read our privacy policy again.
                                        </div>
                                        <div class="mt-2">
                                            <a style="text-decoration: none;" href="{{ route('privacy-policy')}}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                                Read our privacy policy
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="authentication" role="tabpanel" aria-labelledby="two-factor-auth">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-10 sm:mt-0" style="">
                                @livewire('profile.two-factor-authentication-form')
                            </div>
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="browserSessions" role="tabpanel" aria-labelledby="browser-sessions">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="deleteAccount" role="tabpanel" aria-labelledby="delete-account">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        @if(Auth::user()->role == 'Patient')
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
