<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-gray dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    @foreach($patients as $patient)
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="" data-toggle="modal" data-target="#staticBackdrop{{ $patient->id }}" class="underline text-gray-900 dark:text-white">{{ $patient->name }}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                   <p>Email: {{ $patient->email }}</p>
                                   <p>Date of Birth: {{ $patient->birthdate }}</p>
                                    
                                    <div class="modal fade" id="staticBackdrop{{ $patient->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">{{ $patient->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Email: {{ $patient->email }}</p>
                                                    <p>Date of Birth: {{ $patient->birthdate }}</p>
                                                    <p>Patient since: {{ $patient->created_at }}</p>
                                                    <p>Medical history:</p>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Cras justo odio</li>
                                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                                        <li class="list-group-item">Morbi leo risus</li>
                                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                                        <li class="list-group-item">Vestibulum at eros</li>
                                                    </ul><br />
                                                    <p>Appointment history:</p>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Cras justo odio</li>
                                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                                        <li class="list-group-item">Morbi leo risus</li>
                                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                                        <li class="list-group-item">Vestibulum at eros</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>