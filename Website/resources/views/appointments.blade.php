<x-app-layout>
    <script>
        let today = new Date();

        let month = today.getMonth() + 1;
        let day = today.getDate();
        let year = today.getFullYear();
        if (month < 10) {
            month = "0" + month.toString();
        }

        if (day < 10) {
            day = "0" + day.toString();
        }

        let inputDate = year + "-" + month + "-" + day + "T00:00";
    </script>
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
    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-8 lg:px-8">
            <div class="row">
                <div class="col-12">
                    <p id="bottomline">Create an appointment</p>
                </div>
            </div>
            <form method="POST" action="{{ route('create-appointment') }}">
                @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-12">
                            <label for="patient">Doctor</label>
                            <select class="custom-select" id="doctor" name="doctor" required>
                                <option value="">Choose...</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-12">
                            <label for="date">Start Date</label>
                            <input class="form-control" type="datetime-local" id="startDate" name="startDate" required>
                        </div>
                        <div class="col-md-4 mb-12">
                            <label for="date">End Date</label>
                            <input class="form-control" type="datetime-local" id="endDate" name="endDate" required>
                        </div>
                    </div>
                <div class="form-row">
                    <div class="col-md-6 mb-12">
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

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-8 lg:px-8">
                    <div class="row">
                        <div class="col-3">
                            <input class="form-control" id="myInput" type="text" placeholder="Search...">
                        </div>
                        <div class="col-7"></div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticBackdrop">
                                Create Appointment
                              </button>
        
                              <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">Create Appointment</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <x-jet-label style="border-bottom: solid #108fc2;"/>
                                        <form method="POST" action="{{ route('create-appointment') }}">
                                            @csrf
                                            <div class="form-row">
                                                    <div class="col-md-6 mb-12">
                                                        <label for="patient">Patient</label>
                                                        <select class="custom-select" id="patient" name="patient" required>
                                                            <option value="">Choose...</option>
                                                            @foreach($patients as $patient)
                                                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-12">
                                                        <label for="doctor">Doctor</label>
                                                        <input type="text" class="form-control" id="doctor" name="doctor" value="{{ Auth::user()->name }}" disabled>
                                                    </div>
                                                <div class="col-md-6 mb-12">
                                                    <label for="date">Start Date</label>
                                                    <input class="form-control" type="datetime-local" id="startDate" name="startDate" required>
                                                </div>
                                                <div class="col-md-6 mb-12">
                                                    <label for="date">End Date</label>
                                                    <input class="form-control" type="datetime-local" id="endDate" name="endDate" required>
                                                </div>

                                                <script>
                                                        $("#startDate").attr("min", inputDate);
                                                        $("#endDate").attr("min", inputDate);
                                                </script>
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
                                        <x-jet-label style="border-bottom: solid #108fc2;"/>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <br />
           
                    <table class="table" style="text-align: center;">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Patient</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Medical History</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Remove</th>
                          </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($appointments as $appointment)
                                @foreach($patients as $patient)
                                    @if($appointment->patientID == $patient->id)
                                        <tr>
                                            <td>{{$patient->name }}</td>
                                            <td>{{$appointment->startDate}}</td>
                                            <td>{{$appointment->endDate}}</td>
                                            <td>{{$appointment->reason}}</td>
                                            <td>
                                                @if($histories->isEmpty())
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticCreateHistory{{ $appointment->id }}">
                                                        <i class="bi bi-plus-circle"></i>
                                                    </button>
                                                    <div class="modal fade" id="staticCreateHistory{{ $appointment->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticCreateHistoryLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="staticCreateHistoryLabel">Create Medical History - {{ $patient->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">    
                                                                <x-jet-label style="border-bottom: solid #108fc2;"/>                                        
                                                                <form method="POST" action="{{ route('create-medicalhistory') }}">
                                                                    @csrf
                                                                    <div class="form-row">
                                                                        <div class="col-md-6 mb-6">
                                                                            <input type="hidden" class="form-control" id="appointmentID" name="appointmentID" value="{{ $appointment->id }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row">
                                                                        <div class="col-md-6 mb-6">
                                                                            <label for="medicalHistoryDate">Date</label>
                                                                            <input class="form-control" type="datetime-local" id="medicalHistoryDate" name="medicalHistoryDate" required>
                                                                        </div>

                                                                        <script>
                                                                            $("#medicalHistoryDate").attr("min", inputDate);
                                                                        </script>

                                                                        <div class="col-md-6 mb-6">
                                                                            <label for="appointmentsCondition">Condition</label>
                                                                            <textarea class="form-control" id="appointmentsCondition" name="appointmentsCondition" placeholder="Medical condition" rows="2" maxlength="100" required></textarea>
                                                                            <p id="medicalHistoryCount" style="text-align: right; font-size: 12px;"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="col-md-6 mb-6">
                                                                            <button class="btn btn-sm btn-primary" type="submit">Save Medical History</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <x-jet-label style="border-bottom: solid #108fc2;"/>
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
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticHistoryLabel">View Medical History</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">                                            
                                                                        <x-jet-label style="border-bottom: solid #108fc2;"/>
                                                                            <div class="col-md-12 mb-12">
                                                                                <label for="doctor">Condition</label>
                                                                                <input type="text" class="form-control" value="{{ $history->condition }}" disabled>
                                                                            </div>
                                                                            <div class="col-md-12 mb-12">
                                                                                <label for="doctor">Date</label>
                                                                                <input type="text" class="form-control" value="{{ $history->date }}" disabled>
                                                                            </div>                                       
                                                                   
                                                                            <div class="form-row">
                                                                                <div class="col-md-12 mb-6">
                                                                                    <form action="{{ route('remove-history')}}" method="get">
                                                                                        <input type="hidden" id="historyID" name="historyID" value="{{ $history->id }}">
                                                                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        <x-jet-label style="border-bottom: solid #108fc2;"/>
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
                                                                    <x-jet-label style="border-bottom: solid #108fc2;"/>                                          
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
                                                                            <script>
                                                                                $("#medicalHistoryDate").attr("min", inputDate);
                                                                            </script>
                                                               
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
                                                                    <x-jet-label style="border-bottom: solid #108fc2;"/>
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
                                                            <x-jet-label style="border-bottom: solid #108fc2;"/>
                                                            <form method="POST" action="{{ route('edit-appointment') }}">
                                                                @csrf
                                                                <div class="form-row">
                                                                    <input type="hidden" class="form-control" id="appointmentID" name="appointmentID" value="{{ $appointment->id }}">
                                
                                                                    <div class="col-md-6 mb-12">
                                                                        <label for="startDate">Start Date</label>
                                                                        <input class="form-control editStart" type="datetime-local" id="startDate" name="startDate" required>
                                                                    </div>
                                                                    <div class="col-md-6 mb-12">
                                                                        <label for="endDate">End Date</label>
                                                                        <input class="form-control editEnd" type="datetime-local" id="endDate" name="endDate" required>
                                                                    </div>
                                                                    <script>
                                                                        $(".editStart").attr("min", inputDate);
                                                                        $(".editEnd").attr("min", inputDate);
                                                                    </script>
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
                                                            <x-jet-label style="border-bottom: solid #108fc2;"/>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdropRemove{{ $appointment->id }}">X</button>                            

                                                <div class="modal fade" id="staticBackdropRemove{{ $appointment->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelRemove" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabelRemove">Remove appointment of {{ $patient->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-jet-label style="border-bottom: solid #108fc2;"/>
                                                            <br />
                                                            <br />
                                                            <p>Are you sure you want to remove the appointment for {{ $patient->name }}?</p>
                                                            <br />
                                                            <br />
                                                            <x-jet-label style="border-bottom: solid #108fc2;"/>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    
                                                            <form action="{{ route('remove-appointment')}}" method="get">
                                                                <input type="hidden" id="appointmentID" name="appointmentID" value="{{ $appointment->id }}">
                                                                <input type="hidden" id="patientID" name="patientID" value="{{ $appointment->patientID }}">
                                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                 
                                            </td>
                                          </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <script>
                $(document).ready(function(){
                  $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                  });
                });
                </script>
            @endif
</x-app-layout>