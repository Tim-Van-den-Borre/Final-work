<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Dashboard') }}</h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-8 lg:px-8">
            <div class="mt-8 bg-gray dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-1">
                    
                    <div class="p-6" id="line">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold"><p class="text-gray-900 dark:text-white">
                                @if(Auth::user()->role == 'Doctor')
                                    <p>Welcome Dr. {{ Auth::user()->name }}</p>
                                @elseif(Auth::user()->role == 'Patient')
                                    <p>Welcome {{ Auth::user()->name }}</p>
                                @elseif(Auth::user()->role == 'Admin')
                                    <p>Welcome Admin {{ Auth::user()->name }}</p>
                                @endif
                            </div>
                        </div>
                        @if(Auth::user()->role == 'Doctor')
                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    <p>You have 12 appointments today. To view the appointments please navigate to the Calender tab.</p>
                                    <p>10 patient(s) have assigned you as their doctor today. To view your patients please navigate to the Patients tab.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
