<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Appointments') }}</h3>
    </x-slot>
    @if (session('appointmentalert'))
        <div id="appointmentsToast" class="position-fixed bottom-0 right-0 p-3">
            <div id="appointmentsLiveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header">
                <strong class="mr-auto">Appointment Manager</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="toast-body">
                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
                        Appointment for <b>{{ session('appointmentalert') }}</b> has been created successfully.
                    @endif

                    @if(Auth::user()->role == 'Patient')
                    Appointment for <b>{{ session('appointmentalert') }}</b> has been created successfully.
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if (session('appointmentRemoved'))
        <div id="appointmentsToast" class="position-fixed bottom-0 right-0 p-3">
            <div id="appointmentsLiveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header">
                <strong class="mr-auto">Appointment Manager</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="toast-body">
                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
                        Appointment for <b>{{ session('appointmentRemoved') }}</b> has been removed successfully.
                    @endif

                    @if(Auth::user()->role == 'Patient')
                        Your appointment has been removed successfully.
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if (session('historyRemoved'))
        <div id="appointmentsToast" class="position-fixed bottom-0 right-0 p-3">
            <div id="appointmentsLiveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header">
                <strong class="mr-auto">Appointment Manager</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="toast-body">
                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
                        Medical history has been removed successfully.
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if (session('medicalhistoryalert'))
        <div id="appointmentsToast" class="position-fixed bottom-0 right-0 p-3">
            <div id="appointmentsLiveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header">
                <strong class="mr-auto">Appointment Manager</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="toast-body">
                    Medical history for <b>{{ session('medicalhistoryalert') }}</b> has been created successfully.
                </div>
            </div>
        </div>
    @endif
    <ul class="nav nav-pills max-w-7xl mx-auto sm:px-6 lg:px-8" id="myTab" role="tablist">
        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link btn-sm active" id="show-appointments" data-toggle="tab" href="#showAppointments" role="tab" aria-controls="showAppointments" aria-selected="true">Appointments</a>
        </li>
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link btn-sm" id="show-histories" data-toggle="tab" href="#showHistories" role="tab" aria-controls="showHistories" aria-selected="true">Medical Histories</a>
        </li>
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link btn-sm" id="create-appointment" data-toggle="tab" href="#createAppointment" role="tab" aria-controls="createAppointment" aria-selected="true">Create Appointment</a>
        </li>
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link btn-sm" id="medical-history" data-toggle="tab" href="#medicalHistory" role="tab" aria-controls="medicalHistory" aria-selected="false">Create Medical History</a>
        </li>
        @endif

        @if(Auth::user()->role == 'Patient')
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link btn-sm active" id="create-appointment" data-toggle="tab" href="#createAppointment" role="tab" aria-controls="createAppointment" aria-selected="true">Create Appointment</a>
            </li>
        @endif
    </ul>
    <div class="tab-content">
        @if(Auth::user()->role == 'Patient')
        <div class="tab-pane fade show" id="showAppointments" role="tabpanel" aria-labelledby="show-appointments">
        @endif
        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
        <div class="tab-pane fade active show" id="showAppointments" role="tabpanel" aria-labelledby="show-appointments">
        @endif
            <div class="max-w-7xl mx-auto pt-10 sm:px-6 lg:px-8">
                <div class="col-md-12 mb-12">
                    <div class="row">
                        <div class="col-12">
                            <p id="bottomline">Appointments</p>
                        </div>
                    </div>
                    <table class="table" style="text-align: center;">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Patient</th>
                            <th scope="col">Date</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                @foreach($appointments as $appointment)
                                    @if($appointment->patientID == $patient->id)
                                        <tr>
                                            <td>{{$patient->name }}</td>
                                            <td>{{$appointment->date}}</td>
                                            <td>{{$appointment->reason}}</td>
                                            <td>
                                                <form action="{{ route('remove-appointment')}}" method="get">
                                                    <input type="hidden" id="appointmentID" name="appointmentID" value="{{ $appointment->id }}">
                                                    <input type="hidden" id="patientID" name="patientID" value="{{ $appointment->patientID }}">
                                                    <button type="submit" class="btn btn-danger btn-sm">X</button>
                                                </form>
                                            </td>
                                          </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade show" id="showHistories" role="tabpanel" aria-labelledby="show-histories">
            <div class="max-w-7xl mx-auto pt-10 sm:px-6 lg:px-8">
                    <div class="col-md-12 mb-12">
                        <div class="row">
                            <div class="col-12">
                                <p id="bottomline">Medical Histories</p>
                            </div>
                        </div>
                        <table class="table" style="text-align: center;">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">Condition</th>
                                <th scope="col">Date</th>
                                <th scope="col">Remove</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $history)
                                            <tr>
                                                <td>{{$history->condition }}</td>
                                                <td>{{$history->date}}</td>
                                                <td>
                                                    <form action="{{ route('remove-history')}}" method="get">
                                                        <input type="hidden" id="historyID" name="historyID" value="{{ $history->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm">X</button>
                                                    </form>
                                                </td>
                                              </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
            </div>
        </div>

        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
        <div class="tab-pane fade show" id="createAppointment" role="tabpanel" aria-labelledby="create-appointment">
        @endif
        @if(Auth::user()->role == 'Patient')
        <div class="tab-pane fade active show" id="createAppointment" role="tabpanel" aria-labelledby="create-appointment">
        @endif
            <div class="max-w-7xl mx-auto pt-10 sm:px-6 lg:px-8">
                    <div class="col-md-12 mb-12">
                        <div class="row">
                            <div class="col-12">
                                <p id="bottomline">Create an appointment</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('create-appointment') }}">
                            @csrf
                            <div class="form-row">
                                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
                                    <div class="col-md-12 mb-6">
                                        <label for="patient">Patient</label>
                                        <select class="custom-select" id="patient" name="patient" required>
                                            <option value="">Choose...</option>
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-6">
                                        <label for="doctor">Doctor</label>
                                        <input type="text" class="form-control" id="doctor" name="doctor" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                @endif

                                @if(Auth::user()->role == 'Patient')
                                    <div class="col-md-12 mb-6">
                                        <label for="patient">Doctor</label>
                                        <select class="custom-select" id="doctor" name="doctor" required>
                                            <option value="">Choose...</option>
                                            @foreach($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <label for="date">Date</label>
                                    <input class="form-control" type="datetime-local" id="date" name="date" required>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label for="appointmentsReason">Reason</label>
                                    <textarea class="form-control" id="appointmentsReason" name="appointmentsReason" placeholder="Reason for the visit" rows="2" maxlength="100" required></textarea>
                                    <p id="appointmentMessageCount" style="text-align: right; font-size: 12px;"></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <button class="btn btn-sm btn-primary" type="submit">Save Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>

        <div class="tab-pane fade" id="medicalHistory" role="tabpanel" aria-labelledby="medical-history">
            <div class="max-w-7xl mx-auto pt-10 sm:px-6 lg:px-8">
                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
                <div class="col-md-12 mb-12">
                    <div class="row">
                        <div class="col-12">
                            <p id="bottomline">Create a medical history</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('create-medicalhistory') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-6">
                                <label for="appointmentID">Appointment</label>
                                <select class="custom-select" id="appointmentID" name="appointmentID" required>
                                    <option value="">Choose...</option>
                                    @foreach($appointments as $appointment)
                                        @foreach($patients as $patient)
                                            @if($appointment->patientID == $patient->id)
                                            <option value="{{ $appointment->id }}">
                                                {{ $appointment->date }}, {{ $patient->name }}
                                            </option>
                                            @endif
                                        @endforeach

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-6">
                                <label for="medicalHistoryDate">Date</label>
                                <input class="form-control" type="datetime-local" id="medicalHistoryDate" name="medicalHistoryDate" required>
                            </div>

                            <div class="col-md-12 mb-6">
                                <label for="appointmentsCondition">Condition</label>
                                <textarea class="form-control" id="appointmentsCondition" name="appointmentsCondition" placeholder="Medical condition" rows="2" maxlength="100" required></textarea>
                                <p id="medicalHistoryCount" style="text-align: right; font-size: 12px;"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-6">
                                <button class="btn btn-sm btn-primary" type="submit">Save Medical History</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
