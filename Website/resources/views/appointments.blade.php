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
                        Appointment with Dr. <b>{{ session('appointmentalert') }}</b> has been created successfully.
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
    @if (session('editappointmentalert'))
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
                        Appointment for <b>{{ session('editappointmentalert') }}</b> has been updated successfully.
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
    @if(Auth::user()->role == 'Patient')
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
                </div>
                @if(Auth::user()->role == 'Patient')
                    <div class="form-row">
                        <div class="col-md-12 mb-6">
                            <label for="patient">Doctor</label>
                            <select class="custom-select" id="doctor" name="doctor" required>
                                <option value="">Choose...</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
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
    @endif
        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')

            <div class="max-w-7xl mx-auto pt-10 sm:px-6 lg:px-8">
                <div class="col-md-12 mb-12">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticBackdrop">
                        Create Appointment
                      </button>
                      
                      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Create Appointment</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('create-appointment') }}">
                                    @csrf
                                    <div class="form-row">
                                            <div class="col-md-4 mb-12">
                                                <label for="patient">Patient</label>
                                                <select class="custom-select" id="patient" name="patient" required>
                                                    <option value="">Choose...</option>
                                                    @foreach($patients as $patient)
                                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-12">
                                                <label for="doctor">Doctor</label>
                                                <input type="text" class="form-control" id="doctor" name="doctor" value="{{ Auth::user()->name }}" disabled>
                                            </div>
                                        <div class="col-md-4 mb-12">
                                            <label for="date">Date</label>
                                            <input class="form-control" type="datetime-local" id="date" name="date" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                            <label for="appointmentsReason">Reason</label>
                                            <textarea class="form-control" id="appointmentsReason" name="appointmentsReason" placeholder="Reason for the visit" rows="3" maxlength="100" required></textarea>
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
                    </div>
                </div>
                <div class="col-md-12 mb-12">
                    <table class="table" style="text-align: center;">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Patient</th>
                            <th scope="col">Date</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Medical History</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                @foreach($patients as $patient)
                                    @if($appointment->patientID == $patient->id)
                                        <tr>
                                            <td>{{$patient->name }}</td>
                                            <td>{{$appointment->date}}</td>
                                            <td>{{$appointment->reason}}</td>
                                            <td>
                                                @if($histories->isEmpty())
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticCreateHistory{{ $appointment->id }}">
                                                        <i class="bi bi-plus-circle"></i>
                                                    </button>
                                                    <div class="modal fade" id="staticCreateHistory{{ $appointment->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticCreateHistoryLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="staticCreateHistoryLabel">Create Medical History - {{ $patient->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">                                            
                                                                <form method="POST" action="{{ route('create-medicalhistory') }}">
                                                                    @csrf
                                                                    <div class="form-row">
                                                                        <div class="col-md-12 mb-6">
                                                                            <input type="hidden" class="form-control" id="appointmentID" name="appointmentID" value="{{ $appointment->id }}">
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
                                                        </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    @php
                                                        $exists = false;
                                                    @endphp
                                                    @foreach($histories as $history)
                                                        @if($history->appointmentID == $appointment->id)
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#staticHistory{{ $history->id }}">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                            <div class="modal fade" id="staticHistory{{ $history->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticHistoryLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticHistoryLabel">View Medical History</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">                                            
                                                                        <div class="form-row">
                                                                            <div class="col-md-6 mb-12">
                                                                                <label for="doctor">Condition</label>
                                                                                <input type="text" class="form-control" value="{{ $history->condition }}" disabled>
                                                                            </div>
                                                                            <div class="col-md-6 mb-12">
                                                                                <label for="doctor">Date</label>
                                                                                <input type="text" class="form-control" value="{{ $history->date }}" disabled>
                                                                            </div>                                       
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <form action="{{ route('remove-history')}}" method="get">
                                                                                <input type="hidden" id="historyID" name="historyID" value="{{ $history->id }}">
                                                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            @php
                                                                $exists = true;
                                                            @endphp
                                                            @break
                                                        @endif
                                                    @endforeach    
                                                    @if ($exists == false)  
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticCreateHistory{{ $appointment->id }}">
                                                            <i class="bi bi-plus-circle"></i>
                                                        </button>
                                                        <div class="modal fade" id="staticCreateHistory{{ $appointment->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticCreateHistoryLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="staticCreateHistoryLabel">Create Medical History - {{ $patient->name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">                                            
                                                                    <form method="POST" action="{{ route('create-medicalhistory') }}">
                                                                        @csrf
                                                                        <div class="form-row">
                                                                            <div class="col-md-12 mb-6">
                                                                                <input type="hidden" class="form-control" id="appointmentID" name="appointmentID" value="{{ $appointment->id }}">
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
                                                            </div>
                                                            </div>
                                                        </div>
                                    
                                                    @endif                                          
                                                @endif
                                            </td>
                                            <td> 
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#staticBackdrop{{ $appointment->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <div class="modal fade" id="staticBackdrop{{ $appointment->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Appointment for {{ $patient->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                      
                                                            <form method="POST" action="{{ route('edit-appointment') }}">
                                                                @csrf
                                                                <div class="form-row">
                                                                    <input type="hidden" class="form-control" id="appointmentID" name="appointmentID" value="{{ $appointment->id }}">
                                
                                                                    <div class="col-md-12 mb-12">
                                                                        <label for="date">Date</label>
                                                                        <input class="form-control" type="datetime-local" id="date" name="date" required>
                                                                    </div>
                                                                </div>
                                    
                                                                <div class="form-row">
                                                                    <div class="col-md-12 mb-12">
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
                                                </div>
                                            </td>
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
            @endif
</x-app-layout>
