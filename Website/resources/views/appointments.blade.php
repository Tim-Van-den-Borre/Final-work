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
                    @if (session('appointmentalert'))
                    <div class="col-12">
                        <div class="alert alert-success" role="alert" id="notification" style="border-radius: 20px;">
                            Appointment for <b>{{ session('appointmentalert') }}</b> has been created successfully.
                        </div>
                        <script>
                            $("#notification").fadeTo(3000, 500).slideUp(500, function() {
                                $("#notification").slideUp(500);
                            });
                        </script>
                    </div>
                    @endif

                    @if (session('medicalhistoryalert'))
                    <div class="col-12">
                        <div class="alert alert-success" role="alert" id="notification2" style="border-radius: 20px;">
                            Medical history for <b>{{ session('medicalhistoryalert') }}</b> has been created successfully.
                        </div>
                        <script>
                            $("#notification2").fadeTo(3000, 500).slideUp(500, function() {
                                $("#notification2").slideUp(500);
                            });
                        </script>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6 mb-12">
                        <div class="row">
                            <div class="col-12">
                                <p id="bottomline">Create an appointment</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('create-appointment') }}">
                            @csrf
                            <div class="form-row">
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
                                    <input type="text" class="form-control" id="doctor" value="{{ Auth::user()->name }}" disabled>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <label for="date">Date</label>
                                    <input class="form-control" type="datetime-local" id="date" name="date" required>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <label for="reason">Reason</label>
                                    <textarea class="form-control" id="reason" name="reason" placeholder="Reason for the visit" rows="2" maxlength="100" required style="resize: none;"></textarea>
                                    <p id="messageCount" style="text-align: right; font-size: 12px;"></p>
                                    <script>
                                        let length = 100;
                                        $('#messageCount').html('0 / ' + length );
                                            $('#reason').keyup(function() {
                                                let textLength = $('#reason').val().length;
                                                let textLengthOver = length - textLength;

                                                $('#messageCount').html(textLength + ' / ' + length);
                                            }
                                        );
                                    </script>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <button class="btn btn-sm btn-primary" type="submit">Create Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 mb-12">
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
                                    <label for="condition">Condition</label>
                                    <textarea class="form-control" id="condition" name="condition" placeholder="Medical condition" rows="2" maxlength="100" required style="resize: none;"></textarea>
                                    <p id="messageCount2" style="text-align: right; font-size: 12px;"></p>
                                    <script>
                                        let length2 = 100;
                                        $('#messageCount2').html('0 / ' + length2 );
                                            $('#condition').keyup(function() {
                                                let textLength2 = $('#condition').val().length;
                                                let textLengthOver2 = length2 - textLength2;

                                                $('#messageCount2').html(textLength2 + ' / ' + length2);
                                            }
                                        );
                                    </script>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-6">
                                    <button class="btn btn-sm btn-primary" type="submit">Create Medical History</button>
                                </div>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
