<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Medical History') }}</h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-8 lg:px-8">
            <div class="mt-8 bg-gray dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg" style="background-color: white;">
                <div class="grid grid-cols-1 md:grid-cols-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <p style="text-align: center;" id="bottomline"><b>{{ Auth::user()->name }}'s medical history</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p style="word-wrap:break-word;">Email: {{ $patient->email }}</p>
                                <p style="word-wrap:break-word;">Phone: {{ $patient->phonenumber }}</p>
                            </div>
                            <div class="col-6">
                                <p style="word-wrap:break-word;">Date of Birth: {{ $patient->birthdate }}</p>
                                <p style="word-wrap:break-word;">Patient since: {{ $patient->created_at }}</p>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-6">
                               <p id="bottomline">Appointment history</p>
                            </div>
                            <div class="col-6">
                                <p id="bottomline">Medical history</p>
                            </div>
                        </div>
                        @foreach($appointments as $appointment)
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group">
                                    @if($appointment->patientID == $patient->id)
                                        <li class="list-group-item" style="height: 12rem;" id="line">
                                            <p style="word-wrap:break-word;">Date: {{ $appointment->date }} </p>
                                            @foreach ($doctors as $doctor)
                                                @if($appointment->doctorID == $doctor->id)
                                                <p style="word-wrap:break-word;">Doctor: {{ $doctor->name }} </p>
                                                @endif
                                            @endforeach 
                                            <p style="word-wrap:break-word;">Reason: {{ $appointment->reason}} </p></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    @foreach($conditions as $condition)
                                        @if($appointment->patientID == $patient->id && $condition->appointmentID == $appointment->id)
                                            <li class="list-group-item" style="height: 12rem;" id="line">
                                                <p style="word-wrap:break-word;">Condition: {{ $condition->condition }}</p>
                                                @foreach ($doctors as $doctor)
                                                    @if($appointment->doctorID == $doctor->id)
                                                    <p style="word-wrap:break-word;">Diagnosed by: {{ $doctor->name }} </p>
                                                    @endif
                                                @endforeach
                                                <p style="word-wrap:break-word;">On: {{ $condition->date }}</p>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        <br />
                        <div class="row">
                            <div class="col-12">
                                <p style="text-align: center;"><small >Please navigate to your profile if you want a copy of your medical history.</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
