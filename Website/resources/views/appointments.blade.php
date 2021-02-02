<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       <p style="border-bottom: solid #108fc2;">Create an appointment for a patient</p>
                    </div>
                    <div class="col-12">
                        <form class="was-validated" method="POST" action="{{ route('create-appointment') }}">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="patient">Patient</label>
                                    <select class="custom-select" id="patient" name="patient" required>
                                        <option value="">Choose...</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                      </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="doctor">Doctor</label>
                                    <input type="text" class="form-control" id="doctor" value="{{ Auth::user()->name }}" disabled>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="reason">Reason</label>
                                    <textarea class="form-control is-invalid" id="reason" name="reason" placeholder="Reason for the visit" rows="2" required style="resize: none;"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date">Date</label>
                                    <input class="form-control is-invalid" type="datetime-local" id="date" name="date" required>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">Create</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
