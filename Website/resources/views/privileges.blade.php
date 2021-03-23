<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Privileges') }}</h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-8 lg:px-8">
            <div class="mt-8 bg-gray dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-1" id="line">
                    @foreach($users as $user)
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <div class="ml-6 text-lg leading-7 font-semibold text-gray-900 dark:text-white">{{ $user->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-3 ml-6">
                                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                        <p>Role: {{ $user->role}}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <form method="post" action="{{ route('setPrivilege') }}">
                                    @csrf
                                        <p class="hidden" value="{{ $user->id }}" id="userID" name="userID"></p>
                                        
                                        <select class="custom-select" id="role" name="role" onchange="this.form.submit()" required>
                                            <option value="">Choose...</option>
                                            <option value="Patient">Patient</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
