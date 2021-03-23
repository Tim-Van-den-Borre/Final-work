<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Doctors') }}</h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-8 lg:px-8">
            <div class="mt-8 bg-gray dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-4" id="line">
                    @foreach($doctors as $doctor)
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">{{ $doctor->name }}</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                   <p>Email: {{ $doctor->email}}</p>
                                   <p>Phone: {{ $doctor->phonenumber}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
